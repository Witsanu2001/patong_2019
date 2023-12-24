<?php
session_start();

// เมื่อคลิกปุ่ม Logout หรือการกำหนดให้ลบ Session
unset($_SESSION['user']);
session_destroy();

// ทำการ redirect กลับไปยังหน้า index.php
header('Location: index.php');
exit();
?>
