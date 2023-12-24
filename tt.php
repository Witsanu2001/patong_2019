<?
include ('cp/connect.php');


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
        
        <?php
					$id=$_GET[id];
	
	$sql="select * from tb_tt where tt_id='$id' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$tt_id=$r[tt_id];
	$tt_name=$r[tt_name];	
	$tt_type=$r[tt_type];
	$tt_detail=$r[tt_detail];
	$tt_img=$r[tt_img];
	$tt_slide=$r[tt_slide];
	$tt_date=$r[tt_date];
	
	$time=date('j F Y, g:i a', strtotime($tt_date));

		?>
        
        <div class="col-cr">
        	<div class="toppic"><?=$tt_name?></div>
            <div class="sub-h"><span class="glyphicon glyphicon-calendar"></span> <?=$time?></div>
            <div style="margin-top:0px; padding:10px;">
            <?php
			 echo"<center><img src='images/tt/$tt_img' /></center><br />";
		echo str_replace("../upload/files","upload/files",$tt_detail);
		?>
        	</div>
            
        </div>
        
    </div><!--------------row-main--------------->
    
    <? include"footer.php";?>
    
</div><!--------------content--------------->

</div><!--------------main--------------->

<? include"script-foot.php";?>

</body>
</html>