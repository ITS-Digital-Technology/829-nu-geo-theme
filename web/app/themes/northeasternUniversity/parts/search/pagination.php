<?php
global $wp_query;
$class             = isset( $class ) ? $class : '';
$main_block_class  = 'pagination';
$main_block_class .= $class ? ' ' . $class : '';
$query             = ! empty( $query ) ? $query : $wp_query;
$max_num_pages     = isset( $query->max_num_pages ) ? $query->max_num_pages : 1;
$ppp               = isset( $query->query_vars['posts_per_page'] ) ? $query->query_vars['posts_per_page'] : 0;
$found_posts       = isset( $query->found_posts ) ? $query->found_posts : 0;
$current_page      = isset( $query->query['paged'] ) ? $query->query['paged'] : 1;
$is_prev_link      = $current_page == 1 ? false : true;
$is_next_link      = $current_page == $max_num_pages ? false : true;

if ( $found_posts > $ppp ) :
	?>
<nav class="<?php echo $main_block_class; ?>">
	<div class="eight29-pagination">
		<a href="<?php echo get_previous_posts_page_link(); ?>" aria-label="<?php _e( 'Pagination Arrow Prev', 'northeasternUniversity' ); ?>"  class="pagination-arrow eight29-pagination-prev<?php echo ! $is_prev_link ? ' disabled' : ''; ?>"><span class="icon-chev-left"></span></a>

		<div class="pagination__numbers-wrapper">
		<?php
			echo paginate_links(
				[
					'mid_size'  => 1,
					'prev_next' => false,
				]
			);
		?>
		</div>
		<a href="<?php echo get_next_posts_page_link(); ?>" aria-label="<?php _e( 'Pagination Arrow Next', 'northeasternUniversity' ); ?>"  class="pagination-arrow eight29-pagination-next<?php echo ! $is_next_link ? ' disabled' : ''; ?>"><span class="icon-chev-right"></span></a>
	</div>
</nav>
	<?php
endif;
