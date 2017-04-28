<footer id="footer">
	<div class="row">
		<div class="col span-12">

			<p id="footer-copy">&copy;<?php echo date('Y'); ?> Seed<?php if( is_page_template('page-home.php') ) echo '<span class="desktop-only">&nbsp;&nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp;&nbsp;</span><br class="mobile-only" /><a href="http://www.echosims.com" target="_blank">Website crafted by echosims</a>'; ?></p>
			
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<?php
// Footer Scripts
$scripts_status = get_field('scripts_status', 'options');
if( $scripts_status == 'live' ){
	echo get_field('footer_scripts', 'options');
}
?>

<script> 
var $buoop = {vs:{i:10,f:-4,o:-4,s:8,c:-4},api:4}; 
function $buo_f(){ 
 var e = document.createElement("script"); 
 e.src = "//browser-update.org/update.min.js"; 
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)}
</script>

</body>
</html>