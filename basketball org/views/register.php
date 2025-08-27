<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Basketball Org</title>
    <link rel="stylesheet" href="/basketball org/assets/css/style.css">
</head>
<body>
    <h2>User Registration</h2>
    <div class="form-container">
        <form action="../controllers/auth_register.php" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="player">Player</option>
                <option value="coach">Coach</option>
                <option value="fan">Fan</option>
                <option value="admin">Admin</option>
            </select><br><br>

            <button type="submit">Register</button>
        </form>
        <div class="form-link">
            Already have an account? <a href="login.php">Login here.</a>
        </div>
    </div>
</body>
</html> 