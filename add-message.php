<?php
// Connect to database
$dsn = 'mysql:host=localhost;dbname=chatgpt;port=3307;charset=utf8mb4';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Get the message from the request body
$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'];

// Insert new message into database
$stmt = $pdo->prepare("INSERT INTO messages (text) VALUES (?)");
if ($stmt->execute([$message])) {
    echo json_encode([
        'id' => $pdo->lastInsertId(),
        'text' => $message,
    ]);
}


// Return the inserted message as JSON

