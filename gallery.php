<?php
include('cp/connect.php');

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '10';

$count = 0;

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_gallery_group");
$total = mysqli_num_rows($Qtotal);

$Query = mysqli_query($conn, "SELECT * FROM tb_gallery_group ORDER BY gg_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

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
                    <div class="toppic">รวมภาพกิจกรรม</div>
                    <div style="margin-top:10px; padding:10px;">
                        <?php
                        while ($r = mysqli_fetch_array($Query)) {
                            $gg_id = $r['gg_id'];
                            $gg_name = $r['gg_name'];
                            $gg_img = $r['gg_img'];

                            $count++;

                            $bgColor1 = "white";
                            $bgColor2 = "#f0ffdb";

                            $bgColor = (($count % 2) == 0) ? $bgColor2 : $bgColor1;

                            if (!isset($page)) {
                                $page = 1;
                            }

                            $numid = $count + (($page - 1) * 10);

                            echo "
                                <div class='boxgg-align'>
                                    <a href='gallery-pic.php?id=$gg_id'>
                                        <img src='images/gallery-group/$gg_img' border='0'  class='img-thumbnail'><br />
                                        <span class='num'>$numid</span><span class='titlepro'>$gg_name</span>
                                    </a>
                                </div>";
                        }

                        mysqli_close($conn);
                        ?>
                        <div>
                            <?php
                            echo "<br />";
                            echo "<center>";

                            $page = ceil($total / $limit);

                            echo "ทั้งหมด $page หน้า :";

                            for ($i = 1; $i <= $page; $i++) {
                                if ($_GET['page'] == $i) {
                                    echo " <a href='?start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
                                } else {
                                    echo " <a href='?start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
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
