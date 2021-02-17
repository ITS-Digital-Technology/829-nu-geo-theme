<?php
$title         = get_field( 'blog_title', 'options' );
$desc          = get_field( 'blog_description', 'options' );
$featured_post = get_field( 'blog_hero_featured_post', 'options' );

$args_posts = [
	'posts_per_page' => 1,
];
if ( empty( $featured_post ) ) {
	$featured_post = get_posts( $args_posts )[0]->ID;
}
?>
<section class="block-blog-hero">
    <div class="block-blog-hero-wrapper">
        <div class="container">
            <div class="block-blog-hero__top-wrapper">
            <?php if ( ! empty( $title ) ) : ?>
                <h1 class="block-blog-hero__title"><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( ! empty( $desc ) ) : ?>
                <div class="block-blog-hero__desc"><?php echo $desc; ?></div>
            <?php endif; ?>
            </div>
            <?php if ( ! empty( $featured_post ) ) : ?>
            <div class="block-blog-hero__bottom-wrapper">
                <?php
                    $title            = get_the_title( $featured_post );
                    $cat              = get_primary_taxonomy_term( $featured_post, 'post_content_type' );
                    $post_author_id   = get_post_field( 'post_author', $featured_post );
                    $post_author_link = get_author_posts_url( $post_author_id );
                    $author           = get_the_author_meta( 'display_name', $post_author_id );
                    $thumbnail        = get_the_post_thumbnail( $featured_post, 'post-featured-card' );
                if ( empty( $thumbnail ) ) {
                    $thumbnail = wp_get_attachment_image( get_field( 'default_post_thumbnail', 'options' )['ID'], 'post-featured-card' );

                }
                    $permalink = get_permalink( $featured_post );
                if ( has_excerpt( $featured_post ) ) {
                    $excerpt = get_the_excerpt( $featured_post );
                } else {
                    $excerpt = '';
                }
                ?>
                <article class="featured-post-card">
                    <a class="featured-post-card__link" href="<?php echo $permalink; ?>" aria-label="Post Link"></a>
                    <div class="featured-post-card__wrapper">
                    <?php if ( ! empty( $thumbnail ) ) : ?>
                        <figure class="featured-post-card__thumbnail">
                            <span class="featured-post-card__label"><?php _e( 'Featured', 'northeasternUniversity' ); ?></span>
                            <?php echo $thumbnail; ?></figure>
                    <?php endif; ?>
                        <div class="featured-post-card__content">
                        <?php if ( ! empty( $cat ) ) : ?>
                            <div class="featured-post-card__cat">
                                <a class="post-card__cat-link" aria-label="<?php echo $cat['title']; ?> " href="<?php echo $cat['url']; ?>"><?php echo $cat['title']; ?></a>
                            </div>
                        <?php endif; ?>
                            <h2 class="featured-post-card__title"><?php echo $title; ?></h2>
                        <?php if ( ! empty( $excerpt ) ) : ?>
                            <div class="featured-post-card__excerpt"><?php echo wp_trim_words( $excerpt, 40, '...' ); ?></div>
                        <?php endif; ?>
                            <div class="featured-post-card__author">
                                <a aria-label="<?php echo $author . ' link'; ?>" href="<?php echo $post_author_link; ?>" class="featured-post-card__author-link">
                                    <?php echo __( 'By', 'norheasternUniversity' ) . ' ' . $author; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
