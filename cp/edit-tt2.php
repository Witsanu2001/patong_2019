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
$tt_name = $_POST['name'];
$tt_detail = $_POST['detail'];
$tt_type = $_POST['type'];
$tt_img = $_POST['tt_img'];
$tt_slide = $_POST['slide'];

$id_edit = $_POST['id_edit'];

$chkdel = $_POST['chkdel'];

if ($chkdel === "Y") {
    $sql = "UPDATE tb_tt SET tt_name=?, tt_detail=?, tt_type=?, tt_img='', tt_slide=? WHERE tt_id=?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ssisi", $tt_name, $tt_detail, $tt_type, $tt_slide, $id_edit);
} else {
    $sql = "UPDATE tb_tt SET tt_name=?, tt_detail=?, tt_type=?, tt_slide=? WHERE tt_id=?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ssisi", $tt_name, $tt_detail, $tt_type, $tt_slide, $id_edit);
}

if ($_FILES['fileupload']['size'] > 0) {
    // Code to handle file upload and resizing
    // ...

    $sql = "UPDATE tb_tt SET tt_name=?, tt_detail=?, tt_type=?, tt_img=?, tt_slide=? WHERE tt_id=?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ssisii", $tt_name, $tt_detail, $tt_type, $pic_name, $tt_slide, $id_edit);
}

if (mysqli_stmt_execute($stmt)) {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-tt.php?id_edit=$id_edit&type=$tt_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
            alert('แก้ไขเรียบร้อย');
            window.location='edit-tt.php?id_edit=$id_edit&type=$tt_type';
          </script>";
} else {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-tt.php?id_edit=$id_edit&type=$tt_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
            alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
            window.location='edit-tt.php?id_edit=$id_edit&type=$tt_type';
          </script>";
}

mysqli_close($connect);
?>
</body>
</html>
