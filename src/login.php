<?php
// src/login.php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password, device_info FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $current_device_info);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Regenerasi session ID untuk mencegah serangan sesi
            session_regenerate_id(true);

            $session_id = session_id();
            $device_info = $_SERVER['HTTP_USER_AGENT'];
            $timestamp = date('Y-m-d H:i:s');
            $is_new_device = $device_info !== $current_device_info;

            // Perbarui session_id, device_info, last_login, dan last_device_info di database
            $update_stmt = $conn->prepare("UPDATE users SET session_id = ?, device_info = ?, last_login = ?, last_device_info = IF(device_info != ?, device_info, last_device_info) WHERE id = ?");
            $update_stmt->bind_param("ssssi", $session_id, $device_info, $timestamp, $device_info, $id);
            $update_stmt->execute();
            $update_stmt->close();

            $_SESSION['user_id'] = $id;
            $_SESSION['session_id'] = $session_id;
            $_SESSION['is_new_device'] = $is_new_device;

            header("Location: ../home.php");
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "Invalid credentials.";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../index.php");
    exit();
}
?>
