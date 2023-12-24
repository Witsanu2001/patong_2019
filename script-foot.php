<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$("ul#navi_containTab > li").click(function(event){
			var menuIndex=$(this).index();
			$("ul#detail_containTab > li:visible").hide();			
			$("ul#detail_containTab > li").eq(menuIndex).show();
	});
});
</script>

<script type="text/javascript">
$(function(){
	$("ul#navi_containTab2 > li").click(function(event){
			var menuIndex=$(this).index();
			$("ul#detail_containTab2 > li:visible").hide();			
			$("ul#detail_containTab2 > li").eq(menuIndex).show();
	});
});
</script>

<script type="text/javascript">
$(function(){
	$("ul#navi_containTab3 > li").click(function(event){
			var menuIndex=$(this).index();
			$("ul#detail_containTab3 > li:visible").hide();			
			$("ul#detail_containTab3 > li").eq(menuIndex).show();
	});
});
</script>

<script>
$('.tab').click(function() {
    $(this).addClass('active').siblings().removeClass('active');
});
</script>
<script>
$('.tab2').click(function() {
    $(this).addClass('active').siblings().removeClass('active');
});
</script>
<script>
$('.tab3').click(function() {
    $(this).addClass('active').siblings().removeClass('active');
});
</script>