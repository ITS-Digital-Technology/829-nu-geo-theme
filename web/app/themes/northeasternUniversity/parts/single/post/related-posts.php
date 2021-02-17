<?php
$related_heading = get_field('related_blog_posts_heading', 'options');
$related_link_field = get_field('related_blog_posts_link', 'options');
$related_link_title = $related_link_field['title'];
$related_link = $related_link_field['url'];
$related_link_target = !empty($related_link_field['target']) ? 'target="'. $related_link_field['target'] .'"' : '';

$category = wp_get_post_terms(get_the_ID(), 'post_content_type');
$categories = [];

foreach($category as $single) {
    array_push($categories, $single->term_id);
}

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'tax_query' => array(
        array(
            'taxonomy' => 'post_content_type',
            'field'    => 'term_id',
            'terms'    => $categories,
        ),
    ),
    'post__not_in' => array(get_the_id()), // don't pull itself
);

$query = new WP_Query($args);

if ($query->have_posts()) :
?>
<section class="related-blog-posts">
    <div class="related-blog-posts__pattern"></div>
    <div class="container">
        <div class="related-blog-posts__heading-wrapper">
            <h2 class="related-blog-posts__heading">
                <?php echo $related_heading; ?>
            </h2>
            <a href="<?php echo $related_link; ?>" <?php echo $related_link_target; ?> class="related-blog-posts__all-posts c-btn c-btn-tertiary c-btn-color-normal">
                <span><?php echo $related_link_title; ?></span>
                <span class='c-btn-icon'><i class='icon-arrow-right-circle'></i></span>
            </a>
        </div>
        <div class="row related-blog-posts__posts">
        <?php
        while ($query->have_posts()) : $query->the_post();
            $title            = get_the_title( get_the_ID() );
            $cat              = get_primary_taxonomy_term( get_the_ID(), 'post_content_type' );
            $post_author_id   = get_post_field( 'post_author', get_the_ID() );
            $thumbnail        = get_the_post_thumbnail(get_the_ID(), 'thumbnail-content-image');
            $permalink        = get_the_permalink( get_the_ID() );
        ?>
			<div class="col-12 col-lg-4 latest-post__card-col">
				<?php get_theme_part('archive/post/card', [
                    'title' => $title,
                    'cat' => $cat,
                    'post_author_id' => $post_author_id,
                    'thumbnail' => $thumbnail,
                    'permalink' => $permalink,
                    'is_h3' => true,
                ]);?>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
    wp_reset_postdata();
endif;