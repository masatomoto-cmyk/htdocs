<?php

require_once 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Handle POST request
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
try {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();
    echo "User registered successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}