<?php
/**
 * View: Filter Component
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-filterbar/v2_1/components/filter.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @var string       $style                Style of filter, can be `pill` or `accordion`.
 * @var bool         $is_open              Whether the filter is open or not.
 * @var string       $toggle_id            Unique ID for the toggle.
 * @var string       $container_id         Unique ID for the container.
 * @var string       $container_labelledby Space-separated list of IDs that control the container behavior.
 * @var string       $label                Label for the filter toggle.
 * @var string       $selections_count     Selections count for the filter toggle.
 * @var string       $selections           Selections for the filter toggle.
 * @var array<array> $fields               Array of field data.
 * @var string       $type                 Type of filter.
 *
 * @version 5.0.2
 *
 */

// Return early if style is not set or is not `pill` or `accordion`.
if ( ! isset( $style ) || ! in_array( $style, [ 'pill', 'accordion' ] ) ) {
	return;
}

$is_pill_style      = 'pill' === $style;
$is_accordion_style = 'accordion' === $style;

$classes = [ 'tribe-filter-bar-c-filter' ];

if ( ! empty( $is_open ) ) {
	$classes[] = 'tribe-filter-bar-c-filter--open';
}

if ( ! empty( $selections_count ) && ! empty( $selections ) ) {
	$classes[] = 'tribe-filter-bar-c-filter--has-selections';
	if ( $selections_count > 1 ) {
		$selections = esc_html( __( 'Multiple', 'northeasternUniversity' ) );
	}
}

if ( $is_pill_style ) {
	$classes[] = 'tribe-filter-bar-c-filter--pill';
} elseif ( $is_accordion_style ) {
	$classes[] = 'tribe-filter-bar-c-filter--accordion';
}

if ( ! empty( $type ) ) {
	$classes[] = "tribe-filter-bar-c-filter--$type";
}
?>
<div <?php tribe_classes( $classes ); ?>>
	<div class="tribe-filter-bar-c-filter__toggle-wrapper">
		<button
			class="tribe-filter-bar-c-filter__toggle tribe-common-b1 tribe-common-b2--min-medium"
			id="<?php echo esc_attr( $toggle_id ); ?>"
			type="button"
			aria-controls="<?php echo esc_attr( $container_id ); ?>"
			aria-expanded="<?php echo esc_attr( $is_open ? 'true' : 'false' ); ?>"
			data-js="tribe-events-accordion-trigger tribe-filter-bar-c-filter-toggle"
		>
			<div class="tribe-filter-bar-c-filter__toggle-text">
				<span class="tribe-filter-bar-c-filter__toggle-label"><?php echo esc_html( $label ); ?></span><span class="tribe-filter-bar-c-filter__toggle-label-colon">:</span>
				<?php if ( ! empty( $selections_count ) ) : ?>
					<span class="tribe-filter-bar-c-filter__toggle-selections-count">
						<?php echo esc_html( "($selections_count)" ); ?>
					</span>
				<?php endif; ?>
				<span class="tribe-filter-bar-c-filter__toggle-selections">
					<?php echo esc_html( $selections ); ?>
				</span>
			</div>

		</button>

		<?php if ( $is_pill_style ) : ?>
			<button class="tribe-filter-bar-c-filter__remove-button" type="button">
				<?php $this->template( 'components/icons/close-alt', [ 'classes' => [ 'tribe-filter-bar-c-filter__remove-button-icon' ] ] ); ?>
				<span class="tribe-filter-bar-c-filter__remove-button-text tribe-common-a11y-visual-hide">
					<?php esc_html_e( 'Remove filters', 'tribe-events-filter-view' ); ?>
				</span>
			</button>
		<?php endif; ?>
	</div>

	<div
		class="tribe-filter-bar-c-filter__container"
		id="<?php echo esc_attr( $container_id ); ?>"
		aria-hidden="<?php echo esc_attr( $is_open ? 'false' : 'true' ); ?>"
		aria-labelledby="<?php echo esc_attr( $container_labelledby ); ?>"
	>
		<fieldset class="tribe-filter-bar-c-filter__filters-fieldset">
			<div class="tribe-filter-bar-c-filter__filter-fields">
				<?php
				foreach ( $fields as $field ) {
					$this->template( 'components/field-type', [ 'data' => $field ] );
				}
				?>
			</div>
		</fieldset>
	</div>
</div>
