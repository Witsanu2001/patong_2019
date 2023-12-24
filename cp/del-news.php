<?php
$id_del = $_GET['id_del'];
$type = $_GET['type'];

include 'connect.php';

$sql = "DELETE FROM tb_news WHERE news_id='$id_del'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: cp-news.php?type=$type");
    exit;
} else {
    echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
    echo "<center><a href='cp-news.php?type=$type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
    echo "<script>
    alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
    window.location='cp-news.php?type=$type';
    </script>";
}
?>
