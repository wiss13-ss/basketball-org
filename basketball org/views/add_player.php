<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get all teams for the dropdown
$teams_query = "SELECT id, name FROM teams ORDER BY name";
$teams_result = $conn->query($teams_query);

// Get all users for the dropdown
$users_query = "SELECT id, username FROM users WHERE role = 'player' ORDER BY username";
$users_result = $conn->query($users_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Player - Basketball Org</title>
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
        <h2>Add New Player</h2>
        
        <div class="form-container">
            <form action="../controllers/add_player.php" method="POST">
                <label for="name">Player Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="user_id">User Account (Optional):</label><br>
                <select id="user_id" name="user_id">
                    <option value="">Select User Account</option>
                    <?php while ($user = $users_result->fetch_assoc()): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['username']); ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <label for="team_id">Team:</label><br>
                <select id="team_id" name="team_id">
                    <option value="">Select Team</option>
                    <?php while ($team = $teams_result->fetch_assoc()): ?>
                        <option value="<?php echo $team['id']; ?>"><?php echo htmlspecialchars($team['name']); ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <label for="stats">Stats (Optional):</label><br>
                <textarea id="stats" name="stats" rows="4" placeholder="Enter player statistics, achievements, etc."></textarea><br><br>

                <label for="health">Health Information (Optional):</label><br>
                <textarea id="health" name="health" rows="3" placeholder="Enter health updates, injuries, etc."></textarea><br><br>

                <button type="submit">Add Player</button>
            </form>
            <div class="form-link">
                <a href="players.php">← Back to Player List</a>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Basketball Org</p>
    </footer>
</body>
</html> 