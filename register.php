<?php
include 'db.php';
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password, phone) VALUES ('$name', '$email', '$pass', '$phone')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('สมัครสำเร็จ!'); window.location='login.html';</script>";
} else {
    echo "Error: " . $conn->error;
}
?>