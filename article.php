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
	
	$sql="select * from tb_article where art_id='$id' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$art_id=$r[art_id];
	$art_name=$r[art_name];	
	$art_type=$r[art_type];
	$art_detail=$r[art_detail];
	$art_date=$r[art_date];
	
	$time=date('j F Y, g:i a', strtotime($art_date));

		?>
        
        <div class="col-cr">
        	<div class="toppic"><?=$art_name?></div>
            <div class="sub-h"><span class="glyphicon glyphicon-calendar"></span> <?=$time?></div>
            <div style="margin-top:0px; padding-left:10px; padding-right:10px; padding-left:10px;">
            <?php
		echo str_replace("../upload/files","upload/files",$art_detail);
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