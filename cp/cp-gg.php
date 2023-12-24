<?
session_start();

if(!isset($_SESSION['user'])) {
	header('Location: index.php');
	die();
}

include ('connect.php');

if(isset($_GET['start'])){
			$start = $_GET['start'];
		}else{
		$start = '0';
		}
		$limit = '10';
	
	$count=0;
	
	$id_gg=$_GET[id_gg];
	
	$Qtotal = mysql_query("select * from tb_gallery where ga_group='$id_gg'");
	$total = mysql_num_rows($Qtotal);
	
	$Query = mysql_query("SELECT * FROM tb_gallery where ga_group='$id_gg' ORDER BY ga_id DESC LIMIT $start,$limit");
	$totalp = mysql_num_rows($Query);
	
	$page=$_GET['page'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? include"script-head.php";?>
</head>

<body onLoad="java script:history.go(1);" class="bodycp">
<div class="container">
<? include "header.php"; ?>
<?
	$sql="select * from tb_gallery_group where gg_id='$id_gg' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$gg_id=$r['gg_id'];
	$gg_name=$r['gg_name'];
	
    ?>


    <div class="box" style="margin-top:-10px;">

      <form class="form-horizontal" method="post" action="add-gg.php"enctype="multipart/form-data">
  
  <legend>จัดการภาพในหมวด : <strong style="color:#b5d333"><?=$gg_name?></strong></legend>
  
  <p><strong style="color:#b5d333">&raquo; เพิ่มภาพ</strong></p>

    <label for="exampleInputFile">File Upload</label>
    <input type="file" name="fileupload">
    <p class="help-block">ระบบจะปรับความกว้างเป็น 800px อัตโนมัติ</p>
    
    <label for="group">หมวดภาพ :</label><br />
	<select class="form-control w400"  name="group" id="group" disabled>
    <option value='<?=$id_gg?>'><?=$gg_name?></option>
    
</select><br />
<input type="hidden" name="id_gg" value="<?=$id_gg?>">
  <button type="submit" class="btn btn-default">ตกลง</button>
  
</form>
      
      <hr />
      <p><strong>ภาพในหมวดทั้งหมด :
<?=$total?> ภาพ</strong></p>
<table align="center" cellpadding="10" cellspacing="0" width="600px" class="table table-bordered table-hover">
<tr style="color:black; font-weight:bold; text-align:center;" class="info">
	<td width="7%">ลำดับที่</td>
    <td width="45%">ภาพ</td>
    <td width="45%">อยู่ในหมวด</td>
    <td width="7%">แก้ไข</td>
    <td width="7%">ลบ</td>
 </tr>

<?
while($r=mysql_fetch_array($Query)){
$ga_id = $r['ga_id'];
$ga_group = $r['ga_group'];
$ga_img = $r['ga_img'];

$sql="select * from tb_gallery_group where gg_id='$ga_group' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$gg_name=$r['gg_name'];

$count++;

$bgColor1="white";
$bgColor2="#f0ffdb";

$bgColor = (($count%2) == 0) ? $bgColor2 : $bgColor1; 

	if(!isset($page)){
		$page = 1;
		}
		
$numid=$count+(($page-1)*10);

echo"
 <tr >
 	<td align='center' >$numid</td>
    <td align='center'><img src='../images/gallery/$ga_img' border='0'  class='img-thumbnail' width='300'></td>
	<td align='center' >$gg_name</td>
    <td align='center'><a href=\"edit-gg.php?id_edit=$ga_id&id_gg=$id_gg\"><button class='btn btn-default'><span class='glyphicon glyphicon-edit'></span></button></a></td>
    <td align='center'><a href=\"del-gg.php?id_del=$ga_id&id_gg=$id_gg\" onclick=\"return confirm('คุณต้องการลบจริงหรือไม่')\"><button class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button></a></td>
</tr>";

}

mysql_close();

?>
  </table>
<?
 echo"<br />";
 
echo"<center>";

$page = ceil($total/$limit);

echo "ทั้งหมด $page หน้า :";

for($i=1;$i<=$page;$i++){
	if($_GET['page']==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
	echo " <a href='?id_gg=$id_gg&start=".$limit*($i-1)."&page=$i'><B>[$i]</B></A>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
	} else {
	echo " <a href='?id_gg=$id_gg&start=".$limit*($i-1)."&page=$i'><B>[$i]</B></A>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
	}
}
echo"</center>";
echo "<br />";

?>

    </div>
</div>
    <? include"footer.php";?>
</div>
</body>
</html>