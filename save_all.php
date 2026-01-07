<?php
session_start();
require "../db.php";

$f1 = $_SESSION['form1'];

$stmt = $conn->prepare(
  "INSERT INTO post(title, content, post_date, image)
   VALUES (?, ?, ?, ?)"
);

$stmt->bind_param(
  "ssss",
  $f1['title'],
  $_POST['content'],
  $f1['date'],
  $f1['image']
);

$stmt->send_long_data(3, $f1['image']);
$stmt->execute();

unset($_SESSION['form1']);
header("Location: ../system.php");