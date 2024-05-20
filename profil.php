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
    <title>Profil</title>
</head>
<body>
    <h1>Welcome to the Protected Page!</h1>
    <p><?php echo "Mang Eak? "; ?></p>
    <a href="home.php">Kembali</a>
</body>
</html>
