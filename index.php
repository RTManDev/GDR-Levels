<?php
// Allow TurboWarp to access this script from any domain
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

$file = "storage.txt";
$action = $_GET['action'] ?? 'get';

if ($action === 'set') {
    // Save the incoming text to storage.txt
    $data = $_GET['data'] ?? '';
    file_put_contents($file, $data);
    echo "OK";
} elseif ($action === 'clear') {
    // Empty the file
    file_put_contents($file, "");
    echo "CLEARED";
} else {
    // Return the saved plain text (or empty string if file doesn't exist yet)
    echo file_exists($file) ? file_get_contents($file) : "";
}
?>
