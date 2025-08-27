<?php
session_start();
// Homepage for Basketball Organization Website
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball Organization</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>🏀 Basketball Organization</h1>
        <nav>
            <a href="index.php">Home</a> |
            <a href="views/players.php">Player Profiles</a> |
            <a href="views/schedule.php">Game Schedule</a> |
            <a href="views/teams.php">Teams & Leagues</a> |
            <a href="views/news.php">News</a> |
            <a href="views/gallery.php">Gallery</a> |
            <a href="views/fan.php">Fan Zone</a> |
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="controllers/logout.php">Logout</a>
            <?php else: ?>
                <a href="views/login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Logged in user content -->
            <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>You are logged in as: <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong></p>
            
            <?php if (isset($_GET['login']) && $_GET['login'] === 'success'): ?>
                <p style="color: green; text-align: center;">Login successful! Welcome back.</p>
            <?php endif; ?>
            
            
        <?php else: ?>
            <!-- Public visitor content -->
            <h2>Welcome to the Basketball Organization Website!</h2>
            <p>Your hub for schedules, stats, news, and more.</p>
            
            <div style="margin-top: 30px;">
                <h3>Get Started:</h3>
                <ul>
                    <li><a href="views/register.php">Register for an account</a></li>
                    <li><a href="views/login.php">Login to your account</a></li>
                    <li><a href="?page=players">View Player Profiles</a></li>
                    <li><a href="?page=schedule">Check Game Schedule</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Basketball Org</p>
    </footer>
</body>
</html> 