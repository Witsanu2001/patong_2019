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

include 'connect.php';
$art_name = $_POST['name'];
$art_detail = $_POST['detail'];
$art_type = $_POST['type'];

$id_edit = $_POST['id_edit'];

$id_edit = $_REQUEST['id_edit'];

$sql = "UPDATE tb_article SET art_name='$art_name', art_detail='$art_detail', art_type='$art_type' WHERE art_id='$id_edit'";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-article.php?id_edit=$id_edit&type=$art_type'><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
    alert('แก้ไขเรียบร้อย');
    window.location='edit-article.php?id_edit=$id_edit&type=$art_type';
    </script>";
} else {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-article.php?id_edit=$id_edit&type=$art_type'><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
    alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
    window.location='edit-article.php?id_edit=$id_edit&type=$art_type';
    </script>";
}

mysqli_close($conn);
?>
</body>
</html>
