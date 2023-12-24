<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

$user = $_SESSION['user'];

$sql = "SELECT * FROM tb_user WHERE user_name='$user' ";
$result = mysqli_query($conn, $sql); // assuming $conn is your database connection
$r = mysqli_fetch_array($result, MYSQLI_ASSOC);

$id = $r['user_id'];
$user = $r['user_name'];
$class = $r['user_class'];

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '10';

$count = 0;

$type = isset($_GET['type']) ? $_GET['type'] : null;

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_news WHERE news_type='$type'");
$total = mysqli_num_rows($Qtotal);

$Query = mysqli_query($conn, "SELECT * FROM tb_news WHERE news_type='$type' ORDER BY news_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

$page = isset($_GET['page']) ? $_GET['page'] : null;

$sql = "SELECT * FROM tb_type WHERE type_id='$type'";
$result = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($result && mysqli_num_rows($result) > 0) {
    $r = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $type_name = $r['type_name'];
} else {
    // Handle the case where the query didn't return any results
    $type_name = "Unknown"; // or whatever default value you want to set
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include "script-head.php"; ?>
</head>

<body onLoad="java script:history.go(1);" class="bodycp">
    <div class="container">
        <?php include "header.php"; ?>
        <?php
        $id_edit = isset($_GET['id_edit']) ? $_GET['id_edit'] : null;
        if ($id_edit !== null) {
            // Further code to handle the retrieval of news information based on $id_edit
        } else {
            // Handle the case where 'id_edit' is not set
            // For instance, redirect the user or display an error message
        }
        $sql = "SELECT * FROM tb_news WHERE news_id='$id_edit'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $r = mysqli_fetch_assoc($result); // Use mysqli_fetch_assoc to fetch as an associative array
        
            // Access the array keys from $r
            $news_id = $r['news_id'];
            $news_name = $r['news_name'];
            $news_type = $r['news_type'];
            $news_detail = $r['news_detail'];
            $news_img = $r['news_img'];
            $news_slide = $r['news_slide'];
        } else {
            // Handle the case where the query didn't return any rows or encountered an error
        }
        
        ?>

        <div class="box" style="margin-top:-10px;">

            <form class="form-horizontal" method="post" action="edit-news2.php" enctype="multipart/form-data">

            <legend>จัดการ : <font color="red"><?php= $type_name ?></font></legend>

                <p class="text-right"><a href="cp-news.php?type=<?= $type ?>" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ</a></p>

                <p><strong style="color:orange">&raquo; แก้ไขรายการ</strong></p>


                <label for="name">เรื่อง :</label><br />
                <input name="name" type="text" class="form-control" id="name" placeholder="" value="<?= isset($news_name) ? $news_name : '' ?>" /><br />


                <?php
                if (isset($news_img) && $news_img !== "") {
                    echo "<img src='../images/news/$news_img' border='0'>";
                    echo "<br><br><input type='checkbox' name='chkdel' id='chkdel' value='Y'> ลบภาพนี้<br>";
                } else {
                    echo "<input type='file' name='fileupload'>";
                    echo "<p class='help-block'>ระบบจะปรับความกว้างเป็น 500*310 px อัตโนมัติ (ปรับขนาดมาพอดีจะสวยกว่าเยอะนะแจ๊ะ)</p>";
                }
                ?>


                <br />


                <label for="detail">รายละเอียด :</label><br />
                <textarea id="detail" name="detail" cols="45" rows="10" class="ckeditor"><?= isset($news_detail) ? $news_detail : '' ?></textarea><br />


                <?php if (isset($news_slide) && $news_slide == "0") {
                    echo "<label class='radio-inline'>
                        <input type='radio' name='slide' value='0' checked='checked'> ไม่ตั้งเป็นสไลด์
                    </label>

                    <label class='radio-inline'>
                        <input type='radio' name='slide' value='1'> ตั้งเป็นสไลด์
                    </label>";
                } else if (isset($news_slide) && $news_slide == "1") {
                    echo "<label class='radio-inline'>
                        <input type='radio' name='slide' value='0' > ไม่ตั้งเป็นสไลด์
                    </label>

                    <label class='radio-inline'>
                        <input type='radio' name='slide' value='1' checked='checked'> ตั้งเป็นสไลด์
                    </label>";
                }
                ?>

                <p class="help-block">
                    หากท่านเลือก "ตั้งเป็นสไลด์" บทความจะแสดงในส่วนของ สไลด์ในหน้าหลัก</p>

                <br />
                <br />

                <input type="hidden" name="type" id="type" value="<?= $type ?>">
                <input type="hidden" name="id_edit" value="<?= $id_edit ?>">
                <input type="hidden" name="delimg" id="delimg" value="<?= $news_img ?>">
                <input type="hidden" name="news_img" id="slide_img" value="<?= $news_img ?>">
                <button type="submit" class="btn btn-default">ตกลง</button>

            </form>

            <hr />
            <p><strong>มีข่าวทั้งหมด : <?= $total ?> รายการ</strong></p>
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
                while ($r = mysqli_fetch_array($Query, MYSQLI_ASSOC)) {
                    $news_id = $r['news_id'];
                    $news_name = $r['news_name'];
                    $news_detail = $r['news_detail'];
                    $news_date = $r['news_date'];
                    $news_type = $r['news_type'];
                    $news_img = $r['news_img'];
                    $news_slide = $r['news_slide'];

                    $sql = "SELECT * FROM tb_type WHERE type_id='$news_type'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $type_name = $row['type_name'];

                    $count++;

                    $bgColor1 = "white";
                    $bgColor2 = "#f0ffdb";

                    $bgColor = (($count % 2) == 0) ? $bgColor2 : $bgColor1;

                    if (!isset($page)) {
                        $page = 1;
                    }

                    $numid = $count + (($page - 1) * 10);

                    echo "
                    <tr>
                        <td align='center'>$numid</td>
                        <td><img src='../images/news/$news_img' border=0 class='img-thumbnail'></td>
                        <td>$news_name</td>
                        <td>";
                    if ($news_slide == '1') {
                        echo "<center><span class='glyphicon glyphicon-star'></span></center>";
                    }

                    echo "</td>
                        <td align='center'><a href=\"edit-news.php?id_edit=$news_id&type=$news_type\"><button class='btn btn-default'><span class='glyphicon glyphicon-edit'></span></button></a></td>
                        <td align='center'><a href=\"del-news.php?id_del=$news_id&type=$news_type\" onclick=\"return confirm('คุณต้องการลบจริงหรือไม่')\"><button class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button></a></td>
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
    <?php include "footer.php"; ?>
</body>

</html>
