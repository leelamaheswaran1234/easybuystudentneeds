<?php
require __DIR__.'/admin-common.php'; unset($_SESSION['admin_id'],$_SESSION['admin_username']); header('Location: admin-login.php'); exit;
