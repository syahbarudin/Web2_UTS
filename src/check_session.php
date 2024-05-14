<?php
// check_session.php
session_start();
include 'config/db.php';

function check_session() {
    global $conn;

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['session_id'])) {
        header("Location: index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $session_id = $_SESSION['session_id'];
    $device_info = $_SERVER['HTTP_USER_AGENT'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ? AND session_id = ? AND device_info = ?");
    $stmt->bind_param("iss", $user_id, $session_id, $device_info);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows != 1) {
        header("Location: index.php");
        exit();
    }

    $stmt->close();
}
?>
