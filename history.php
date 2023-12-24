<?php
include ('./cp/connect.php');
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
                    <div class="toppic">รู้จักองค์กร</div>
                    <div style="margin-top:10px; padding:10px;">
                        <?php
                        // เชื่อมต่อฐานข้อมูล
                        include ('cp/connect.php');

                        $sql = "SELECT * FROM tb_page WHERE page_id='1'";
                        $result = mysqli_query($conn, $sql);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        $r = mysqli_fetch_array($result);

                        $page_id = $r['page_id'];
                        $page_name = $r['page_name'];
                        $page_detail = $r['page_detail'];
                        echo str_replace("../upload/files", "upload/files", $page_detail);

                        // ปิดการเชื่อมต่อฐานข้อมูล
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div><!---row-main--->
            <?php include "footer.php"; ?>
        </div><!---content--->
    </div><!---main--->
    <?php include "script-foot.php"; ?>
</body>
</html>
