<?php
$term            = get_queried_object();
$taxonomy        = $term->taxonomy;
$term_id         = $term->term_id;
?>
<section class="staff-posts-taxonomy">
	<div class="staff-posts-taxonomy__cards-wrapper">
		<?php
		if ( class_exists( 'eight29_filters' ) && ! is_search() ) {
			echo do_shortcode(
				"[eight29_filters
            post_type = staff
            posts_per_page=12
            posts_per_row=4
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
