<?php
header('Content-Type: text/plain');

$host = getenv('EASYBUY_DB_HOST');
$port = (int)(getenv('EASYBUY_DB_PORT') ?: 15429);

$socket = @fsockopen($host, $port, $errno, $errstr, 8);

if ($socket) {
    echo "NETWORK CONNECTION SUCCESS";
    fclose($socket);
} else {
    echo "NETWORK CONNECTION FAILED";
    echo "\nError: $errno - $errstr";
}