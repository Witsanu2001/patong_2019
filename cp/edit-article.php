<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

$user = $_SESSION['user'];

$sql = "SELECT * FROM tb_user WHERE user_name='$user'";
$result = mysqli_query($conn, $sql);
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

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_article WHERE art_type='$type'");
$total = mysqli_num_rows($Qtotal);

$Query = mysqli_query($conn, "SELECT * FROM tb_article WHERE art_type='$type' ORDER BY art_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

$page = $_GET['page'];

$sql = "SELECT * FROM tb_type WHERE type_id='$type'";
$result = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($result);

$type_name = $r['type_name'];

if (($type == '4' || $type == '5') && $class != 'a' && $class != 'b') {
    echo "<script>
            alert('สิทธิ์ของท่านไม่ได้รับอนุญาตให้จัดการส่วนนี้');
            window.location='cp.php';
            </script>";
    die();
} else if (($type == '6' || $type == '7') && $class != 'a' && $class != 'd') {
    echo "<script>
            alert('สิทธิ์ของท่านไม่ได้รับอนุญาตให้จัดการส่วนนี้');
            window.location='cp.php';
            </script>";
    die();
} else if ($type == '8' && $class !== 'a') {
    echo "<script>
            alert('สิทธิ์ของท่านไม่ได้รับอนุญาตให้จัดการส่วนนี้');
            window.location='cp.php';
            </script>";
    die();
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "script-head.php";?>
</head>
<body onLoad="javascript:history.go(1);" class="bodycp">
    <div class="container">
        <?php include "header.php"; ?>
        <?php
            $id_edit = $_GET['id_edit'];
            $sql = "SELECT * FROM tb_article WHERE art_id='$id_edit'";
            $result = mysqli_query($conn, $sql);
            $r = mysqli_fetch_array($result);
            
            $art_id = $r['art_id'];
            $art_name = $r['art_name'];   
            $art_type = $r['art_type'];
            $art_detail = $r['art_detail'];
        ?>
        <div class="box" style="margin-top:-10px;">
            <form class="form-horizontal" method="post" action="edit-article2.php" enctype="multipart/form-data">
                <legend>จัดการ : <font color="red"><?=$type_name?></font></legend>
                <p class="text-right"><a href="cp-article.php?type=<?=$type?>" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ</a></p>
                <p><strong style="color:orange">&raquo; แก้ไขรายการ</strong></p>
                <label for="name">เรื่อง :</label><br />
                <input name="name"  type="text" class="form-control" id="name" placeholder="" value="<?=$art_name?>" /><br />
                <label for="detail">รายละเอียด :</label><br />
                <textarea id="detail" name="detail" cols="45" rows="10" class="ckeditor"><?=$art_detail?></textarea>
                <br />
                <input type="hidden" name="type" id="type" value="<?=$type?>">
                <input type="hidden" name="id_edit" value="<?=$id_edit?>">
                <button type="submit" class="btn btn-default">ตกลง</button>
            </form>
            <!-- ... เหลือส่วนที่เหลือของ HTML ... -->
        </div>
    </div>
    <?php include "footer.php";?>
</body>
</html>
