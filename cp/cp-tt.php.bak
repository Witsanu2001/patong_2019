<?

include ('connect.php');

session_start();

	

if(!isset($_SESSION['user'])) {
	header('Location: index.php');
	die();
}

$user=$_SESSION['user'];

	$sql="select * from tb_user where user_name='$user' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$id = $r['user_id'];
	$user = $r['user_name'];
	$class= $r['user_class'];

if(isset($_GET['start'])){
			$start = $_GET['start'];
		}else{
		$start = '0';
		}
		$limit = '10';
		
		$type=$_GET['type'];
	
	$count=0;
	
	$Qtotal = mysql_query("select * from tb_tt where tt_type='$type' ");
	$total = mysql_num_rows($Qtotal);
	
	$Query = mysql_query("SELECT * FROM tb_tt where tt_type='$type' ORDER BY tt_id DESC LIMIT $start,$limit");
	$totalp = mysql_num_rows($Query);
	
	$page=$_GET['page'];
	
	$sql="select * from tb_type where type_id='$type' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$type_name=$r['type_name'];
	
	if($class == a){

	} else if($class == e){

	} else {
		echo "<script>
			alert('สิทธิ์ของท่านไม่ได้รับอนุญาตให้จัดการส่วนนี้');
			window.location='cp.php';
			</script>";
	die();
	}
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? include"script-head.php";?>
</head>

<body onLoad="java script:history.go(1);" class="bodycp">
<div class="container">
<? include "header.php"; ?>

    <div class="box" style="margin-top:-10px;">

      <form class="form-horizontal" method="post" action="add-tt.php"enctype="multipart/form-data">
  
  <legend>จัดการ : <font color="red"><?=$type_name?> </font></legend>
  
  <p><strong style="color:orange">&raquo; เพิ่มรายการ</strong></p>

    
    <label for="name">เรื่อง :</label><br />
	<input name="name"  type="text" class="form-control" id="name" placeholder="หัวข้อรายการ" /><br />
  


       <label for="exampleInputFile">Picture Upload</label>
    <input type="file" name="fileupload">
    <p class="help-block">ระบบจะปรับความกว้างเป็น 500*310px อัตโนมัติ (ปรับขนาดมาพอดีจะสวยกว่าเยอะนะแจ๊ะ)</p><br />

       <label for="detail">รายละเอียด :</label><br />
	 <textarea id="detail" name="detail" cols="45" rows="10" class="ckeditor"></textarea><br />
 
 <label class="radio-inline">
  <input type="radio" name="slide" value="0" checked="checked"> ไม่ตั้งเป็นสไลด์
</label>
     
<label class="radio-inline">
  <input type="radio" name="slide" value="1"> ตั้งเป็นสไลด์
</label>
<p class="help-block">
หากท่านเลือก "ตั้งเป็นสไลด์" บทความจะแสดงในส่วนของ สไลด์ในหน้าหลัก</p>


  <br />
   <br />
     
     
    <input type="hidden" name="type" id="type" value="<?=$type?>">
  <button type="submit" class="btn btn-default">ตกลง</button>
  
  
</form>
      
      <hr />
      <p><strong>รายการทั้งหมด : <?=$total?> รายการ</strong></p>
<table align="center" cellpadding="10" cellspacing="0" width="600px" class="table table-bordered table-hover">
<tr style="color:black; font-weight:bold; text-align:center;" class="info">
	<td width="7%">ลำดับที่</td>
    <td width="35%">ภาพ</td>
    <td width="35%">เรื่อง</td>
    <td width="10%">ตั้งเป็นสไลด์</td>
    <td width="7%">แก้ไข</td>
    <td width="7%">ลบ</td>
 </tr>

<?
while($r=mysql_fetch_array($Query)){
$tt_id = $r['tt_id'];
$tt_name= $r['tt_name'];
$tt_detail=$r['tt_detail'];
$tt_date=$r['tt_date'];
$tt_type=$r['tt_type'];
$tt_img=$r['tt_img'];
$tt_slide=$r['tt_slide'];

$sql="select * from tb_type where type_id='$tt_type' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$type_name=$r['type_name'];
	
	

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
	<td><img src='../images/tt/$tt_img' border=0 class='img-thumbnail'></td>
    <td>$tt_name</td>
	<td>";
	if($tt_slide=='1'){
		echo"<center><span class='glyphicon glyphicon-star'></span></center>";
	}
	
	echo"</td>
    <td align='center'><a href=\"edit-tt.php?id_edit=$tt_id&type=$tt_type\"><button class='btn btn-default'><span class='glyphicon glyphicon-edit'></span></button></a></td>
    <td align='center'><a href=\"del-tt.php?id_del=$tt_id&type=$tt_type\" onclick=\"return confirm('คุณต้องการลบจริงหรือไม่')\"><button class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button></a></td>
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
	echo " <a href='?start=".$limit*($i-1)."&page=$i'><B>[$i]</B></A>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
	} else {
	echo " <a href='?start=".$limit*($i-1)."&page=$i'><B>[$i]</B></A>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
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