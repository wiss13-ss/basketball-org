<?php
// Login logic for Basketball Org
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';
//hihi
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($password)) {
        die('Username and password are required.');
    }

    // Check if user exists and verify password
    $stmt = $conn->prepare('SELECT id, username, password, role FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Login successful - start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect to dashboard or homepage
            header('Location: ../index.php?login=success');
            exit();
        } else {
            // Wrong password
            header('Location: ../views/login.php?error=invalid');
            exit();
        }
    } else {
        // User not found
        header('Location: ../views/login.php?error=invalid');
        exit();
    }
    
    $stmt->close();
}

// If not POST, redirect to login form
header('Location: ../views/login.php');

exit(); 
