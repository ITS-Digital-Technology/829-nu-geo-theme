<?php
/**
 * The footer for theme.
 *
 * @package    WordPress
 * @subpackage defaultTheme
 * @since      defaultTheme 1.0
 */

?>

    <footer class="main-footer"><?php
            get_theme_part( 'footer/footer-top' );
            get_theme_part( 'footer/footer-bottom' );
    ?></footer>
</div> <!-- /#page -->
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
console.log("HI");
$(".more-filters").attr("role","alert");
$(".more-filters").attr("aria-live","Polite");
$(".main-header__hamburger").click(function(){
if($(this).hasClass("open")){
$(this).attr("aria-expanded","true");
}else{
$(this).attr("aria-expanded","false");
}

});


});
</script>
</body>
</html>
