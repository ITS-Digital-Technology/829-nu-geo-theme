<?php
$term            = get_queried_object();
$taxonomy        = $term->taxonomy;
$term_id         = $term->term_id;
?>
<section class="news-posts-taxonomy">
	<div class="news-posts-taxonomy__cards-wrapper">
		<?php
		if ( class_exists( 'eight29_filters' ) && ! is_search() ) {
			echo do_shortcode(
				"[eight29_filters
            post_type = news
            posts_per_page=12
            posts_per_row=3
            pagination_style=pagination
            taxonomy = ${taxonomy}
            term_id = ${term_id}
            display_excerpt=true
            display_date=true
            display_sidebar=false
            order_by=date]"
			);
		}
		?>
	</div>
</section>
