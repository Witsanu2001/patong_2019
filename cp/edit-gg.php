<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

include('connect.php');

if (isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '10';

$count = 0;

$id_gg = $_GET['id_gg'];

$Qtotal = mysqli_query($link, "select * from tb_gallery where ga_group='$id_gg'");
$total = mysqli_num_rows($Qtotal);

$Query = mysqli_query($link, "SELECT * FROM tb_gallery where ga_group='$id_gg' ORDER BY ga_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

$page = $_GET['page'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include "script-head.php"; ?>
</head>

<body onload="javascript:history.go(1);" class="bodycp">
    <div class="container">
        <?php include "header.php"; ?>
        <?php
        $id_edit = $_GET[id_edit];

        $sql = "select * from tb_gallery where ga_id='$id_edit' ";
        $result = mysqli_query($link, $sql);
        $r = mysqli_fetch_array($result);

        $ga_id = $r['ga_id'];
        $ga_img = $r['ga_img'];
        $ga_group = $r['ga_group'];
        ?>

        <?php
        $sql = "select * from tb_gallery_group where gg_id='$id_gg' ";
        $result = mysqli_query($link, $sql);
        $r = mysqli_fetch_array($result);

        $gg_id = $r['gg_id'];
        $gg_name = $r['gg_name'];
        ?>
        <div class="box" style="margin-top:-10px;">
            <form class="form-horizontal" method="post" action="edit-gg2.php" enctype="multipart/form-data">

                <legend>จัดการภาพในหมวด : <strong style="color:#b5d333"><?= $gg_name ?></strong></legend>

                <p class="text-right"><a href="cp-gg.php?id_gg=<?= $id_gg ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> เพิ่มภาพ</a></p>

                <p><strong style="color:#b5d333">&raquo; แก้ไขภาพ</strong></p>

                <label for="exampleInputFile">File Upload</label><br />
                <?php
                if ($ga_img != " ") {
                    echo "<img src='../images/gallery/$ga_img' border=0>";
                    echo "<br><br><input type='checkbox' name='chkdel' id='chkdel' value='Y'> ลบภาพนี้<br>";
                } else {
                    echo "<input type='file' name='fileupload' >";
                    echo "<p class='help-block'>ระบบจะปรับความกว้างเป็น 800px อัตโนมัติ</p>";
                }
                ?>
                <br />

                <label for="group">หมวดภาพ :</label><br />
                <select class="form-control w400" name="group" id="group" disabled>
                    <option value='<?= $id_gg ?>'><?= $gg_name ?></option>
                </select><br />
                <input type="hidden" name="id_gg" value="<?= $id_gg ?>">
                <input type="hidden" name="id_edit" value="<?= $id_edit ?>">
                <input type="hidden" name="delimg" id="delimg" value="<?= $ga_img ?>">
                <input type="hidden" name="ga_img" id="ga_img" value="<?= $ga_img ?>">
                <button type="submit" class="btn btn-default">ตกลง</button>
            </form>
            <hr />
            <p><strong>ภาพในหมวดทั้งหมด : <?= $total ?> ภาพ</strong></p>
            <table align="center" cellpadding="10" cellspacing="0" width="600px" class="table table-bordered table-hover">
                <tr style="color:black; font-weight:bold; text-align:center;" class="info">
                    <td width="7%">ลำดับที่</td>
                    <td width="45%">ภาพ</td>
                    <td width="45%">อยู่ในหมวด</td>
                    <td width="7%">แก้ไข</td>
                    <td width="7%">ลบ</td>
                </tr>

                <?php
                while ($r = mysqli_fetch_array($Query)) {
                    $ga_id = $r['ga_id'];
                    $ga_group = $r['ga_group'];
                    $ga_img = $r['ga_img'];

                    $sql = "select * from tb_gallery_group where gg_id='$ga_group' ";
                    $result = mysqli_query($link, $sql);
                    $r = mysqli_fetch_array($result);

                    $gg_name = $r['gg_name'];

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
                            <td align='center'><img src='../images/gallery/$ga_img' border='0'  class='img-thumbnail' width='300'></td>
                            <td align='center'>$gg_name</td>
                            <td align='center'><a href=\"edit-gg.php?id_edit=$ga_id&id_gg=$id_gg\"><button class='btn btn-default'><span class='glyphicon glyphicon-edit'></span></button></a></td>
                            <td align='center'><a href=\"del-gg.php?id_del=$ga_id&id_gg=$id_gg\" onclick=\"return confirm('คุณต้องการลบจริงหรือไม่')\"><button class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button></a></td>
                        </tr>";
                }
                ?>

            </table>
            <br />
            <center>
                <?php
                $page = ceil($total / $limit);

                echo "ทั้งหมด $page หน้า :";

                for ($i = 1; $i <= $page; $i++) {
                    if ($_GET['page'] == $i) {
                        echo " <a href='?start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
                    } else {
                        echo " <a href='?start=" . $limit * ($i - 1) . "&page=$i'><B>[$i]</B></A>";
                    }
                }
                ?>
            </center>
            <br />
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>
