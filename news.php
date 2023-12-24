<?php
include 'cp/connect.php';
?>
<!DOCTYPE html>
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
                    </div><!--left-->
                    <?php
                    $id = isset($_GET['id']) ? $_GET['id'] : null; // ตรวจสอบและกำหนดค่าให้กับ $id

                    if ($id !== null) { // ตรวจสอบว่ามีค่า $id หรือไม่
                        $sql = "SELECT * FROM tb_news WHERE news_id='$id'";
                        $result = mysqli_query($connection, $sql); // ใช้ mysqli_query() เพื่อสั่ง Query ไปยังฐานข้อมูล

                        if (!$result) {
                            die('Query failed: ' . mysqli_error($connection));
                        }

                        $r = mysqli_fetch_array($result);

                        $news_id = $r['news_id'];
                        $news_name = $r['news_name'];
                        $news_type = $r['news_type'];
                        $news_detail = $r['news_detail'];
                        $news_img = $r['news_img'];
                        $news_slide = $r['news_slide'];
                        $news_date = $r['news_date'];

                        $time = date('j F Y, g:i a', strtotime($news_date));
                        ?>
                        <div class="col-cr">
                            <div class="toppic"><?= $news_name ?></div>
                            <div class="sub-h"><span class="glyphicon glyphicon-calendar"></span> <?= $time ?></div>
                            <div style="margin-top:0px; padding:10px;">
                                <?php
                                echo "<center><img src='images/news/$news_img' /></center><br />";
                                echo str_replace("../upload/files", "upload/files", $news_detail);
                                ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "ไม่พบข้อมูล";
                    }
                    ?>
                </div><!--row-main-->
                <?php include "footer.php"; ?>
            </div><!--content-->
        </div><!--main-->
        <?php include "script-foot.php"; ?>
    </body>
</html>
