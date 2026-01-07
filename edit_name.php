<?php
session_start();
include "db.php";

// เช็คว่าล็อกอินหรือยัง
if(!isset($_SESSION['user_id'])){
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT name,email,phone FROM users WHERE id='$user_id'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>แก้ไขข้อมูลผู้ใช้</title>

<style>
body{
  background:#111;
  color:white;
  font-family:Arial;
}
.box{
  width:350px;
  margin:80px auto;
  padding:20px;
  background:#222;
  border-radius:12px;
}
input{
  width:100%;
  padding:10px;
  border-radius:10px;
  border:none;
  margin-top:10px;
}
button{
  width:100%;
  padding:10px;
  margin-top:10px;
  border:none;
  border-radius:10px;
  background:#00c3ff;
  cursor:pointer;
}
button:hover{
  opacity:0.8;
}
/* ปุ่มย้อนกลับ */
.back-btn{
    position:absolute;
    width: 100px;
    top:15px;
    left:15px;
    padding:8px 14px;
    border-radius:10px;
    border:none;
    background:#2563eb;
    color:white;
    cursor:pointer;
}
.back-btn:hover{
    background:#1d4ed8;
}
</style>
</head>

<body>
<button class="back-btn" onclick="window.location.href='Profile.php'">ย้อนกลับ</button>
<div class="box">
  <h2>แก้ไขข้อมูลผู้ใช้</h2>

  <form action="edit_name_save.php" method="post">
      <label>ชื่อใหม่</label>
      <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

      <label>เบอร์โทร</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">

      <button type="submit">บันทึก</button>
  </form>
</div>

</body>
</html>
