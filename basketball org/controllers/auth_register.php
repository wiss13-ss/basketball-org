<?php
// Registration logic for Basketball Org
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Basic validation
    if (empty($username) || empty($password) || empty($role)) {
        die('All fields are required.');
    }

    // Check if username exists
    $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die('Username already taken.');
    }
    $stmt->close();

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $hashed_password, $role);
    if ($stmt->execute()) {
        header('Location: ../views/login.php?registered=1');
        exit();
    } else {
        die('Registration failed.');
    }
}
// If not POST, redirect to registration form
header('Location: ../views/register.php');
exit(); 