<div class="topbanner">
	<?php
    include('./cp/connect.php'); // เพิ่ม ; ที่ตามหลังคำสั่ง include

	$sql = "SELECT * FROM tb_page WHERE page_id='5'";
    $result = mysqli_query($conn, $sql);
	
	$r = mysqli_fetch_array($result); // ดึงข้อมูลแถวเดียวจากผลลัพธ์ที่ได้จาก query
	
	$page_id = $r['page_id'];
	$page_name = $r['page_name'];
	$page_detail = $r['page_detail'];
	
	$word_cut = array("<p>", "</p>");
	$replace = " ";
	
	for ($i = 0; $i < count($word_cut); $i++) {
		$page_detail = preg_replace("/" . preg_quote($word_cut[$i], "/") . "/", $replace, $page_detail);
	}
	
	echo str_replace("./upload/files", "./upload/files", $page_detail);
	?> 
</div>
