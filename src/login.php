<?php
// src/login.php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $session_id = session_id();
            $device_info = $_SERVER['HTTP_USER_AGENT'];

            // Perbarui session_id dan device_info di database
            $update_stmt = $conn->prepare("UPDATE users SET session_id = ?, device_info = ? WHERE id = ?");
            $update_stmt->bind_param("ssi", $session_id, $device_info, $id);
            $update_stmt->execute();
            $update_stmt->close();

            $_SESSION['user_id'] = $id;
            $_SESSION['session_id'] = $session_id;

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
}
?>
