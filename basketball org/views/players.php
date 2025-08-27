<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get all players with their team information
$query = "SELECT p.*, t.name as team_name, u.username 
          FROM players p 
          LEFT JOIN teams t ON p.team_id = t.id 
          LEFT JOIN users u ON p.user_id = u.id 
          ORDER BY p.name";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Profiles - Basketball Org</title>
    <link rel="stylesheet" href="/basketball org/assets/css/style.css">
</head>
<body>
    <header>
        <h1>🏀 Basketball Organization</h1>
        <nav>
            <a href="../index.php">Home</a> |
            <a href="players.php">Player Profiles</a> |
            <a href="schedule.php">Game Schedule</a> |
            <a href="teams.php">Teams & Leagues</a> |
            <a href="news.php">News</a> |
            <a href="gallery.php">Gallery</a> |
            <a href="fan.php">Fan Zone</a> |
            <a href="../controllers/logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Player Profiles</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        
        <?php if (isset($_GET['added']) && $_GET['added'] === '1'): ?>
            <p style="color: green; text-align: center;">Player added successfully!</p>
        <?php endif; ?>
        
        <div style="margin: 20px 0;">
            <a href="add_player.php" style="background: #222; color: #ffd700; padding: 10px 15px; text-decoration: none; border-radius: 4px;">Add New Player</a>
        </div>
        
        <?php if ($result->num_rows > 0): ?>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #ddd;">
                <thead>
                    <tr style="background: #222; color: #ffd700;">
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Name</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Team</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Username</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($player = $result->fetch_assoc()): ?>
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($player['name']); ?></td>
                            <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($player['team_name'] ?? 'No Team'); ?></td>
                            <td style="padding: 12px; border: 1px solid #ddd;"><?php echo htmlspecialchars($player['username'] ?? 'No Account'); ?></td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <a href="view_player.php?id=<?php echo $player['id']; ?>" style="color: #222; margin-right: 10px;">View</a>
                                <a href="edit_player.php?id=<?php echo $player['id']; ?>" style="color: #222; margin-right: 10px;">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; margin-top: 40px; color: #666;">No players found. <a href="add_player.php">Add the first player</a>!</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Basketball Org</p>
    </footer>
</body>
</html> 