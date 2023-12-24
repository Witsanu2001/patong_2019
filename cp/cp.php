<?php
session_start();

if(!isset($_SESSION['user'])) {
	header('Location: index.php');
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "script-head.php"; ?>
</head>

<body class="bodycp">
<div class="container">
<?php include "header.php"; ?>
    <div class="box" style="margin-top:-10px;">
    <div class="inner">
    <center><img src="../images/logo.png" /></center>
    </div>
    </div>
    <?php include "footer.php"; ?>
</div>
</body>
</html>
