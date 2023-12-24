<?php
include ('./cp/connect.php');

if(isset($_GET['start'])){
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '10';

$count = 0;

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$Qtotal = mysqli_query($connection, "SELECT * FROM tb_tt");
$total = mysqli_num_rows($Qtotal);

$Qtt = mysqli_query($connection, "SELECT * FROM tb_tt WHERE tt_type='9' ORDER BY tt_id DESC LIMIT $start,$limit");
$totaltt = mysqli_num_rows($Qtt);

$page = isset($_GET['page']) ? $_GET['page'] : '1';
$page = intval($page);
?>

<!-- HTML ต่อไปนี้สามารถเขียนต่อได้ -->

<div class="tt">
    <div id="i_containTab">
        <ul id="detail_containTab">
            <li class="detailContent1 animated fadeIn">
                <?php
                while($r=mysqli_fetch_array($Qtt)){
$tt_id = $r['tt_id'];
$tt_name= $r['tt_name'];
$tt_detail=$r['tt_detail'];
$tt_date=$r['tt_date'];
$tt_type=$r['tt_type'];
$tt_img=$r['tt_img'];

$sql = "SELECT * FROM tb_type WHERE type_id='$tt_type'";
$result = mysqli_query($connection, $sql);
$r = mysqli_fetch_array($result);

$type_id = $r['type_id'];
$type_name = $r['type_name'];

	
	

$count++;

$bgColor1="white";
$bgColor2="#f0ffdb";

$bgColor = (($count%2) == 0) ? $bgColor2 : $bgColor1; 

	if(!isset($page)){
		$page = 1;
		}
		
		$numid = $count + (($page - 1) * 10);

$time=date('d-m-Y', strtotime($tt_date));


echo"<a href='tt.php?id=$tt_id' title='$tt_name'><div class='linett'>";
echo mb_substr(strip_tags($tt_name), 0, 75, 'UTF-8') . '';
echo"<div class='linett-date'>$time</div></div></a>";
}



?>
 <div class="clearfix"></div>
                <a href="more-tt.php?id=9"><div class="readmore">เพิ่มเติม <span class="glyphicon glyphicon-plus-sign"></span></div></a>
            </li>
        </ul>
    </div>
</div>