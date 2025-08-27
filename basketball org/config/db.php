<?php
// Database connection settings
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'basketball_org';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Usage: include this file and use $conn 