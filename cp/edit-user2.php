<?php
session_start();
?>
<html>
<head>
    <title>กรุณารอสักครู่...</title>
    <style type="text/css">
        <!--
        a:link {
            color: #0066FF;
            text-decoration: none;
        }
        a:visited {
            text-decoration: none;
            color: #0066FF;
        }
        a:hover {
            text-decoration: none;
            color: #33CCFF;
        }
        a:active {
            text-decoration: none;
        }
        -->
    </style>
</head>
<body>

<?php
include('connect.php');

$id_edit = '1'; // เปลี่ยน id_edit ตามที่ต้องการแก้ไข

$user_id = $_POST['id'];
$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "UPDATE tb_user SET user_pass=? WHERE user_id=?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "si", $pass, $id_edit);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='cp-user.php' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
            alert('แก้ไขเรียบร้อย');
            window.location='cp-user.php';
          </script>";
} else {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='cp-user.php' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
            alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
            window.location='cp-user.php';
          </script>";
}

mysqli_close($connect);
?>
</body>
</html>
