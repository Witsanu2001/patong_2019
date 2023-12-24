<?php
include ('cp/connect.php');

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '20';

$count = 0;

$id = $_GET['id'];

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_news");
$total = mysqli_num_rows($Qtotal);

$Qnews = mysqli_query($conn, "SELECT * FROM tb_news WHERE news_type='$id' ORDER BY news_id DESC LIMIT $start,$limit");
$totalnews = mysqli_num_rows($Qnews);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

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
                <?php
                $id = $_GET['id'];

                $sql = "SELECT * FROM tb_type WHERE type_id='$id'";
                $result = mysqli_query($conn, $sql);
                $r = mysqli_fetch_array($result);

                $type_id = $r['type_id'];
                $type_name = $r['type_name'];
                ?>
                <div class="col-cr">
                    <div class="toppic"><?= $type_name ?></div>

                    <div style="margin-top:0px; padding:10px;">
                        <?php
                        while ($r = mysqli_fetch_array($Qnews)) {
                            $news_id = $r['news_id'];
                            $news_name = $r['news_name'];
                            $news_detail = $r['news_detail'];
                            $news_date = $r['news_date'];
                            $news_type = $r['news_type'];
                            $news_img = $r['news_img'];

                            $count++;

                            $bgColor1 = "white";
                            $bgColor2 = "#f0ffdb";

                            $bgColor = (($count % 2) == 0) ? $bgColor2 : $bgColor1;

                            if (!isset($page)) {
                                $page = 1;
                            }

                            $numid = $count + (($page - 1) * 10);

                            $time = date('d/m/Y', strtotime($news_date));

                            echo "<a href='news.php?id=$news_id'>
                                <div class='boxnews2'>
                                    <div class='col-news-left'>
                                        <center><img src='images/news/$news_img' width='270' height='167' border='1'></center>
                                    </div>
                                    <div class='col-news-right'>
                                        <div class='news-title'>" . mb_substr(strip_tags($news_name), 0, 100, 'UTF-8') . "</div><br />
                                        <span class='news-detail'>" . mb_substr(strip_tags($news_detail), 0, 300, 'UTF-8') . ' ...' . "</span><br />
                                        <div class='readmore-news'><span class='glyphicon glyphicon-calendar'></span> $news_date</div><br />
                                    </div>
                                </div>
                            </a>";
                        }

                        ?>

                        <div class="pagenav">
                            <?php
                            echo "<center>";

                            $page = ceil($total / $limit);

                            echo "ทั้งหมด $page หน้า :";

							
							if (isset($_GET['page'])) {
								for ($i = 1; $i <= $page; $i++) {
									if ($_GET['page'] == $i) {
										echo " <a href='?id=$news_type&start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
									} else {
										echo " <a href='?id=$news_type&start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
									}
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
