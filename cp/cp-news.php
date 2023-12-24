<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];

$sql = "SELECT * FROM tb_user WHERE user_name='$user'";
$result = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($result);

$id = $r['user_id'];
$user = $r['user_name'];
$class = $r['user_class'];

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '10';

$type = $_GET['type'];

$count = 0;

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_news WHERE news_type='$type'");
$total = mysqli_num_rows($Qtotal);

$Query = mysqli_query($conn, "SELECT * FROM tb_news WHERE news_type='$type' ORDER BY news_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    // If 'page' parameter is not provided in the URL, set a default value or handle it as needed.
    $page = 1; // For example, setting the default page number to 1.
}


$sql = "SELECT * FROM tb_type WHERE type_id='$type'";
$result = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($result);

$type_name = $r['type_name'];

if ($class != 'a' && $class != 'c') {
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
<?php include "script-head.php";?>
</head>

<body onLoad="java script:history.go(1);" class="bodycp">
<div class="container">
<?php include "header.php"; ?>

    <div class="box" style="margin-top:-10px;">

      <form class="form-horizontal" method="post" action="add-news.php"enctype="multipart/form-data">
  
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

 <?php
while ($r = mysqli_fetch_array($Query)) {
    $news_id = $r['news_id'];
    $news_name = $r['news_name'];
    $news_detail = $r['news_detail'];
    $news_date = $r['news_date'];
    $news_type = $r['news_type'];
    $news_img = $r['news_img'];
    $news_slide = $r['news_slide'];

    $sql = "SELECT * FROM tb_type WHERE type_id='$news_type'";
    $result = mysqli_query($conn, $sql);
    $type_r = mysqli_fetch_array($result);
    
    $type_name = $type_r['type_name'];

    $count++;

    // Rest of your code...

    echo "
     <tr>
        <!-- Your table row content -->
     </tr>";
}

mysqli_close($conn);
?>

  </table>
  <?php
echo "<br />";
echo "<center>";

$page = ceil($total / $limit);

echo "ทั้งหมด $page หน้า :";

function generatePaginationLink($i, $limit) {
    if (isset($_GET['page']) && $_GET['page'] == $i) {
        return " <a href='?start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
    } else {
        return " <a href='?start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
    }
}
	

for ($i = 1; $i <= $page; $i++) {
    echo generatePaginationLink($i, $limit);
}

echo "</center>";
echo "<br />";
?>


    </div>
</div>
    <?php include "footer.php";?>
</div>
</body>
</html>