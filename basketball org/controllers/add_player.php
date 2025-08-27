<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    $name = trim($_POST['name']);
    $user_id = !empty($_POST['user_id']) ? $_POST['user_id'] : null;
    $team_id = !empty($_POST['team_id']) ? $_POST['team_id'] : null;
    $stats = trim($_POST['stats']);
    $health = trim($_POST['health']);

    // Basic validation
    if (empty($name)) {
        die('Player name is required.');
    }

    // Insert player
    $stmt = $conn->prepare('INSERT INTO players (name, user_id, team_id, stats, health) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('siiss', $name, $user_id, $team_id, $stats, $health);
    
    if ($stmt->execute()) {
        header('Location: ../views/players.php?added=1');
        exit();
    } else {
        die('Failed to add player. Please try again.');
    }
}

// If not POST, redirect to add player form
header('Location: ../views/add_player.php');
exit(); 