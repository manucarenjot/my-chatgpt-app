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

// Retrieve messages from database
$stmt = $pdo->query('SELECT * FROM messages ORDER BY id DESC');
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return messages as JSON
echo json_encode($messages);
