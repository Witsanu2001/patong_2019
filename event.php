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
        
        <div class="col-cr">
        	<div class="toppic">ปฏิทินกิจกรรม</div>
            <div style="margin-top:10px; padding:10px;">
            
            <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=web.patonghospital%40gmail.com&amp;color=%23528800&amp;src=th.th%23holiday%40group.v.calendar.google.com&amp;color=%232952A3&amp;ctz=Asia%2FBangkok" style=" border-width:0 " width="740" height="600" frameborder="0" scrolling="no"></iframe>
            
        	</div>
            
        </div>
        
    </div><!--------------row-main--------------->
    
    <? include"footer.php";?>
    
</div><!--------------content--------------->

</div><!--------------main--------------->

<? include"script-foot.php";?>

</body>
</html>