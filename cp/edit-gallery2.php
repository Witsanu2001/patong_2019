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
include ('connect.php');
$ga_id = $_POST['ga_id'];
$ga_img = $_POST['ga_img'];
$ga_group = $_POST['group'];
$id_edit = $_REQUEST['id_edit'];
$chkdel = $_POST['chkdel'];

$id_edit = $_POST['id_edit'];

if ($chkdel == "Y") {
    $sql = "UPDATE tb_gallery SET
            ga_id='$id_edit',
            ga_img=' ',
            ga_group='$ga_group'
            WHERE ga_id='$id_edit'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
        echo "<center><a href='edit-gallery.php?id_edit=$id_edit'><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
        echo "<script>
            alert('แก้ไขเรียบร้อย');
            window.location='edit-gallery.php?id_edit=$id_edit';
            </script>";
    } else {
        echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
        echo "<center><a href='edit-gallery.php?id_edit=$id_edit'><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
        echo "<script>
            alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
            window.location='edit-gallery.php?id_edit=$id_edit';
            </script>";
    }
} else if ($_FILES['fileupload']) {
    $path = '../images/gallery/';
    $file = $_FILES['fileupload']['name'];
    $file_type = substr($file, strlen($file) - 4, strlen($file));
    $pic_name = 'ga_' . $id_edit . strtoupper($file_type);
    $pic = $pic_name;

    copy($_FILES['fileupload']['tmp_name'], $path . $pic_name);

    $images = $path . $pic_name;
    $width = 800;
    $size = getimagesize($images);
    $height = round($width * $size[1] / $size[0]);

    if ($size[2] == 1) {
        $images_orig = imagecreatefromgif($images);
    } else if ($size[2] == 2) {
        $images_orig = imagecreatefromjpeg($images);
    } else {
        $images_orig = imagecreatefrompng($images);
    }

    $photoX = imagesx($images_orig);
    $photoY = imagesy($images_orig);
    $images_fin = imagecreatetruecolor($width, $height);

    imagesavealpha($images_fin, true);
    imagealphablending($images_fin, false);
    $transparentColor = imagecolorallocatealpha($images_fin, 255, 255, 255, 127);
    imagefill($images_fin, 0, 0, $transparentColor);

    imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
    imagepng($images_fin, $images);
    imagedestroy($images_orig);
    imagedestroy($images_fin);

    $sql = "UPDATE tb_gallery SET ga_img='$pic_name', ga_group='$ga_group' WHERE ga_id='$id_edit'";
} else {
    $sql = "UPDATE tb_gallery SET
            ga_id='$id_edit',
            ga_group='$ga_group'
            WHERE ga_id='$id_edit'";
}

$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-gallery.php?id_edit=$id_edit'><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
        alert('แก้ไขเรียบร้อย');
        window.location='edit-gallery.php?id_edit=$id_edit';
        </script>";
} else {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='edit-gallery.php?id_edit=$id_edit'><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
        alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
        window.location='edit-gallery.php?id_edit=$id_edit';
        </script>";
}

mysqli_close($conn);
?>
</body>
</html>
