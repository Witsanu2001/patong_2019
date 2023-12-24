<?
include ('cp/connect.php');

if(isset($_GET['start'])){
			$start = $_GET['start'];
		}else{
		$start = '0';
		}
		$limit = '10';
	
	$count=0;
	
	$id=$_GET['id'];
	
	$Qtotal = mysql_query("select * from tb_gallery where ga_group='$id'");
	$total = mysql_num_rows($Qtotal);
	
	$Query = mysql_query("SELECT * FROM tb_gallery where ga_group='$id' ORDER BY ga_id DESC ");
	$totalp = mysql_num_rows($Query);
	
	$page=$_GET['page'];


?>

<?
	$sql="select * from tb_gallery_group where gg_id='$id' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$gg_id=$r['gg_id'];
	$gg_name=$r['gg_name'];
	
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? include"script-head.php";?>
</head>

<body>
<div class="border-top"></div>
<div class="main">
<div class="content">
	<div class="header">
    
        <? include"topbanner.php";?>
        
        <? include"header.php";?>
    
    
    
    <div class="row-main">
    	<div class="col-left">
        	<? include"menu-left.php";?>
            
            <? include"link.php";?>
            
        </div><!--------------left--------------->
        
        <div class="col-cr">
        	<div class="toppic">อัลบัม : <font color="#000"><?=$gg_name?></font></div>
            <div style="margin-top:10px; padding:10px;">
            
            <?
while($r=mysql_fetch_array($Query)){
$ga_id = $r['ga_id'];
$ga_group = $r['ga_group'];
$ga_img = $r['ga_img'];

$sql="select * from tb_gallery_group where gg_id='$ga_group' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$gg_name=$r['gg_name'];
	
$count++;

$bgColor1="white";
$bgColor2="#f0ffdb";

$bgColor = (($count%2) == 0) ? $bgColor2 : $bgColor1; 

	if(!isset($page)){
		$page = 1;
		}
		
$numid=$count+(($page-1)*10);


echo"
<div class='boxga-align'><a href='images/gallery/$ga_img' rel='lightbox[set1]' class='an7_thumb'>
<img src='images/gallery/$ga_img' border='0'  class='img-thumbnail  ' width='220'></a>
</div>

";



}

mysql_close();

?>
<div style="margin-top:10px;">
<p align="right"><a href="gallery.php" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-arrow-left"></span> กลับไปหน้าคลังภาพ</a></p></div>

            
        	</div>
            
        </div>
        
    </div><!--------------row-main--------------->
    
    <? include"footer.php";?>
    
</div><!--------------content--------------->

</div><!--------------main--------------->

<? include"script-foot.php";?>

</body>
</html>