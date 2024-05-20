<?php
// src/check_session.php

function check_session($conn) {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['session_id'])) {
        // Jika tidak ada sesi, alihkan ke halaman login
        header("Location: ../index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $current_session_id = session_id();
    $device_info = $_SERVER['HTTP_USER_AGENT'];

    $stmt = $conn->prepare("SELECT session_id, device_info FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_session_id, $stored_device_info);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if ($stored_session_id !== $current_session_id || $stored_device_info !== $device_info) {
            // Jika sesi atau perangkat berbeda, tampilkan alert dan logout
            echo "<script>
                alert('Akun Anda telah masuk dari perangkat lain. Anda akan logout.');
                window.location.href = 'logout.php';
            </script>";
            exit();
        }
    } else {
        // Jika pengguna tidak ditemukan, alihkan ke halaman login
        header("Location: ../index.php");
        exit();
    }

    $stmt->close();
}
?>
