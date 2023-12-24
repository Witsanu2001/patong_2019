<?php
include ('cp/connect.php');

if(isset($_GET['start'])){
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '20';

$count = 0;

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_article");
$total = mysqli_num_rows($Qtotal);

$Qnews = mysqli_query($conn, "SELECT * FROM tb_article WHERE art_type='6' OR art_type='7' ORDER BY art_id DESC LIMIT $start,$limit");
$totalnews = mysqli_num_rows($Qnews);

$page = isset($_GET['page']) ? $_GET['page'] : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "script-head.php"; ?>
</head>

<body>
<div class="border-top"></div>
<div class="main">
    <div class="content">
        <div class="header">
            <?php include "topbanner.php"; ?>
            <?php include "header.php"; ?>
            <div class="row-main">
                <div class="col-left">
                    <?php include "menu-left.php"; ?>
                    <?php include "link.php"; ?>
                </div><!---left--->
                <div class="col-cr">
                    <div class="toppic">รับสมัครงาน</div>
                    <div style="margin-top:0px; padding:10px;">
                        <?php
                        while($r=mysqli_fetch_array($Qnews)){
                            $art_id = $r['art_id'];
                            $art_name= $r['art_name'];
                            $art_detail=$r['art_detail'];
                            $art_date=$r['art_date'];
                            $art_type=$r['art_type'];

                            $sql="SELECT * FROM tb_type WHERE type_id='$art_type'";
                            $result=mysqli_query($conn, $sql);
                            $type_row=mysqli_fetch_array($result);

                            $type_id=$type_row['type_id'];
                            $type_name=$type_row['type_name'];

                            $count++;
                            $bgColor1="white";
                            $bgColor2="#f0ffdb";
                            $bgColor = (($count%2) == 0) ? $bgColor2 : $bgColor1;

                            if(!isset($page)){
                                $page = 1;
                            }

                            $numid=$count+(($page-1)*10);
                            $time=date('d/m/Y', strtotime($art_date));

                            echo "<a href='article.php?id=$art_id'>
                                    <div class='boxnews2'>
                                        <div class='col-news-left'>
                                            <center><img src='images/article-pic.png' width='270' height='167' border='1'></center>
                                        </div>
                                        <div class='col-news-right'>
                                            <div class='news-title'>";
                                                echo mb_substr(strip_tags($art_name), 0, 100, 'UTF-8');
                                            echo "</div><br />
                                            <span class='news-detail'>";
                                                echo mb_substr(strip_tags($art_detail), 0, 300, 'UTF-8') . ' ...';
                                            echo "</span><br />
                                            <div class='readmore-news'>
                                                <span class='glyphicon glyphicon-calendar'></span> $art_date
                                                <div style='float:right'>
                                                    <span class=\"glyphicon glyphicon-file\"></span> $type_name
                                                </div>
                                            </div><br />
                                        </div>
                                    </div>
                                </a>";
                        }
                        ?>

                        <div class="pagenav">
                            <?php
                            echo "<center>";

                            $page = ceil($total/$limit);
                            echo "ทั้งหมด $page หน้า :";

                            for($i=1;$i<=$page;$i++){
                                if($_GET['page']==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
                                    echo " <a href='?start=".$limit*($i-1)."&page=$i'><B>[$i]</B></A>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
                                } else {
                                    echo " <a href='?start=".$limit*($i-1)."&page=$i'><B>[$i]</B></A>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
                                }
                            }

                            echo "</center>";
                            echo "<br />";
                            ?>
                        </div>
                    </div>
                </div>
            </div><!---row-main--->
            <?php include "footer.php"; ?>
        </div><!---content--->
    </div><!---main--->
    <?php include "script-foot.php"; ?>
</body>
</html>
