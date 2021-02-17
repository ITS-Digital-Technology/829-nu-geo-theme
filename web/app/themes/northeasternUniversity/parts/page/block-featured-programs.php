<?php
$title             = isset( $title ) ? $title : get_sub_field( 'title' );
$button_text       = isset( $button_text ) ? $button_text : get_sub_field( 'button_text' );
$featured_programs = isset( $featured_programs ) ? $featured_programs : get_sub_field( 'featured_programs' );
if ( empty( $button_text ) ) {
	$button_text = __( 'All Programs', 'norheasternUniversity' );
}
?>
<section class="block-featured-programs"<?php ContentBlock::the_block_id(); ?>>
    <div class="block-featured-programs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="featured-programs__wrapper-top">
                        <?php if ( ! empty( $title ) ) : ?>
                            <h2 class="featured-programs__title"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <?php
                        if ( ! empty( $button_text ) ) :
                            ?>
                            <a href="<?php echo get_post_type_archive_link( 'program' ); ?>" target="_self" class="c-btn c-btn-tertiary c-btn-color-normal"><span><?php echo $button_text; ?></span><span class="c-btn-icon"><i class="icon-arrow-right-circle"></i></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                foreach ( $featured_programs as $program ) :
                    $status        = get_field( 'program_status', $program );
                    $link          = get_field( 'program_link', $program );
                    $app_deadline  = get_field( 'program_application_deadline', $program );
                    $thumbnail     = get_the_post_thumbnail( $program, 'thumbnail-card' );
                    $default_image = get_field( 'program_default_img', 'options' );

                    if ( empty( $thumbnail ) ) {
                        $thumbnail = wp_get_attachment_image( $default_image, 'thumbnail-card' );
                    }
                    $type         = get_primary_taxonomy_term( $program, 'program_type' );
                    $title        = get_the_title( $program );
                    $city         = get_primary_taxonomy_term( $program, 'city' );
                    $country      = get_primary_taxonomy_term( $program, 'country' );
                    $terms        = get_the_terms( $program, 'term' );
                    $class_status = 'program-card__status';
                    if ( $status === 'open' ) {
                        $status        = __( 'Open', 'norheasternUniversity' );
                        $class_status .= ' status-open';
                    } elseif ( $status === 'pending' ) {
                        $status        = __( 'Pending', 'norheasternUniversity' );
                        $class_status .= ' status-pending';
                    } elseif ( $status === 'full' ) {
                        $status        = __( 'Full', 'norheasternUniversity' );
                        $class_status .= ' status-full';
                    }
                    get_theme_part('archive/program/card',[
                        'status' => $status,
                        'link' => $link,
                        'app_deadline' => $app_deadline,
                        'thumbnail' => $thumbnail,
                        'type'=>$type,
                        'title' => $title,
                        'city'=>$city,
                        'country'=>$country,
                        'terms'=>$terms,
                        'class_status'=>$class_status
                    ]);
                    ?>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
