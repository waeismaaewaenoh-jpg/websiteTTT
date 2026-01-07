<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // สร้าง Session เพื่อยืนยันตัวตน
        header("Location: system.php");
    } else {
        echo "รหัสผ่านผิด";
    }
} else {
    echo "ไม่พบผู้ใช้งานนี้";
}
?>