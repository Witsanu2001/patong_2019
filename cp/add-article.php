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

$art_id=$_POST[news_id];
$art_name=$_POST[name];
$art_detail=$_POST[detail];
$art_type=$_POST[type];




$sql="insert into tb_article values(0,'$art_name','$art_detail',now(),'$art_type')";
		$result=mysql_db_query($dbname,$sql) or die (mysql_error());

		if($result) {

			echo "<script>
			window.location='cp-article.php?type=$art_type';
			</script>";
			
		} else {
			echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
			echo "<center><a href='cp-article.php?type=$art_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
			echo "<script>
			alert('ไม่สามารถเพิ่มข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
			window.location='cp-article.php?type=$art_type';
			</script>";
		}
		
?>
</body>
</html>