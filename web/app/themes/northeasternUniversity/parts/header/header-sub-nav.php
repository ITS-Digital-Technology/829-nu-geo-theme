<?php
$button = get_field('htb_button', 'options');

$menus = get_field('htb_menus', 'options');
$links = get_field('htb_icons_links', 'options');
$cta = get_field('htb_cta', 'options');

?>
<button class="topbar__button subnav-trigger">
    <span class="topbar__button-text">
        <?php echo $button; ?>
    </span>
    <span class="topbar__button-text hidden">
        <?php echo __('Close', 'northeasternUniversity'); ?>
    </span>
</button>

<div class="topbar__subnav">
    <div class="topbar__subnav-left">
    <!-- menu start -->
    <?php if( have_rows('htb_menus', 'options') ): ?>
        <ul class="topbar__menu">
        <?php while( have_rows('htb_menus', 'options') ): the_row();
            $menu = get_sub_field('menu');
            $menu_obj = wp_get_nav_menu_object($menu);
            $tab_title = get_sub_field('title');
            $menu_title = $menu_obj->name;
            $title = !empty($tab_title) ? $tab_title : $menu_title;
            $i = get_row_index() - 1;

            $args = [
                'menu' => $menu,
                'container_class' => 'topbar__menu-accordion',
            ];
        ?>
            <li class="topbar__menu-entry">
                <button data-target="subnav-tab-<?php echo $i; ?>">
                    <?php echo $title; ?>
                </button>

                <?php wp_nav_menu($args); ?>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php endif; ?>

    <!-- menu end -->

    <!-- links with icons start -->
        <div class="topbar__links-icons links-icons">
            <?php
            foreach($links as $single) :
                $link = $single['link'];
                $icon = $single['icon'];
            ?>
                <a href="<?php echo $link['url']; ?>" <?php if (!empty($link['target'])) : ?>target="<?php echo $link['target']; ?>" <?php endif; ?>class="links-icons__link">
                <?php if (!empty($icon)) : ?>
                    <figure class="links-icons__icon">
                        <?php echo f_img($icon); ?>
                    </figure>
                <?php endif; ?>
                <?php if (!empty($link['title'])) : ?>
                    <span class="links-icons__text">
                        <?php echo $link['title']; ?>
                    </span>
                <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    <!-- links with icons end -->

    <!-- cta start -->
        <a href="<?php echo $cta['url']; ?>" <?php if (!empty($cta['target'])) : ?>target="<?php echo $cta['target']; ?>" <?php endif; ?>class="topbar__cta c-btn c-btn-secondary c-btn-color-alt">
            <?php echo $cta['title']; ?>
        </a>
    <!-- cta end -->
    </div>

    <div class="topbar__subnav-right hide-on-mobile">
        <div class="topbar__menu-list subnav-tabs">
        <?php if( have_rows('htb_menus', 'options') ): ?>
            <?php while( have_rows('htb_menus', 'options') ): the_row();
                $menu = get_sub_field('menu');
                $menu_obj = wp_get_nav_menu_object($menu);
                $pane_title = get_sub_field('pane_title');
                $tab_title = get_sub_field('title');
                $menu_title = $menu_obj->name;
                $i = get_row_index() - 1;

                $args = [
                    'menu' => $menu,
                    'walker'=> new Tab_Menu_Walker,
                    'menu_class' => 'subnav-tabs__list',
                ];

                if (!empty($pane_title)) {
                    $title = $pane_title;
                } else if (!empty($tab_title)) {
                    $title = $tab_title;
                } else {
                    $title = $menu_title;
                }
            ?>
            
            <nav class="subnav-tabs__tab" id="subnav-tab-<?php echo $i; ?>">
                <p class="subnav-tabs__title">
                    <?php echo $title; ?>
                </p>

                <?php wp_nav_menu($args); ?>
            </nav>

            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </div>
</div>