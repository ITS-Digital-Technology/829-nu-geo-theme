<?php
$today  = date( 'Y-m-d' );
$title  = isset( $title ) ? $title : get_sub_field( 'title' );
$button = isset( $button ) ? $button : get_sub_field( 'button' );
$events = tribe_get_events(
	[
		'posts_per_page' => 3,
		'meta_query'     => array(
			array(
				'key'     => '_EventStartDate',
				'value'   => $today,
				'compare' => '>=',
			),
		),
	]
);
?>

<section class="block-upcoming-events"<?php ContentBlock::the_block_id(); ?>>
    <div class="block-upcoming-events-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="block-upcoming-events__left">
                    <?php if ( ! empty( $title ) ) : ?>
                        <h2 class="upcoming-events__title"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php
                    if ( ! empty( $button ) ) {
                            echo wp_acf_link( $button, 'c-btn c-btn-tertiary c-btn-color-normal', 'icon-arrow-right-circle' );
                    }
                    ?>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="block-upcoming-events__right row">
                    <?php if ( ! empty( $events ) ) : ?>
                        <?php
                        foreach ( $events as $event ) :
                            $start_date = strtotime( $event->event_date );
                            $end_date   = strtotime( tribe_get_end_date( $event, false, 'Y-m-j g:i a' ) );
                            $is_all_day = tribe_event_is_all_day( $event );
                            $permalink  = get_the_permalink( $event );
                            $title      = get_the_title( $event );
                            $cat        = get_primary_taxonomy_term( $event->ID, 'event_type' );

                            $days = date( 'F j, Y', $start_date );
                            if ( date( 'Y', $start_date ) !== date( 'Y', $end_date ) ) {
                                $days = date( 'M j, Y - ', $start_date ) . date( 'M j, Y', $end_date );
                            } elseif ( date( 'm', $start_date ) !== date( 'm', $end_date ) ) {
                                $days = date( 'M j - ', $start_date ) . date( 'M j, Y', $end_date );
                            } elseif ( date( 'd', $start_date ) !== date( 'd', $end_date ) ) {
                                $days = date( 'M j - ', $start_date ) . date( 'j, Y', $end_date );
                            }
                            ?>
                        <article class="upcoming-events-card col-12 col-lg-4">
                            <div class="upcoming-events-card__wrapper">
                                <a class="upcoming-events-card__link" href="<?php echo $permalink; ?>" aria-label="<?php echo $title; ?>"></a>
                                <div class="upcoming-events-card__content">
                                <?php if ( ! empty( $cat ) ) : ?>
                                    <a href="<?php echo $cat['url']; ?>" class="upcoming-events-card__cat"><?php echo $cat['title']; ?></a>
                                <?php endif; ?>
                                    <span class="upcoming-events-card__title"><?php echo $title; ?></span>
                                    <div class="upcoming-events-card__date">
                                        <div class="upcoming-events-card__day">
                                            <span class="icon-calendar"></span>
                                            <span><?php esc_html_e( $days ); ?></span>
                                        </div>
                                    <?php if ( ! $is_all_day ) : ?>
                                        <div class="upcoming-events-card__time">
                                            <span class="icon-time"></span>
                                            <span class="upcoming-events-card__start-time"><?php echo date( 'g:ia', $start_date ); ?></span>
                                            <span class="upcoming-events-card__end-time"><?php echo date( 'g:ia', $end_date ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                            <?php
                    endforeach;
                        ?>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
