<?php
$id        = isset( $id ) ? $id : get_the_ID();
$post_type = isset( $post_type ) ? $post_type : get_post_type();
$title     = get_the_title();
$link      = get_the_permalink();
$content   = get_the_content();
$excerpt   = has_excerpt() ? get_the_excerpt() : '';
$keys      = implode( '|', explode( ' ', get_search_query() ) );
$excerpt   = ! empty( $excerpt ) ? $excerpt : ( ! empty( $content ) ? substr( strip_tags( do_shortcode( $content ) ), 0, 200 ) . '...' : false );
$aria = strip_tags($title);
if ( ! empty( $excerpt ) ) {
	$excerpt = preg_replace( '/(' . $keys . ')/iu', '<strong>\0</strong>', $excerpt );
}
if ( ! empty( $title ) ) {
	$title = preg_replace( '/(' . $keys . ')/iu', '<strong>\0</strong>', $title );
}
$image = get_the_post_thumbnail( $id, 'search-thumbnail' );
$cat   = '';
if ( $post_type === 'program' ) {
	$link = get_field( 'program_link', $id )['url'];
	$cat  = get_primary_taxonomy_term( $id, 'program_type' )['title'];
} elseif ( $post_type === 'staff' ) {
	$cat = get_primary_taxonomy_term( $id, 'staff_category' )['title'];
} elseif ( $post_type === 'news' ) {
	$cat = get_primary_taxonomy_term( $id, 'news_category' )['title'];
} elseif ( $post_type === 'post' ) {
	$cat = get_primary_taxonomy_term( $id, 'post_topic' )['title'];
}
?>
<article class= "search-result-card">
	<?php if ( ! empty( $link ) ) : ?>
	<a class="search-result-card__link" href="<?php echo $link; ?>" data-id="<?php echo $id; ?>" aria-label="<?php echo $aria; ?>"></a>
	<?php endif; ?>
	<div class="search-result-card__wrapper">
		<div class="search-result-card__content">
		<?php if ( ! empty( $cat ) ) : ?>
			<p class="search-result-card__cat"><?php echo $cat; ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $title ) ) : ?>
			<h5 class="search-result-card__title"><?php echo $title; ?></h5>
		<?php endif; ?>
		<?php if ( ! empty( $excerpt ) ) : ?>
			<div class="search-result-card__excerpt"><?php echo $excerpt; ?> </div>
		<?php endif; ?>
		</div>
		<?php if ( ! empty( $image ) ) : ?>
		<figure class="search-result-card__thumbnail"><?php echo $image; ?></figure>
		<?php endif; ?>
	</div>
</article>
