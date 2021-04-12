<?php
$term     = get_queried_object();
$taxonomy = is_author() ? 'author' : $term->taxonomy;
$term_id  = is_author() ? $term->data->ID : $term->term_id;
?>
<section class="blog-posts-taxonomy">
	<div class="blog-posts-taxonomy__cards-wrapper">
		<?php
		if ( class_exists( 'eight29_filters' ) && ! is_search() ) {
			echo do_shortcode(
				"[eight29_filters
            post_type = post
            posts_per_page=12
            posts_per_row=3
            pagination_style=pagination
            taxonomy = ${taxonomy}
            term_id = ${term_id}
            display_sidebar=false
            order_by=date]"
			);
		}
		?>
	</div>
</section>
