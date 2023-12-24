<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    die();
}

$user = $_SESSION['user'];
include "script-head.php";

include 'connect.php';

$sql = "SELECT * FROM tb_user WHERE user_name='$user'";
$result = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($result);

$id = $r['user_id'];
$user = $r['user_name'];
$pass = $r['user_pass'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include "script-head.php"; ?>

</head>

<body onLoad="javascript:history.go(1);" class="bodycp">
    <div class="container">
        <?php include "header.php"; ?>
        <div class="box" style="margin-top: -10px;">
            <legend>เปลี่ยนรหัสผ่าน</legend>
            <form class="form-horizontal" method="post" action="edit-user2.php" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">User</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="user" name="user" placeholder="" disabled value="<?= $user ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="" value="<?= $pass ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-3">
                        <button type="submit" class="btn btn-default">Change Password</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <?php include "footer.php"; ?>
</div>
</body>
</html>
