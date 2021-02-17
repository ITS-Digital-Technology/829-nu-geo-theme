<?php
/**
 * The footer for theme.
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

?>
    <?php get_theme_part('elements/cookie-bar'); ?>

    <footer class="main-footer">
    <?php
        get_theme_part( 'footer/footer-top' );
        get_theme_part( 'footer/footer-bottom' );
    ?>
    </footer>
</div> <!-- /#page -->
<?php wp_footer(); ?>

</body>
</html>
