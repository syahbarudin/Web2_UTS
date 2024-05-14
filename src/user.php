<?php
// src/user.php
session_start();
include '../config/db.php';

function check_session() {
    global $conn;

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }

    $id = $_SESSION['user_id'];
    $session_id = session_id();

    $stmt = $conn->prepare("SELECT session_id FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_session_id);
    $stmt->fetch();

    if ($stored_session_id !== $session_id) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    }

    $stmt->close();
}
?>
