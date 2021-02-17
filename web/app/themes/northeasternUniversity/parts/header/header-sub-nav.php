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
    <?php if (!empty($menus)) : ?>
        <ul class="topbar__menu">
        <?php
        $i = 0;

        foreach($menus as $menu) :
            $menu_object = wp_get_nav_menu_object($menu['menu']);
            $menu_items = wp_get_nav_menu_items($menu['menu']);
        ?>
            <li class="topbar__menu-entry">
                <button data-target="subnav-tab-<?php echo $i; ?>">
                    <?php echo $menu_object->name; ?>
                </button>

                <ul class="topbar__menu-accordion">
                <?php
                foreach($menu_items as $menu_item) :
                    $id = $menu_item->ID;
                    $image = get_field('menu_item_image', $id);
                ?>
                    <li class="topbar__menu-item tmi">
                        <a href="<?php echo get_permalink($id); ?>">
                        <?php if (!empty($image)) : ?>
                            <figure class="tmi__image">
                                <?php echo f_img($image, 'testimonial-img'); ?>
                            </figure>
                        <?php endif; ?>
                            <span class="tmi__text">
                                <span>
                                    <?php echo $menu_item->post_title; ?>
                                </span>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </li>
        <?php
            $i++;
        endforeach;
        ?>
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
        <?php
        $i = 0;

        foreach($menus as $menu) :
            $menu_object = wp_get_nav_menu_object($menu['menu']);
            $menu_items = wp_get_nav_menu_items($menu['menu']);
        ?>
            <ul class="subnav-tabs__tab" id="subnav-tab-<?php echo $i; ?>">
                <p class="subnav-tabs__title">
                    <?php echo $menu_object->name; ?>
                </p>
            <?php
            foreach($menu_items as $menu_item) :
                $id = $menu_item->ID;
                $image = get_field('menu_item_image', $id);
            ?>
                <li class="topbar__menu-item tmi subnav-tabs__link" >
                    <a href="<?php echo get_permalink($id); ?>">
                    <?php if (!empty($image)) : ?>
                        <figure class="tmi__image">
                            <?php echo f_img($image, 'testimonial-img'); ?>
                        </figure>
                    <?php endif; ?>
                        <span class="tmi__text">
                            <span>
                                <?php echo $menu_item->post_title; ?>
                            </span>
                        </span>
                    </a>
                </li>
            <?php
            endforeach;
            ?>
            </ul>
        <?php
            $i++;
        endforeach;
        ?>
            <div class="subnav-tabs__overlay"></div>
        </div>
    </div>
</div>