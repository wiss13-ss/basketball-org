<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Basketball Org</title>
    <link rel="stylesheet" href="/basketball org/assets/css/style.css">
</head>
<body>
    <h2>User Login</h2>
    <?php if (isset($_GET['registered'])): ?>
        <p style="color: green; text-align: center;">Registration successful! Please log in.</p>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
        <p style="color: red; text-align: center;">Invalid username or password. Please try again.</p>
    <?php endif; ?>
    <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
        <p style="color: blue; text-align: center;">You have been logged out successfully.</p>
    <?php endif; ?>
    <div class="form-container">
        <form action="../controllers/auth_login.php" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Login</button>
        </form>
        <div class="form-link">
            Don't have an account? <a href="register.php">Register here.</a>
        </div>
    </div>
</body>
</html> 