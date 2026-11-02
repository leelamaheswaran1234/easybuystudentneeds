<?php
/**
 * EasyBuy unified authentication endpoint (MySQL + PHP sessions + password_hash).
 *
 *   GET  auth.php?action=me[&role=buyer|seller]   -> current session(s)
 *   POST auth.php  {action:register|login|logout, role:buyer|seller, ...}
 *
 * Buyers are stored in `buyers`, sellers in `sellers`; both use password_hash()/password_verify().
 * buyer-auth-endpoint.php and seller-auth.php are thin wrappers around this file (they pin the role) so the
 * existing seller studio and older pages keep working unchanged.
 */
require __DIR__ . '/api-config.php';

$pinnedRole = defined('EB_AUTH_ROLE') ? (string)EB_AUTH_ROLE : '';
$forcedAction = defined('EB_AUTH_ACTION') ? (string)EB_AUTH_ACTION : '';
$action = $forcedAction !== '' ? $forcedAction : (string)($_GET['action'] ?? '');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $role = $pinnedRole !== '' ? $pinnedRole : (string)($_GET['role'] ?? '');
    if ($action !== 'me') json_out(['ok' => false, 'error' => 'Unknown action.'], 400);
    if ($role !== '' && !in_array($role, ['buyer', 'seller'], true)) json_out(['ok' => false, 'error' => 'Unknown role.'], 400);
    eb_auth_me($role);
}
if ($method !== 'POST') json_out(['ok' => false, 'error' => 'Method not allowed'], 405);

$d = input_json();
$action = $forcedAction !== '' ? $forcedAction : (string)($d['action'] ?? $action);
$role = $pinnedRole !== '' ? $pinnedRole : (string)($d['role'] ?? $_GET['role'] ?? 'buyer');
if (!in_array($role, ['buyer', 'seller'], true)) json_out(['ok' => false, 'error' => 'Unknown role.'], 400);

if ($action === 'logout') {
    if ($role === 'seller') {
        csrf_check();
        unset($_SESSION['seller_id'], $_SESSION['seller_name'], $_SESSION['seller_email'], $_SESSION['seller_phone'], $_SESSION['csrf']);
    } else {
        $sent = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (empty($_SESSION['buyer_csrf']) || !$sent || !hash_equals($_SESSION['buyer_csrf'], $sent)) json_out(['ok' => false, 'error' => 'Refresh and try again.'], 419);
        unset($_SESSION['buyer_id'], $_SESSION['buyer_email'], $_SESSION['buyer_name'], $_SESSION['buyer_csrf']);
    }
    json_out(['ok' => true]);
}
if ($role === 'seller') eb_auth_seller($action, $d);
eb_auth_buyer($action, $d);

/* ------------------------------------------------------------------ */

/** True for a MySQL duplicate-key violation (SQLSTATE 23000 / error 1062), whichever driver layer reports it. */
function eb_is_duplicate_key(PDOException $e): bool
{
    return (string)$e->getCode() === '23000' || (int)($e->errorInfo[1] ?? 0) === 1062;
}

function eb_security_questions(): array
{
    return ['What is your favourite colour?', 'What was the name of your first school?', 'What is your favourite food?', 'What is your childhood nickname?'];
}
function eb_norm_answer(string $a): string
{
    $a = trim($a);
    return function_exists('mb_strtolower') ? mb_strtolower($a, 'UTF-8') : strtolower($a);
}

function eb_buyer_row(PDO $pdo, int $id): array
{
    $st = $pdo->prepare('SELECT id,name,email,phone,address,college,city,pincode,created_at FROM buyers WHERE id=?');
    $st->execute([$id]);
    return $st->fetch() ?: [];
}

