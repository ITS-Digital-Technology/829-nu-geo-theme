<?php
/**
 * The footer for theme.
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

?>
    <footer class="main-footer" aria-label="Footer">
        <?php get_theme_part('elements/cookie-bar'); ?>

    <?php
        get_theme_part( 'footer/footer-top' );
        get_theme_part( 'footer/footer-bottom' );
    ?>
    </footer>
</div> <!-- /#page -->
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
$(".main-header__hamburger").click(function(){
console.log("here");
if($(this).hasClass("open"){
console.log("HI");
$(this).attr("aria-expanded","false");
}else{
$(this).attr("aria-expanded","true");
}

});


});
</script>
</body>
</html>
