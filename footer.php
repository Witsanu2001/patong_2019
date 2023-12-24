<div class="footer">
    	<div class="footpic"></div>
        <div class="footright">
        	
            <a href="cp" class="cp" target="_blank"><span class="glyphicon glyphicon-cog"></span></a>
            
			<img src="images/award.png" width="234" height="60" /><br />
            <b>Copyright &copy; 2558 Patong Hospital. Allright Reserved.</b><br />
            โรงพยาบาลป่าตอง : 57 ถ.ไสน้ำเย็น ต.ป่าตอง อ.กะทู้ จ.ภูเก็ต 83150<br />
            Patong Hospital : 57 sainamyen Rd., Patong, Kathu, Phuket 83150 Thailand<br />
            Tel. 076-342 633-4 | Fax. 076-340 617<br />
            
            

      </div>
    </div>
    
    <a href="#" class="back-to-top"><span class="glyphicon glyphicon-arrow-up"></span></a>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
function theme_enqueue_script(){ 
    wp_enqueue_script('jquery');  
}
add_action('wp_enqueue_scripts', 'theme_enqueue_script');
</script>
<script>
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
</script>