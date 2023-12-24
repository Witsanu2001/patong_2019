<?php require('./cp/connect.php')  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "script-head.php";?>
</head>

<body>
<div class="border-top"></div>
<div class="main">
<div class="content">
	<div class="header">
    
        <?php include "topbanner.php";?>
        
        <?php include "header.php";?>
    
    <?php include "slide.php"; ?>
    
    <div class="row-main">
    	<div class="col-left">
        	<?php include "menu-left.php";?>
            
            <?php include "link.php";?>
            
        </div><!--------------left--------------->
        
        <div class="col-cen">
        
        	<div class="h-cen"><span class="glyphicon glyphicon-leaf"></span> สาระน่ารู้ 
            <a href="more-news.php?id=3"><div class="readmore">เพิ่มเติม <span class="glyphicon glyphicon-plus-sign"></span></div></a>
            </div>
                <?php include "list-knowladge.php";?>

        	<div class="h-cen"><span class="glyphicon glyphicon-bookmark"></span> ข่าวประชาสัมพันธ์</div>
                <?php include "list-news.php";?>
           	
			<div class="h-cen"><span class="glyphicon glyphicon-bookmark"></span> ITA</div>
                <?php include "list-tt.php";?>

            <div class="h-cen"><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> ประกาศจัดซื้อ / จัดจ้าง</div>
                <?php include "list-buy.php";?>
                
             <div class="h-cen"><span class="glyphicon glyphicon-briefcase"></span> ประกาศรับสมัครงาน</div>
                <?php include "list-job.php";?>
                
             <!--<div class="h-cen"><span class="glyphicon glyphicon-thumbs-up"></span> Fanpage </div>-->  
             	
        </div><!--------------center--------------->
        
        <div class="col-right">
        	<?php include "ceo.php";?>
            
            <?php include "calendar.php";?>
            
            <!-- <?php include "stats.php";?> -->
            
        </div><!--------------right--------------->
        
    </div><!--------------row-main--------------->
    
    <?php include "footer.php";?>
    
</div><!--------------content--------------->

</div><!--------------main--------------->

<?php include "script-foot.php";?>

</body>
</html>