function eb_auth_me(string $role): void
{
    $out = ['ok' => true];
    if ($role === '' || $role === 'buyer') {
        $buyer = null;
        if (!empty($_SESSION['buyer_id'])) {
            try {
                $buyer = eb_buyer_row(db(), (int)$_SESSION['buyer_id']) ?: null;
            } catch (Throwable $e) {
                error_log('EasyBuy buyer me: ' . $e->getMessage());
                json_out(['ok' => false, 'error' => 'Buyer database is unavailable. Check MySQL and api-config.php.'], 503);
            }
            if (!$buyer) unset($_SESSION['buyer_id'], $_SESSION['buyer_email'], $_SESSION['buyer_name'], $_SESSION['buyer_csrf']);
            elseif (empty($_SESSION['buyer_csrf'])) $_SESSION['buyer_csrf'] = bin2hex(random_bytes(32));
        }
        $out['buyer'] = $buyer;
        $out['buyer_csrf'] = $buyer ? $_SESSION['buyer_csrf'] : null;
        if ($role === 'buyer') $out['csrf'] = $out['buyer_csrf'];
    }
    if ($role === '' || $role === 'seller') {
        $seller = null;
        if (!empty($_SESSION['seller_id'])) {
            if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
            try {
                $pdo = db();
                ensure_seller_table($pdo);
                $st = $pdo->prepare('SELECT phone FROM sellers WHERE id=?');
                $st->execute([(int)$_SESSION['seller_id']]);
                $_SESSION['seller_phone'] = (string)($st->fetchColumn() ?: '');
            } catch (Throwable $e) {
                error_log('EasyBuy seller profile read: ' . $e->getMessage());
            }
            $seller = ['id' => (int)$_SESSION['seller_id'], 'name' => $_SESSION['seller_name'], 'email' => $_SESSION['seller_email'], 'phone' => ($_SESSION['seller_phone'] ?? '')];
        }
        $out['seller'] = $seller;
        $out['seller_csrf'] = $seller ? $_SESSION['csrf'] : null;
        if ($role === 'seller') $out['csrf'] = $out['seller_csrf'];
    }
    json_out($out);
}

