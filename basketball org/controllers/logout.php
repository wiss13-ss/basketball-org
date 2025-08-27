<?php
// Logout logic for Basketball Org
session_start();

// Destroy all session data
session_destroy();

// Redirect to login page
header('Location: ../views/login.php?logout=success');
exit(); 