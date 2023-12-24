<?php
include ('connect.php');
session_start();

if(!isset($_SESSION['user'])) {
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

if(isset($_GET['start'])) {
    $start = $_GET['start'];
} else {
    $start = '0';
}
$limit = '10';

$count = 0;

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_gallery");
$total = mysqli_num_rows($Qtotal);

$page = isset($_GET['page']) ? $_GET['page'] : 1; // ตรวจสอบว่ามีค่า $_GET['page'] หรือไม่ ถ้าไม่มีให้กำหนดให้เป็น 1

$Query = mysqli_query($conn, "SELECT * FROM tb_gallery ORDER BY ga_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

if($class !== 'a') {
    echo "<script>
        alert('สิทธิ์ของท่านไม่ได้รับอนุญาตให้จัดการส่วนนี้');
        window.location='cp.php';
        </script>";

    die();
}
?>
<!-- ตารางหรือส่วนที่ต้องการแสดงผล -->

<br />
<center>
    <?php
    $page = ceil($total / $limit);
    echo "ทั้งหมด $page หน้า :";

    for ($i = 1; $i <= $page; $i++) {
        if ($page == $i) {
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
    <?php include "footer.php";?>
</div>
</body>
</html>