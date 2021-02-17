<?php get_theme_part('single/post/hero'); ?>
<div class="entry">
	<?php
	defaultContent();
	ContentBlock::display_theme_blocks();
	get_theme_part('single/post/summary');
	?>
</div>
<?php get_theme_part('single/post/related-posts'); ?>