function eb_auth_buyer(string $action, array $d): void
{
    try {
        $pdo = db();
    } catch (Throwable $e) {
        error_log('EasyBuy buyer auth DB: ' . $e->getMessage());
        json_out(['ok' => false, 'error' => 'Buyer database is unavailable. Check MySQL and api-config.php.'], 503);
    }
    if ($action === 'change_password') {
        $buyer = require_buyer();
        buyer_csrf_check();
        $old = (string)($d['current_password'] ?? '');
        $new = (string)($d['new_password'] ?? '');
        if (strlen($new) < 8 || strlen($new) > 200) json_out(['ok' => false, 'error' => 'New password must contain at least 8 characters.'], 422);
        $st = $pdo->prepare('SELECT password_hash FROM buyers WHERE id=?');
        $st->execute([$buyer['id']]);
        $hash = $st->fetchColumn();
        if (!$hash || !password_verify($old, $hash)) json_out(['ok' => false, 'error' => 'Current password is incorrect.'], 401);
        $pdo->prepare('UPDATE buyers SET password_hash=? WHERE id=?')->execute([password_hash($new, PASSWORD_DEFAULT), $buyer['id']]);
        json_out(['ok' => true, 'message' => 'Password changed successfully.']);
    }
    if ($action === 'recover_question' || $action === 'recover_reset') {
        $remail = strtolower(trim((string)($d['email'] ?? '')));
        if (!filter_var($remail, FILTER_VALIDATE_EMAIL)) json_out(['ok' => false, 'error' => 'Enter a valid email address.'], 422);
        $st = $pdo->prepare('SELECT id,security_question,security_answer_hash FROM buyers WHERE email=? LIMIT 1');
        $st->execute([$remail]);
        $row = $st->fetch();
        if ($action === 'recover_question') {
            if (!$row) json_out(['ok' => false, 'error' => 'No buyer account found for that email.'], 404);
            if (empty($row['security_question']) || empty($row['security_answer_hash'])) json_out(['ok' => false, 'error' => 'This older account has no security question. Please contact the EasyBuy administrator.'], 422);
            json_out(['ok' => true, 'question' => (string)$row['security_question']]);
        }
        // Throttle wrong answers: 5 failures per e-mail, then locked for 15 minutes.
        $key = 'recover_' . substr(hash('sha256', $remail), 0, 40);
        $tq = $pdo->prepare('SELECT v FROM eb_settings WHERE k=?');
        $tq->execute([$key]);
        [$fails, $since] = array_pad(array_map('intval', explode('|', (string)$tq->fetchColumn())), 2, 0);
        if ($since && time() - $since > 900) { $fails = 0; $since = 0; }
        if ($fails >= 5) json_out(['ok' => false, 'error' => 'Too many wrong answers. Try again in 15 minutes.'], 429);
        $answer = eb_norm_answer((string)($d['security_answer'] ?? ''));
        $new = (string)($d['new_password'] ?? '');
        if (strlen($new) < 8 || strlen($new) > 200) json_out(['ok' => false, 'error' => 'New password must contain at least 8 characters.'], 422);
        if (!$row || empty($row['security_answer_hash']) || $answer === '' || !password_verify($answer, (string)$row['security_answer_hash'])) {
            $pdo->prepare('INSERT INTO eb_settings(k,v) VALUES(?,?) ON DUPLICATE KEY UPDATE v=VALUES(v)')->execute([$key, ($fails + 1) . '|' . ($since ?: time())]);
            usleep(400000);
            json_out(['ok' => false, 'error' => 'Security answer is incorrect. Please try again.'], 422);
        }
        $pdo->prepare('UPDATE buyers SET password_hash=? WHERE id=?')->execute([password_hash($new, PASSWORD_DEFAULT), (int)$row['id']]);
        $pdo->prepare('DELETE FROM eb_settings WHERE k=?')->execute([$key]);
        json_out(['ok' => true, 'message' => 'Password updated. You can now log in with your new password.']);
    }
    $email = strtolower(trim((string)($d['email'] ?? '')));
    $password = (string)($d['password'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8 || strlen($password) > 200) json_out(['ok' => false, 'error' => 'Enter a valid email and password (at least 8 characters).'], 422);
    if ($action === 'register') {
        $name = trim((string)($d['name'] ?? ''));
        $len = function_exists('mb_strlen') ? mb_strlen($name, 'UTF-8') : strlen($name);
        if ($len < 2 || $len > 80) json_out(['ok' => false, 'error' => 'Enter your name (2–80 characters).'], 422);
        $question = trim((string)($d['security_question'] ?? ''));
        $answer = eb_norm_answer((string)($d['security_answer'] ?? ''));
        if (!in_array($question, eb_security_questions(), true) || strlen($answer) < 2 || strlen($answer) > 120) json_out(['ok' => false, 'error' => 'Choose a security question and enter an answer (2–120 characters).'], 422);
        try {
            $pdo->prepare('INSERT INTO buyers(name,email,password_hash,security_question,security_answer_hash) VALUES(?,?,?,?,?)')->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), $question, password_hash($answer, PASSWORD_DEFAULT)]);
            $id = (int)$pdo->lastInsertId();
        } catch (PDOException $e) {
            if (eb_is_duplicate_key($e)) json_out(['ok' => false, 'error' => 'This email already has a buyer account. Please log in.'], 409);
            error_log('EasyBuy buyer register: ' . $e->getMessage());
            json_out(['ok' => false, 'error' => 'Registration failed. Check MySQL and the PHP error log.'], 500);
        }
    } elseif ($action === 'login') {
        $st = $pdo->prepare('SELECT id,name,email,password_hash FROM buyers WHERE email=? LIMIT 1');
        $st->execute([$email]);
        $b = $st->fetch();
        if (!$b || !password_verify($password, $b['password_hash'])) json_out(['ok' => false, 'error' => 'Email or password is incorrect.'], 401);
        $id = (int)$b['id'];
    } else {
        json_out(['ok' => false, 'error' => 'Unknown action.'], 400);
    }
    $buyer = eb_buyer_row($pdo, $id);
    session_regenerate_id(true);
    $_SESSION['buyer_id'] = $id;
    $_SESSION['buyer_name'] = (string)$buyer['name'];
    $_SESSION['buyer_email'] = $email;
    $_SESSION['buyer_csrf'] = bin2hex(random_bytes(32));
    json_out(['ok' => true, 'buyer' => $buyer, 'csrf' => $_SESSION['buyer_csrf'], 'buyer_csrf' => $_SESSION['buyer_csrf']]);
}

