<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "script-head.php"; ?>
</head>
<body onLoad="java script:history.go(1);" class="bodycp">
<div class="login">
    <center><img src="../images/logo.png"><br/><br/></center>
    <div class="box">
        <form role="form" name="login" method="post" action="login.php">
            <div class="form-group">
                <label for="user">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" id="user" name="user" placeholder="username">
            </div>
            <div class="form-group">
                <label for="pass">รหัสผ่าน</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button> <button type="reset" class="btn btn-default">Reset</button>
        </form>
    </div>
</div>
</body>
</html>
