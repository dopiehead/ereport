<?php
// A simple example for handling signaling messages.
// In a real-world application, use a WebSocket server for better performance.
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Store signaling messages in a temporary file or database
    $file = 'signaling_data.json';
    file_put_contents($file, json_encode($data));

    echo json_encode(['status' => 'ok']);
}
?>