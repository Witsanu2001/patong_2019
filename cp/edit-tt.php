<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];

$sql = "SELECT * FROM tb_user WHERE user_name='$user'";
$result = mysqli_query($connect, $sql);
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

$count = 0;

$type = $_GET['type'];

$Qtotal = mysqli_query($connect, "SELECT * FROM tb_tt WHERE tt_type='$type'");
$total = mysqli_num_rows($Qtotal);

$Query = mysqli_query($connect, "SELECT * FROM tb_tt WHERE tt_type='$type' ORDER BY tt_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

$page = $_GET['page'];

$sql = "SELECT * FROM tb_type WHERE type_id='$type'";
$result = mysqli_query($connect, $sql);
$r = mysqli_fetch_array($result);

$type_name = $r['type_name'];

if ($class == 'a') {

} elseif ($class == 'c') {

} else {
    echo "<script>
            alert('สิทธิ์ของท่านไม่ได้รับอนุญาตให้จัดการส่วนนี้');
            window.location='cp.php';
          </script>";
    exit();
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include "script-head.php"; ?>
</head>

<body onLoad="javascript:history.go(1);" class="bodycp">
<div class="container">
    <?php include "header.php"; ?>
    <?php
        $id_edit = $_GET['id_edit'];
        $sql = "SELECT * FROM tb_tt WHERE tt_id='$id_edit'";
        $result = mysqli_query($connect, $sql);
        $r = mysqli_fetch_array($result);

        $tt_id = $r['tt_id'];
        $tt_name = $r['tt_name'];
        $tt_type = $r['tt_type'];
        $tt_detail = $r['tt_detail'];
        $tt_img = $r['tt_img'];
        $tt_slide = $r['tt_slide'];
    ?>
    <div class="box" style="margin-top:-10px;">
        <form class="form-horizontal" method="post" action="edit-tt2.php" enctype="multipart/form-data">
            <legend>จัดการ : <font color="red"><?= $type_name ?></font></legend>
            <p class="text-right"><a href="cp-tt.php?type=<?= $type ?>" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ</a></p>
            <p><strong style="color:orange">&raquo; แก้ไขรายการ</strong></p>

            <label for="name">เรื่อง :</label><br />
            <input name="name" type="text" class="form-control" id="name" placeholder="" value="<?= $tt_name ?>" /><br />

            <?php
            if ($tt_img != " ") {
                echo "<img src='../images/tt/$tt_img' border=0>";
                echo "<br><br><input type='checkbox' name='chkdel' id='chkdel' value='Y'> ลบภาพนี้<br>";
            } else {
                echo "<input type='file' name='fileupload' >";
                echo "<p class='help-block'>ระบบจะปรับความกว้างเป็น 500*310 px อัตโนมัติ (ปรับขนาดมาพอดีจะสวยกว่าเยอะนะแจ๊ะ)</p>";
            }
            ?>

            <br />

            <label for="detail">รายละเอียด :</label><br />
            <textarea id="detail" name="detail" cols="45" rows="10" class="ckeditor"><?= $tt_detail ?></textarea><br />

            <?php if ($tt_slide == "0") : ?>
                <label class='radio-inline'>
                    <input type='radio' name='slide' value='0' checked='checked'> ไม่ตั้งเป็นสไลด์
                </label>

                <label class='radio-inline'>
                    <input type='radio' name='slide' value='1'> ตั้งเป็นสไลด์
                </label>
            <?php elseif ($tt_slide == "1") : ?>
                <label class='radio-inline'>
                    <input type='radio' name='slide' value='0'> ไม่ตั้งเป็นสไลด์
                </label>

                <label class='radio-inline'>
                    <input type='radio' name='slide' value='1' checked='checked'> ตั้งเป็นสไลด์
                </label>
            <?php endif; ?>

            <p class="help-block">
                หากท่านเลือก "ตั้งเป็นสไลด์" บทความจะแสดงในส่วนของ สไลด์ในหน้าหลัก
            </p>

            <br />
            <br />

            <input type="hidden" name="type" id="type" value="<?= $type ?>">
            <input type="hidden" name="id_edit" value="<?= $id_edit ?>">
            <input type="hidden" name="delimg" id="delimg" value="<?= $tt_img ?>">
            <input type="hidden" name="tt_img" id="slide_img" value="<?= $tt_img ?>">
            <button type="submit" class="btn btn-default">ตกลง</button>

        </form>

        <hr />
        <p><strong>มีข่าวทั้งหมด : <?= $total ?> รายการ</strong></p>
        <!-- Table Data Here -->
    </div>
    <?php include "footer.php"; ?>
</div>
</body>
</html>
