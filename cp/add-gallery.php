<?
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

<?

include ('connect.php');

$ga_id=$_POST[ga_id];
$ga_img=$_POST[ga_img];
$ga_group=$_POST[group];
$pid=$_REQUEST[pid];

$sql="insert into tb_gallery values(0,'$ga_img','$ga_group')";
		$result=mysql_db_query($dbname,$sql) or die (mysql_error());

		$pid=mysql_insert_id();
		
	$path='../images/gallery/';
 	$file=$_FILES['fileupload']['name'];
  	$file_type=substr($file,strlen($file)-4,strlen($file));
    $pic_name='ga_'.$pid.strtoupper($file_type);
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
		
		
		
		
		
		$sql="replace into tb_gallery values($pid,'$pic_name','$ga_group')";
		$result = mysql_db_query($dbname,$sql);
		

		if($result) {

			echo "<script>
			window.location='cp-gallery.php';
			</script>";
			
		} else {
			echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
			echo "<center><a href='cp-gallery.php' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
			echo "<script>
			alert('ไม่สามารถเพิ่มข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
			window.location='cp-gallery.php';
			</script>";
		}
		
?>
</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>