<?php
// Starts the session
session_start();

// Create constants to store Non Repeating values
define('HOMEURL', 'http://localhost/sultan-ordering/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sultan-orders');

// Database connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); 

// Selecting the database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); 

