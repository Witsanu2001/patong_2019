<!DOCTYPE html>
<html>
<head>
    <title>ThaiCreate.Com Tutorials</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        body, td, th {
            font-family: tahoma;
            font-size: 12px;
            color: #333;
        }

        body {
            margin-left: 0px;
            margin-right: 0px;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <?php
    include('./cp/connect.php');

	$connection = mysqli_connect("localhost", "root", "", "patong_2019");



	//*** Select วันที่ในตาราง Counter ว่าปัจจุบันเก็บของวันที่เท่าไหร่  ***//
	//*** ถ้าเป็นของเมื่อวานให้ทำการ Update Counter ไปยังตาราง daily และลบข้อมูล เพื่อเก็บของวันปัจจุบัน ***//
	$strSQL = "SELECT DATE FROM counter LIMIT 0,1";
	$objQuery = mysqli_query($connection, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if ($objResult["DATE"] != date("Y-m-d")) {
		//*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
		$strSQL = "INSERT INTO daily (DATE,NUM) SELECT '" . date('Y-m-d', strtotime("-1 day")) . "',COUNT(*) AS intYesterday FROM  counter WHERE 1 AND DATE = '" . date('Y-m-d', strtotime("-1 day")) . "'";
		mysqli_query($connection, $strSQL);


		//*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
		$strSQL = "DELETE FROM counter WHERE DATE != '" . date("Y-m-d") . "' ";
		mysqli_query($connection, $strSQL);
		}

		//*** Insert current Counter ***//
		$strSQL = "INSERT INTO counter (DATE,IP) VALUES ('" . date("Y-m-d") . "','" . $_SERVER["REMOTE_ADDR"] . "') ";
		mysqli_query($connection, $strSQL);

	//******************** Get Counter ************************//

	// ... (โค้ดอื่น ๆ)

	// Today //
	$strSQL = "SELECT COUNT(DATE) AS CounterToday FROM counter WHERE DATE = '" . date("Y-m-d") . "' ";
	$objQuery = mysqli_query($connection, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strToday = $objResult["CounterToday"];

	// Yesterday //
	$strSQL = "SELECT NUM FROM daily WHERE DATE = '" . date('Y-m-d', strtotime("-1 day")) . "' ";
	$objQuery = mysqli_query($connection, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strYesterday = $objResult["NUM"];

	// This Month //
	$strSQL = "SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m') . "' ";
	$objQuery = mysqli_query($connection, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strThisMonth = $objResult["CountMonth"];

	// Last Month //
	$strSQL = "SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m', strtotime("-1 month")) . "' ";
	$objQuery = mysqli_query($connection, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strLastMonth = $objResult["CountMonth"];

	// This Year //
	$strSQL = "SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y') . "' ";
	$objQuery = mysqli_query($connection, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strThisYear = $objResult["CountYear"];

	// Last Year //
	$strSQL = "SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y', strtotime("-1 year")) . "' ";
	$objQuery = mysqli_query($connection, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strLastYear = $objResult["CountYear"];

	// ... (โค้ดอื่น ๆ)


	//*** Close MySQL ***//
	mysqli_close($connection);
    ?>
<div style="padding:10px;">
<center><table width="180">
 <!-- <tr>
    <td colspan="2"><div align="center">Statistics</div></td>
  </tr>-->
  <tr>
    <td width="98" height="25"><span class="glyphicon glyphicon-fire"></span> สถิติวันนี้</td>
    <td width="75" align=""><div align="right"><?php echo number_format($strToday,0);?> คน</div></td>
  </tr>
  <tr>
    <td height="25"><span class="glyphicon glyphicon-leaf"></span> สถิติเมื่อวาน</td>
    <td><div align="right"><?php echo number_format($strYesterday,0);?> คน</div></td>
  </tr>
  <tr>
    <td height="25"><span class="glyphicon glyphicon-tree-conifer"></span> สถิติเดือนนี้</td>
    <td><div align="right"><?php echo number_format($strThisMonth,0);?> คน</div></td>
  </tr>
  <tr>
    <td height="25"><span class="glyphicon glyphicon-tree-deciduous"></span> สถิติเดือนที่แล้ว</td>
    <td><div align="right"><?php echo number_format($strLastMonth,0);?> คน</div></td>
  </tr>
  <tr>
    <td height="25"><span class="glyphicon glyphicon-star-empty"></span> สถิติปีนี้</td>
    <td><div align="right"><?php echo number_format($strThisYear,0);?> คน</div></td>
  </tr>
  <tr>
    <td height="25"><span class="glyphicon glyphicon-star"></span> สถิติปีที่แล้ว </td>
    <td><div align="right"><?php echo number_format($strLastYear+33189,0);?> คน</div></td>
  </tr>
</table>

<div style="border-radius:5px; background:#1896d3; margin:auto; padding: 0px; line-height:30px; color: #b2e4fd;">
<b>IP ของคุณคือ : <font color="#fff"><? echo $_SERVER["REMOTE_ADDR"];?></font></b><br>
<script id="_wau4lm">var _wau = _wau || []; _wau.push(["small", "ujxc4co26ch4", "4lm"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/small.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script><br><br>


</div>

<!--<div style="border-radius:5px; background:#d4f1ff; margin:auto; padding: 5px; line-height:30px;">
<b>IP ของคุณคือ : <font color="#167fb3"><? //echo $_SERVER["REMOTE_ADDR"];?></font></b><br>
<script id="_wau4lm">var _wau = _wau || []; _wau.push(["small", "ujxc4co26ch4", "4lm"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/small.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script>
</div>-->



</center></div>
</body>
<html>