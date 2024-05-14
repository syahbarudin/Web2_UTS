<?php
// src/logout.php
session_start();
include '../config/db.php';

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE users SET session_id = NULL WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    session_destroy();
}

header("Location: ../index.php");
?>
