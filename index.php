<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: text/plain");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$file = __DIR__ . '/data.txt';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'get') {
    echo file_exists($file) ? file_get_contents($file) : '';
} elseif ($action === 'set') {
    $data = ($_SERVER['REQUEST_METHOD'] === 'POST')
        ? file_get_contents('php://input')
        : (isset($_GET['data']) ? $_GET['data'] : '');
    file_put_contents($file, $data, LOCK_EX);
    echo 'OK';
} elseif ($action === 'clear') {
    file_put_contents($file, '', LOCK_EX);
    echo 'CLEARED';
} else {
    echo 'SERVER READY';
}
?>