function eb_auth_seller(string $action, array $d): void
{
    $email = strtolower(trim((string)($d['email'] ?? '')));
    $password = (string)($d['password'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) json_out(['ok' => false, 'error' => 'Enter a valid email and password (at least 8 characters).'], 422);
    try {
        $pdo = db();
        ensure_seller_table($pdo);
        $phone = '';
        if ($action === 'register') {
            $name = trim((string)($d['name'] ?? ''));
            $len = function_exists('mb_strlen') ? mb_strlen($name, 'UTF-8') : strlen($name);
            if ($len < 2 || $len > 80) json_out(['ok' => false, 'error' => 'Enter your name (2–80 characters).'], 422);
            $question = trim((string)($d['security_question'] ?? ''));
            $rawAnswer = trim((string)($d['security_answer'] ?? ''));
            $answer = function_exists('mb_strtolower') ? mb_strtolower($rawAnswer, 'UTF-8') : strtolower($rawAnswer);
            $allowedQuestions = ['What is your favourite colour?', 'What was the name of your first school?', 'What is your favourite food?', 'What is your childhood nickname?'];
            if (!in_array($question, $allowedQuestions, true) || strlen($answer) < 2 || strlen($answer) > 120) json_out(['ok' => false, 'error' => 'Choose a security question and enter an answer (2–120 characters).'], 422);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $answerHash = password_hash($answer, PASSWORD_DEFAULT);
            // The owner seller row is pre-seeded (with the default 250 products) without a password.
            // The first registration with that e-mail claims it instead of failing as "already exists".
            $existing = $pdo->prepare('SELECT id FROM sellers WHERE email=? AND password_hash=? LIMIT 1');
            $existing->execute([$email, EASYBUY_UNCLAIMED_HASH]);
            $claimId = (int)$existing->fetchColumn();
            if ($claimId) {
                $claim = $pdo->prepare("UPDATE sellers SET name=?,password_hash=?,security_question=?,security_answer_hash=?,status='active' WHERE id=? AND password_hash=?");
                $claim->execute([$name, $hash, $question, $answerHash, $claimId, EASYBUY_UNCLAIMED_HASH]);
                if (!$claim->rowCount()) json_out(['ok' => false, 'error' => 'This email already has a seller account.'], 409);
                $id = $claimId;
            } else {
                try {
                    $pdo->prepare('INSERT INTO sellers(name,email,password_hash,security_question,security_answer_hash) VALUES(?,?,?,?,?)')->execute([$name, $email, $hash, $question, $answerHash]);
                } catch (PDOException $e) {
                    if (eb_is_duplicate_key($e)) json_out(['ok' => false, 'error' => 'This email already has a seller account.'], 409);
                    throw $e;
                }
                $id = (int)$pdo->lastInsertId();
            }
        } elseif ($action === 'login') {
            $st = $pdo->prepare('SELECT id,name,email,phone,password_hash,status FROM sellers WHERE email=? LIMIT 1');
            $st->execute([$email]);
            $s = $st->fetch();
            if ($s && $s['password_hash'] === EASYBUY_UNCLAIMED_HASH) json_out(['ok' => false, 'error' => 'This is the EasyBuy owner account and it has no password yet. Choose "Create account" with this email once to set your password.'], 401);
            if (!$s || !password_verify($password, $s['password_hash']) || $s['status'] !== 'active') json_out(['ok' => false, 'error' => 'Email or password is incorrect.'], 401);
            $id = (int)$s['id'];
            $name = $s['name'];
            $phone = (string)($s['phone'] ?? '');
        } else {
            json_out(['ok' => false, 'error' => 'Unknown action'], 400);
        }
        if (!isset($name)) {
            $st = $pdo->prepare('SELECT name,phone FROM sellers WHERE id=?');
            $st->execute([$id]);
            $row = $st->fetch();
            $name = (string)$row['name'];
            $phone = (string)($row['phone'] ?? '');
        }
        session_regenerate_id(true);
        $_SESSION['seller_id'] = $id;
        $_SESSION['seller_name'] = $name;
        $_SESSION['seller_email'] = $email;
        $_SESSION['seller_phone'] = $phone;
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        try {
            $pdo->prepare('INSERT INTO eb_analytics_events(event_type,visitor_key,page_path,seller_id,visitor_label) VALUES(?,?,?,?,?)')
                ->execute([$action === 'login' ? 'seller_login' : 'seller_register', session_id(), '/', $id, $email]);
        } catch (Throwable $analyticsError) {
            error_log('EasyBuy analytics login log: ' . $analyticsError->getMessage());
        }
        json_out(['ok' => true, 'seller' => ['id' => $id, 'name' => $name, 'email' => $email, 'phone' => $phone], 'csrf' => $_SESSION['csrf'], 'seller_csrf' => $_SESSION['csrf']]);
    } catch (Throwable $e) {
        error_log('EasyBuy auth failure [' . get_class($e) . ']: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
        $message = 'Seller registration/login failed. ';
        if ($e instanceof PDOException) {
            $errorText = $e->getMessage();
            if (strpos($errorText, 'Unknown database') !== false) $message .= 'The EasyBuy database was not found. Check api-config.php.';
            elseif (strpos($errorText, "doesn't exist") !== false) $message .= 'A required table is missing. Import EasyBuy_InfinityFree_Schema.sql.';
            else $message .= 'Check that MySQL is running and database settings in api-config.php are correct.';
        } else {
            $message .= 'Check the PHP error log for the exact cause.';
        }
        json_out(['ok' => false, 'error' => $message], 500);
    }
}
