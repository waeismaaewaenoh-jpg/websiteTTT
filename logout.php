<?php
session_start();
session_destroy(); // ล้างข้อมูลการ Login ทั้งหมด
header("Location: login.html");
exit();
?>