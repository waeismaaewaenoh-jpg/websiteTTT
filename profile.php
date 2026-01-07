<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
include 'db.php';
$uid = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id=$uid")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>

<style>

body{
    margin:0;
    padding:0;
    background:#0f172a;
    font-family:Arial;
    color:white;
}

.container{
    max-width:500px;
    margin:40px auto;
    padding:25px;
    background:#111827;
    border-radius:18px;
    box-shadow:0 0 25px rgba(0,0,0,0.35);
    position:relative;
}

/* ปุ่มย้อนกลับ */
.back-btn{
    position:absolute;
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

/* จุดสามจุด */
.menu-btn{
    position:absolute;
    top:15px;
    right:15px;
    font-size:28px;
    background:none;
    border:none;
    color:white;
    cursor:pointer;
}

/* กล่องเมนู */
.dropdown{
    position:absolute;
    top:55px;
    right:15px;
    background:#1f2937;
    border-radius:12px;
    padding:10px 0;
    width:140px;
    display:none;
}

.dropdown div{
    padding:10px 15px;
    cursor:pointer;
}

.dropdown div:hover{
    background:#2563eb;
}

.title{
    text-align:center;
    font-size:26px;
    margin-top:30px;
}

.profile-pic{
    width:130px;
    height:130px;
    border-radius:50%;
    background:#1f2937;
    margin:25px auto 0;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:32px;
    border:3px solid #2563eb;
}

.info{
    margin-top:25px;
    line-height:1.8;
    font-size:18px;
}

.info span{
    color:#9ca3af;
}
</style>

</head>
<body>

<div class="container">

    <!-- ปุ่มย้อนกลับ -->
    <button class="back-btn" onclick="window.location.href='system.php'">ย้อนกลับ</button>

    <!-- จุดสามจุด -->
    <button class="menu-btn" id="menuBtn">⋮</button>

    <!-- เมนู -->
    <div id="menu" class="dropdown">
        <div onclick="window.location.href='edit_name.php'">แก้ไขข้อมูล</div>
        <div onclick="window.location.href='logout.php'">Logout</div>
    </div>

    <div class="title">My Profile</div>

    <div class="profile-pic">
        <?php echo strtoupper(substr($user['name'],0,1)); ?>
    </div>

    <div class="info">
        <p><span>ชื่อ :</span> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><span>Email :</span> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><span>Phone :</span> <?php echo htmlspecialchars($user['phone']); ?></p>
    </div>

</div>

<script>
const menuBtn = document.getElementById("menuBtn");
const menu = document.getElementById("menu");

// เปิด / ปิด เมื่อกดจุด 3 จุด
menuBtn.addEventListener("click", function(e){
    e.stopPropagation();
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
});

// กันไม่ให้คลิกเมนูแล้วปิด
menu.addEventListener("click", function(e){
    e.stopPropagation();
});

// คลิกที่อื่นแล้วปิด
document.addEventListener("click", function(){
    menu.style.display = "none";
});
</script>

</body>
</html>