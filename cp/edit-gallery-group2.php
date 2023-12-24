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

$gg_id = $_POST['gg_id'];
$gg_img = $_POST['gg_img'];
$gg_name = $_POST['name'];
$id_edit = $_REQUEST['id_edit'];
$chkdel = $_POST['chkdel'];

$id_edit = $_POST['id_edit'];

if ($chkdel == "Y") {
    $sql = "UPDATE tb_gallery_group SET gg_id='$id_edit', gg_img=' ', gg_name='$gg_name' WHERE gg_id='$id_edit' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
        echo "<center><a href='edit-gallery-group.php?id_edit=$id_edit' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
        echo "<script>
            alert('แก้ไขเรียบร้อย');
            window.location='edit-gallery-group.php?id_edit=$id_edit';
        </script>";
    } else {
        echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
        echo "<center><a href='edit-gallery-group.php?id_edit=$id_edit' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
        echo "<script>
            alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
            window.location='edit-gallery-group.php?id_edit=$id_edit';
        </script>";
    }
} else if ($_FILES['fileupload']) {
    //... (คำสั่งที่เกี่ยวข้องกับการอัปโหลดไฟล์)
    $sql = "UPDATE tb_gallery_group SET gg_img='$pic_name' , gg_name='$gg_name' WHERE gg_id='$id_edit' ";
} else {
    $sql = "UPDATE tb_gallery_group SET gg_id='$id_edit', gg_name='$gg_name' WHERE gg_id='$id_edit' ";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-gallery-group.php?id_edit=$id_edit' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
        alert('แก้ไขเรียบร้อย');
        window.location='edit-gallery-group.php?id_edit=$id_edit';
    </script>";
} else {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-gallery-group.php?id_edit=$id_edit' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
        alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
        window.location='edit-gallery-group.php?id_edit=$id_edit';
    </script>";
}

mysqli_close($conn);
?>
</body>
</html>
