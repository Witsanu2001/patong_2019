<?php
session_start();
?>
<html>

<head>
    <title>กรุณารอสักครู่...</title>
    <style type="text/css">
        <!--
        a:link {
            color: #0066FF;
            text-decoration: none;
        }

        a:visited {
            text-decoration: none;
            color: #0066FF;
        }

        a:hover {
            text-decoration: none;
            color: #33CCFF;
        }

        a:active {
            text-decoration: none;
        }

        -->
    </style>
</head>

<body>

    <?php
    include('connect.php');
    $news_name = $_POST['name'];
    $news_detail = $_POST['detail'];
    $news_type = $_POST['type'];
    $news_img = $_POST['news_img'];
    $news_slide = $_POST['slide'];

    $id_edit = $_POST['id_edit'];

    $id_edit = $_REQUEST['id_edit'];
    $chkdel = $_POST['chkdel'];

    if ($chkdel == "Y") {
        $sql = "update tb_news set
		news_name='$news_name',
		news_detail='$news_detail',
		news_type='$news_type',
		news_img=' ',
		news_slide='$news_slide'
		where news_id='$id_edit' ";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
            echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
            echo "<script>
			alert('แก้ไขเรียบร้อย');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
        } else {
            echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
            echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
            echo "<script>
			alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
        }
    } else if ($_FILES['fileupload']) {
        // Your file upload code here using $_FILES['fileupload']
        // Remember to handle file uploads securely
    } else {
        $sql = "update tb_news set
		news_id='$id_edit',
		news_name='$news_name',
		news_detail='$news_detail',
		news_type='$news_type',
		news_slide='$news_slide'
		where news_id='$id_edit' ";
    }

    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
        echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
        echo "<script>
			alert('แก้ไขเรียบร้อย');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
    } else {
        echo "<center><h5>คลิก ตกลง แล้วกรุณารอสักครู่ ... <br /><font color=red>ระบบจะทำการเปลี่ยนหน้าอัตโนมัติ</font></h5></center>";
        echo "<center><a href='edit-news.php?id_edit=$id_edit&type=$news_type' ><h5>[ ไม่ต้องการรอ .. คลิก!! ]</h5></a></center>";
        echo "<script>
			alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!');
			window.location='edit-news.php?id_edit=$id_edit&type=$news_type';
			</script>";
    }

    mysqli_close($connect);
    ?>
</body>

</html>
