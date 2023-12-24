<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

$user = $_SESSION['user'];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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

$type = $_GET['type'];

$count = 0;

$Qtotal = mysqli_query($conn, "SELECT * FROM tb_tt WHERE tt_type='$type'");
$total = mysqli_num_rows($Qtotal);

$Query = mysqli_query($conn, "SELECT * FROM tb_tt WHERE tt_type='$type' ORDER BY tt_id DESC LIMIT $start,$limit");
$totalp = mysqli_num_rows($Query);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$sql = "SELECT * FROM tb_type WHERE type_id='$type'";
$result = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($result);

$type_name = $r['type_name'];

if ($class == 'a') {

} else if ($class == 'e') {

} else {
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
    <?php include "script-head.php"; ?>
</head>
<body onLoad="java script:history.go(1);" class="bodycp">
<div class="container">
    <?php include "header.php"; ?>
    <div class="box" style="margin-top:-10px;">
        <!-- Rest of your HTML content -->
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
