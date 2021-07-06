<?php
$log_in_link = get_field('h_log_in_link', 'options');
?>
<div class="main-header__nav-mobile">
    <div class="main-header__nav-mobile-scroll">
        <div class="main-header__mobile-menu-wrapper">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
        </div>
        <div class="main-header__mobile-info-for">
            <p class="main-header__mobile-info-for-text">
                <?php echo __('Info for...', 'northeasternUniversity'); ?>
            </p>
            <?php wp_nav_menu( array( 'theme_location' => 'info_for', 'container' => false ) ); ?>
        </div>
        <a
            href="<?php echo $log_in_link['url']; ?>"
            <?php if ($log_in_link['target']) : ?>target="<?php echo $log_in_link['target']; ?>"<?php endif; ?>
            class="main-header__mobile-login-link"
        >
            <?php echo $log_in_link['title']; ?>
        </a>
    </div>
</div>
