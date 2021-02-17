<?php
$title = get_sub_field('section_title');
$button = get_sub_field('button');
$blog_manual_selection = get_sub_field( 'manual_selection' );
$blog_manual_posts     = get_sub_field( 'posts' );

$args_posts = [
	'posts_per_page' => 3,
];

$posts = $blog_manual_posts ? $blog_manual_posts : get_posts( $args_posts );

?>
<section class="block-related-posts">
    <div class="container">
        <div class="related-posts">
            <div class="related-posts__top">
            <?php if(!empty($title)):?>
                <h2 class="related-posts__title"><?php echo $title;?></h2>
            <?php endif;?>
            <?php if(!empty($button)) :
                $link_url    = $button['url'];
                $link_title  = $button['title'];
                $link_target = $button['target'] ? $button['target'] : '_self';
                ?>
                <a class="c-btn c-btn-tertiary c-btn-color-normal" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                    <span><?php echo esc_html( $link_title ); ?></span>
                    <span class="c-btn-icon"><i class="icon-arrow-right-circle"></i></span>
                </a>
            <?php endif;?>
            </div>
            <div class="related-posts__bottom">
                <div class="row">
                <?php
                foreach ( $posts as $post ) :
                    $title            = get_the_title( $post );
                    $cat              = get_primary_taxonomy_term( $post, 'category' );
                    $post_author_id   = get_post_field( 'post_author', $post );
                    $post_author_link = get_author_posts_url( $post_author_id );
                    $author           = get_the_author_meta( 'display_name', $post_author_id );
                    $thumbnail        = get_the_post_thumbnail( $post, 'thumbnail-card' );
                    if ( empty( $thumbnail ) ) {
                        $thumbnail = wp_get_attachment_image( get_field( 'default_post_thumbnail', 'options' )['ID'],'thumbnail-card' );

                    }
                    $permalink = get_permalink( $post );
                    ?>
                    <div class="col-12 col-lg-4 related-posts__post-col">
                        <?php get_theme_part('archive/post/card', [
                            'title' => $title,
                            'cat' => $cat,
                            'post_author_id' => $post_author_id,
                            'thumbnail' => $thumbnail,
                            'permalink' => $permalink,
                        ]);?>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

