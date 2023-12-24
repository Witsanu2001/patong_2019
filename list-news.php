<?php
include ('./cp/connect.php');

if(isset($_GET['start'])){
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '10';

$count = 0;

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$Qtotal = mysqli_query($conn, "select * from tb_news");
$total = mysqli_num_rows($Qtotal);

$Qnews = mysqli_query($conn, "SELECT * FROM tb_news WHERE news_type='1' ORDER BY news_id DESC LIMIT $start,$limit");
$totalnews = mysqli_num_rows($Qnews);

$Qnews2 = mysqli_query($conn, "SELECT * FROM tb_news WHERE news_type='2' ORDER BY news_id DESC LIMIT $start,$limit");
$totalnews2 = mysqli_num_rows($Qnews2);

$page = isset($_GET['page']) ? $_GET['page'] : '';

?>

<!-- ต่อไปนี้เป็น HTML ที่คุณสามารถเขียนต่อได้ -->

<div class="news">
    <div id="i_containTab">
        <ul id="detail_containTab">
            <li class="detailContent1 animated fadeIn">
                <?php
                while($r=mysqli_fetch_array($Qnews)){
					$news_id = $r['news_id'];
					$news_name= $r['news_name'];
					$news_detail=$r['news_detail'];
					$news_date=$r['news_date'];
					$news_type=$r['news_type'];
					$news_img=$r['news_img'];

$sql="select * from tb_type where type_id='$news_type' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$type_id=$r['type_id'];
	$type_name=$r['type_name'];
	
	

$count++;

$bgColor1="white";
$bgColor2="#f0ffdb";

$bgColor = (($count%2) == 0) ? $bgColor2 : $bgColor1; 

	if(!isset($page)){
		$page = 1;
		}
		
$numid=$count+(($page-1)*10);

$time=date('d-m-Y', strtotime($news_date));


echo"<a href='news.php?id=$news_id' title='$news_name'><div class='linenews'>";
echo mb_substr(strip_tags($news_name), 0, 75, 'UTF-8') . '';
echo"<div class='linenews-date'>$time</div></div></a>";
}



?>
                <div class="clearfix"></div>
                <a href="more-news.php?id=1"><div class="readmore">เพิ่มเติม <span class="glyphicon glyphicon-plus-sign"></span></div></a>
            </li>
        </ul>
    </div>
</div>