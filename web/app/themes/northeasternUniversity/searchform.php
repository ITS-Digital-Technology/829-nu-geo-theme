<?php
/**
 * The search form template.
 *
 * @package    WordPress
 * @subpackage northeasternUniversity
 * @since      northeasternUniversity 1.0
 */

?>

<form method="get" action="<?php bloginfo( 'url' ); ?>" class="search-form">
	<label for="search" aria-label="Search">Search</label>
	<input id="search" class="search-form__input" type="search" name="s" id="search_input" placeholder="<?php _e('Search', 'northeasternUniversity'); ?>"/>
	<button class="search-form__submit" type="submit" aria-label="Search Form Submit" value="<?php _e('Search', 'northeasternUniversity'); ?>">
		<span class="icon-search"></span>
	</button>
</form>
