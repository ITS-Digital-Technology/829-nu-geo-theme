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

    <?php
        get_theme_part( 'footer/footer-top' );
    ?>
    </footer>
</div> <!-- /#page -->
<?php wp_footer(); ?>
<script type = "text/javascript">
  jQuery(document).ready(function($) {
    $(".more-filters").attr("role", "alert");
    $(".more-filters").attr("aria-live", "Polite");
    $(".eight29-pagination-list button.current-page").attr("aria-label", "Active");
    $("div.no-results").attr("aria-label", "No result found");
    
    
    $("#menu-information-1").removeAttr("role");
    $("#menu-information-1 li a").removeAttr("role");
       
    $("#students h2:first").focus();
    $("#students h2:first").attr('tabindex', '0');
    
    $("#filter-staff_category .button-wrap .active").attr("aria-selected", "true");
    
    
    $("#nu-global-header :button").click(function() {
         $(this).focus();
     });
    $(".block-program-comparison__programs-article").removeAttr("aria-hidden");
    $("#filter-staff_category :button").click(function() {
      $("#filter-staff_category :button").attr("aria-selected", "false");
      $(this).attr("aria-selected", "true")
    });
    $(".load-more-btn").find(":button").click(function(){
    });
   
    $(".main-header__hamburger").click(function() {
      if ($(this).hasClass("open")) {
        $(this).attr("aria-expanded", "true");
      } else {
        $(this).attr("aria-expanded", "false");
      }

    });


  }); 
</script>
<script type="javascript">
document.getElementsByClassName("ul.slick-dots").removeAttribute("role");
</script>



</body>
</html>
