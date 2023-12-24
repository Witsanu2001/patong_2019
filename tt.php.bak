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
	
	$sql="select * from tb_news where news_id='$id' ";
	$result=mysql_db_query($dbname,$sql);
	$r=mysql_fetch_array($result);
	
	$news_id=$r[news_id];
	$news_name=$r[news_name];	
	$news_type=$r[news_type];
	$news_detail=$r[news_detail];
	$news_img=$r[news_img];
	$news_slide=$r[news_slide];
	$news_date=$r[news_date];
	
	$time=date('j F Y, g:i a', strtotime($news_date));

		?>
        
        <div class="col-cr">
        	<div class="toppic"><?=$news_name?></div>
            <div class="sub-h"><span class="glyphicon glyphicon-calendar"></span> <?=$time?></div>
            <div style="margin-top:0px; padding:10px;">
            <?php
			 echo"<center><img src='images/news/$news_img' /></center><br />";
		echo str_replace("../upload/files","upload/files",$news_detail);
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