<?php
$search_term = isset( $_GET['s'] ) ? $_GET['s'] : '';
?>
<div class="search-filter<?php echo $search_term ? ' filled' : ''; ?>">
	<form method="get" action="<?php bloginfo( 'url' ); ?>" class="search-form">
		<label>Search</label>
		<input class="search-form__input" type="search" placeholder="<?php __( 'Search', 'northeasternUniversity' ); ?>" name="s" aria-label="Search Input" value="<?php echo $search_term; ?>"/>
		<button type="submit" value="search" class="search-form__submit" aria-label="Search Form Submit"> <i class="icon-search"></i></button>
		<button class="search-form__close" aria-label="Search Form Close"><i class="icon-close"></i></button>
	</form>
</div>
