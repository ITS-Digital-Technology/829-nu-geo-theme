<?php
$menu_id = isset($menu_id) ? $menu_id : get_sub_field('mm_wp_menu');
$menus = wp_get_nav_menu_items($menu_id);

if (!empty($menus)) :
?>
<ul id="menu-programs-menu-1" class="menu">
    <?php foreach($menus as $menu) : ?>
    <li id="menu-item-715" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-715 <?php echo !empty($menu->post_content) ? 'menu-item--has-description' : ''; ?>">
        <a href="<?php echo get_the_permalink($menu->ID); ?>">
            <p class="menu-item__title">
                <?php echo $menu->post_title; ?>
            </p>
            <?php if (!empty($menu->post_content)) : ?>
            <p class="menu-item__description">
                <?php echo $menu->post_content; ?>
            </p>
            <?php endif; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php
endif;