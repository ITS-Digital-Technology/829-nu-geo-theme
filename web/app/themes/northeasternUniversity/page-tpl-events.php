<?php
/**
 * Template Name: Events
 * Events template.
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;
get_header();

$wrapper[] = 'event-wrapper';
?>
<main class="page-content">
<?php
if ( is_single() ) :
    get_template_part( 'parts/single/event/main' );
else :
    if ( isset( $_GET['is_term'] ) && $_GET['is_term'] == true ) :
        $wrapper[] = 'event-wrapper--disable-bar';
        get_template_part( 'tribe/events/v2/components/event', 'tax-hero' );
    else :
        get_template_part( 'tribe/events/v2/components/event', 'hero' );
    endif;
    ?>
    <section class="<?php echo implode( ' ',$wrapper ); ?>">
        <?php echo tribe( Template_Bootstrap::class )->get_view_html(); ?>
    </section>
    <?php
endif;
?>
</main>
<?php
get_footer();