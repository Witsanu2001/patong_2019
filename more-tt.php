<?php
include('cp/connect.php');

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '20';

$count = 0;

$id = $_GET['id'];

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_tt");
$total = mysqli_num_rows($Qtotal);

$Qtt = mysqli_query($conn, "SELECT * FROM tb_tt WHERE tt_type='$id' ORDER BY tt_id DESC LIMIT $start,$limit");
$totaltt = mysqli_num_rows($Qtt);

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
                <div class="col-cr">
                    <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tb_type WHERE type_id='$id' ";
                    $result = mysqli_query($conn, $sql);
                    $r = mysqli_fetch_array($result);

                    $type_id = $r['type_id'];
                    $type_name = $r['type_name'];
                    ?>
                    <div class="toppic"><?= $type_name ?></div>
                    <div style="margin-top:0px; padding:10px;">
                        <?php
                        while ($r = mysqli_fetch_array($Qtt)) {
                            // Fetching your data and generating content here
                            // ...
                        }
                        ?>
                        <div class="pagenav">
							<?php
							echo "<center>";
							$page = ceil($total / $limit);
							echo "ทั้งหมด $page หน้า :";
							
							for ($i = 1; $i <= $page; $i++) {
								$tt_type = isset($_GET['id']) ? $_GET['id'] : ''; // Define $tt_type here
								
								if (isset($_GET['page']) && $_GET['page'] == $i) {
									echo " <a href='?id=$tt_type&start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
								} else {
									echo " <a href='?id=$tt_type&start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
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
