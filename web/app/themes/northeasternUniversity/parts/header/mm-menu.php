<?php
$menu_id = isset( $menu_id ) ? $menu_id : get_sub_field( 'mm_wp_menu' );
$items   = wp_get_nav_menu_items( $menu_id );

if ( ! empty( $items ) ) :
?>
<ul id="menu-<?php echo $menu_id; ?>" class="menu">
<?php foreach ( $items as $item ) : ?>
	<li id="menu-item-<?php echo $item->object_id; ?>" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-<?php echo $item->object_id; ?> <?php echo ! empty( $item->description ) ? 'menu-item--has-description' : ''; ?>">
		<a href="<?php echo get_the_permalink( $item->object_id ); ?>">
			<p class="menu-item__title">
				<?php echo $item->title; ?>
			</p>

		<?php if ( ! empty( $item->description ) ) : ?>
			<p class="menu-item__description">
				<?php echo $item->description; ?>
			</p>
		<?php endif; ?>
		</a>
	</li>
<?php endforeach; ?>
</ul>
<?php
endif;
