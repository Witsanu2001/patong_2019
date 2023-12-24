<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];

$sql = "SELECT * FROM tb_user WHERE user_name='$user'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
$r = mysqli_fetch_array($result, MYSQLI_ASSOC);

$id = $r['user_id'];
$user = $r['user_name'];
$class = $r['user_class'];
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

        $sql = "SELECT * FROM tb_page WHERE page_id='$id_edit'";
		$result = mysqli_query($conn, $sql);

		if ($result && mysqli_num_rows($result) > 0) {
			$r = mysqli_fetch_array($result, MYSQLI_ASSOC);

			$page_id = $r['page_id'];
			$page_name = $r['page_name'];
			$page_detail = $r['page_detail'];

			// ดำเนินการต่อไปตามต้องการ
		} else {
			// หากไม่มีข้อมูลจากการ query ให้แสดงข้อความแจ้งเตือนหรือทำการแก้ไขตามที่ต้องการ
			echo "ไม่พบข้อมูลหน้าที่ต้องการ";
		}

        ?>

		<div class="box" style="margin-top:-10px;">
			<form class="form-horizontal" method="post" action="edit-page.php" enctype="multipart/form-data">
				<?php if(isset($page_name) && isset($page_detail)): ?>
					<legend>จัดการหน้า : <?= $page_name ?></legend>
					<div class="alert alert-info" role="alert">
						<b>กำลังแก้ไขหน้า : <?= $page_name ?></b>
						<textarea id="detail" name="detail" cols="45" rows="10" class="ckeditor"><?= $page_detail ?></textarea><br />
						<input type="hidden" id="id_edit" name="id_edit" value="<?= $page_id ?>" />
						<button type="submit" class="btn btn-default">บันทึก</button>
					</div>
				<?php else: ?>
					<p>ไม่พบข้อมูลหน้า</p>
				<?php endif; ?>
			</form>
		</div>


        <?php include "footer.php"; ?>
    </div>
</body>

</html>
