<?php
session_start();
include 'config/db.php';
include 'src/check_session.php';

check_session($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h1>Welcome to the Home Page!</h1>
    <p>You are logged in.</p>
    <a href="src/logout.php">Logout</a>
    <a href="profil.php">Profil</a>
</body>
</html>
