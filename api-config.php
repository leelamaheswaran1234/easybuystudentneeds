<?php
declare(strict_types=1);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// --- FIX 1: Define isLocalHost ---
$serverName = strtolower($_SERVER['SERVER_NAME'] ?? '');
$remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';
$isLocalHost = in_array($serverName, ['localhost', '127.0.0.1', '::1']) || 
               in_array($remoteAddr, ['127.0.0.1', '::1']) ||
               strpos($serverName, 'localhost') !== false;

if (preg_match('~/api-[^/]+\.php$~', (string)($_SERVER['SCRIPT_NAME'] ?? '')) === 1) {
    register_shutdown_function(static function (): void {
        $last = error_get_last();
        if ($last && in_array($last['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)
            && !headers_sent()) {
            while (ob_get_level() > 0) { ob_end_clean(); }
            http_response_code(500);
            header('Content-Type: application/json; charset=utf-8');
            error_log('FATAL: '.$last['message'].' in '.$last['file'].':'.$last['line']);
            echo json_encode(['ok' => false, 'error' => 'A PHP fatal error occurred. Check XAMPP PHP error log.']);
        }
    });
}

$isHttps = (!empty($_SERVER['HTTPS']) && strtolower((string)$_SERVER['HTTPS']) !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $isHttps,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');

if (!defined('EASYBUY_OWNER_EMAIL')) define('EASYBUY_OWNER_EMAIL', strtolower(getenv('EASYBUY_OWNER_EMAIL') ?: '227027089@sastra.ac.in'));
if (!defined('EASYBUY_UNCLAIMED_HASH')) define('EASYBUY_UNCLAIMED_HASH', '!unclaimed-owner-account');

function db(): PDO
{
    static $pdo = null;
    static $schemaReady = false;
    if ($pdo instanceof PDO) return $pdo;

    // --- FIX 2: isLocalHost check inside function ---
    $serverName = strtolower($_SERVER['SERVER_NAME'] ?? '');
    $remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';
    $isLocalHost = in_array($serverName, ['localhost', '127.0.0.1', '::1']) || 
                   in_array($remoteAddr, ['127.0.0.1', '::1']) ||
                   strpos($serverName, 'localhost') !== false;

    if ($isLocalHost) {
        $host = getenv('EASYBUY_DB_HOST') ?: '127.0.0.1';
        $port = (int)(getenv('EASYBUY_DB_PORT') ?: 3306);
        $name = getenv('EASYBUY_DB_NAME') ?: 'easybuy';
        $user = getenv('EASYBUY_DB_USER') ?: 'root';
        $pass = getenv('EASYBUY_DB_PASS') ?: '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    } else {
        // PRODUCTION - AIVEN
        $host = getenv('EASYBUY_DB_HOST') ?: '';
        $port = (int)(getenv('EASYBUY_DB_PORT') ?: 15429);
        $name = getenv('EASYBUY_DB_NAME') ?: '';
        $user = getenv('EASYBUY_DB_USER') ?: '';
        $pass = getenv('EASYBUY_DB_PASS') ?: '';
        $caFile = getenv('EASYBUY_DB_SSL_CA') ?: __DIR__ . '/ca.pem'; // check ca.pem path

        if ($host === '' || $name === '' || $user === '' || $pass === '') {
            error_log('Production DB settings missing');
            throw new RuntimeException('Production database settings are missing. Check EASYBUY_DB_HOST etc in Render.');
        }
        if ($caFile === '' || !is_file($caFile)) {
            error_log('SSL CA missing at: '.$caFile);
            throw new RuntimeException('Aiven SSL CA certificate is missing. Upload ca.pem to same folder as config.php');
        }

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_SSL_CA => $caFile,
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
        ];
    }

    $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // ... rest of your schema code same ...
    // CREATE TABLE IF NOT EXISTS buyers etc - keep as it is

    return $pdo;
}
