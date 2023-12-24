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
$news_name=$_POST['name'];
$news_detail= $_POST['detail'];
$news_type=$_POST['type'];
$news_img=$_POST['news_img'];
$news_slide=$_POST['slide'];

$id_edit=$_POST['id_edit'];

$id_edit=$_REQUEST[id_edit];
$chkdel=$_POST[chkdel];



if($chkdel=="Y"){
		$sql="update tb_news set
		news_name='$news_name',
		news_detail='$news_detail',
		news_type='$news_type',
		news_img=' ',
		news_slide='$news_slide'
		where news_id='$id_edit' ";
		$result = mysql_db_query($dbname,$sql);
		if($result){
		echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
			echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
			echo "<script>
			alert('แก้ไขเรียบร้อย');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
			
		} else {
			echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
			echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
			echo "<script>
			alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
		}
 


		
} else if( $_FILES['fileupload'] ) {
	

		
	$path='../images/news/';
 	$file=$_FILES['fileupload']['name'];
  	$file_type=substr($file,strlen($file)-4,strlen($file));
    $pic_name='news_'.$id_edit.strtoupper($file_type);
	$pic=$pic_name;
	
	copy ($_FILES['fileupload']['tmp_name'],$path.$pic_name); 
	
		
	$images = $path.$pic_name;
	  $width = 500;
	   $size = getimagesize($images);
	    $height = 310;
		
			/*$images = $path.$pic_name;
	  $width = 700;
	   $size = getimagesize($images);
	    $height = round($width*$size[1]/$size[0]);*/
		
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
		

		
		$sql="update tb_news set news_name='$news_name', news_detail='$news_detail' , news_type='$news_type', news_img='$pic_name' , news_slide='$news_slide' where news_id='$id_edit' ";
		
	} else{
		$sql="update tb_news set
		news_id='$id_edit',
		news_name='$news_name',
		news_detail='$news_detail',
		news_type='$news_type',
		news_slide='$news_slide'
		where news_id='$id_edit' ";
	}
		$result = mysql_db_query($dbname,$sql);
		
		if($result) {

			echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
			echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
			echo "<script>
			alert('แก้ไขเรียบร้อย');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
			
		} else {
			echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
			echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
			echo "<script>
			alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
		}

		
mysql_close();
?>
</body>
</html>