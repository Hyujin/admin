<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "Altria123!@#";
$dbName     = "auto_api";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}