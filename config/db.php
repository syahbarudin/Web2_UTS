<?php
// config/db.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "satu_device";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
