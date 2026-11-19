cat << 'EOF' > index.php
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

$file = __DIR__ . '/data.txt';
$action = $_GET['action'] ?? '';

if ($action === 'get') {
    echo file_exists($file) ? file_get_contents($file) : '';
} elseif ($action === 'set') {
    $data = $_GET['data'] ?? '';
    file_put_contents($file, $data, LOCK_EX);
    echo 'OK';
} elseif ($action === 'clear') {
    file_put_contents($file, '', LOCK_EX);
    echo 'CLEARED';
} else {
    echo 'SERVER READY';
}
?>
EOF
