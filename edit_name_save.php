<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$name  = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$user_id'";

if($conn->query($sql)){
    header("Location: profile.php");
    exit();
}else{
    echo "อัปเดตไม่สำเร็จ";
}
?>
