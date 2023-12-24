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
$ga_id=$_POST['ga_id'];
$ga_img=$_POST['ga_img'];
$ga_group=$_POST['group'];


$id_edit=$_REQUEST['id_edit'];
$id_gg=$_REQUEST['id_gg'];

$chkdel=$_POST['chkdel'];

$id_edit=$_POST['id_edit'];


if($chkdel=="Y"){
	$sql="update tb_gallery set
	ga_id='$id_edit',
	ga_img=' ',
	ga_group='$id_gg'
	where ga_id='$id_edit' ";
	$result = mysqli_query($link, $sql);

	if($result) {

		echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
		echo "<center><a href='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
		echo "<script>
		alert('แก้ไขเรียบร้อย');
		window.location='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg';
		</script>";

	} else {
		echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
		echo "<center><a href='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
		echo "<script>
		alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
		window.location='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg';
		</script>";
	}

} else if( isset($_FILES['fileupload']) ) {

	$path='../images/gallery/';
	$file=$_FILES['fileupload']['name'];
	$file_type=substr($file,strlen($file)-4,strlen($file));
	$pic_name='ga_'.$id_edit.strtoupper($file_type);
	$pic=$pic_name;

	copy ($_FILES['fileupload']['tmp_name'],$path.$pic_name); 


	$images = $path.$pic_name;
	$width = 800;
	$size = getimagesize($images);
	$height = round($width*$size[1]/$size[0]);

	if($size[2] == 1) {
		$images_orig = imagecreatefromgif($images); //resize รูปประเภท GIF
	} else if($size[2] == 2) {
		$images_orig = imagecreatefromjpeg($images); //resize รูปประเภท JPEG
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

	imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
	imagepng($images_fin, $images); //ชื่อไฟล์ใหม่
	imagedestroy($images_orig);
	imagedestroy($images_fin);


	$sql="update tb_gallery set ga_img='$pic_name' , ga_group='$id_gg' where ga_id='$id_edit' ";

} else {
	$sql="update tb_gallery set
	ga_id='$id_edit',
	ga_group='$id_gg'
	where ga_id='$id_edit' ";
}
$result = mysqli_query($link, $sql);
if($result) {

	echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
	echo "<center><a href='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
	echo "<script>
	alert('แก้ไขเรียบร้อย');
	window.location='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg';
	</script>";

} else {
	echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
	echo "<center><a href='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
	echo "<script>
	alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
	window.location='edit-gg.php?id_edit=$id_edit&id_gg=$id_gg';
	</script>";
}


mysqli_close($link);
?>
</body>
</html>
