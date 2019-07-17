<?php
/**
 * Block for images content links
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */
    $main_sect_class[] = 'block-content-links';
    if ( get_row_layout() === 'block_text_links')
        $main_sect_class[] = 'block-content-links-text';

    $link_icon_name = 'content-link-arrow.svg';
    $icon_path = get_template_directory() . '/images/icons/' .  $link_icon_name;
    $icon = file_get_contents($icon_path);
?><section class="<?php echo implode(' ', $main_sect_class); ?>">
    <div class="container">
        <?php ContentBlock::the_block_title(); ?>
        <div class="row"><?php
            $cols = get_sub_field('number_of_cards');
            $class = '';
            switch($cols) {
                case '6':
                    $class = 'col-12 col-md-6 col-lg-2';
                    break;
                case '4':
                    $class = 'col-12 col-md-6 col-lg-3';
                    break;
                case '2':
                    $class = 'col-12 col-md-6';
                    break;
                default:
                    $class = 'col-12 col-md-6 col-lg-4';
            }
            while(have_rows('content_links')): the_row();
                $content = get_sub_field('content');
                $title = get_sub_field('title');
                $link = get_sub_field('link');
                $img = wp_get_attachment_image( get_sub_field('image'), 'thumbnail-content-image' );
                $new_tab = get_sub_field('open_in_new_window');
                if($new_tab) {
                    $open_in_new_tab = 'target="_blank"';
                } else {
                    $open_in_new_tab = '';
                }
                ?><div class="<?php echo $class; ?> content-link__single">
                    <a href="<?php echo $link; ?>" class="content-link" <?php echo $open_in_new_tab; ?>>
                    <?php
                        if (!empty($img)):
                    ?>
                        <figure class="content-link__img-wrapper"><?php echo $img; ?></figure>
                    <?php
                        endif;
                        if (!empty($title)):
                    ?>
                        <h4 class="content-link__title"><?php echo $title; ?><figure class="content-link__icon"><?php echo $icon; ?></figure></h4>
                    <?php
                        endif;
                        if (!empty($content)):
                    ?>
                        <p class="content-link__content"><?php echo $content; ?></p>
                    <?php
                        endif;
                    ?>
                    </a>
                </div><?php
            endwhile;
        ?></div>
    </div>
</section>
