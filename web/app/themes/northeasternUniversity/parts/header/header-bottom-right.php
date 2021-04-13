<?php
$log_in_link = get_field('h_log_in_link', 'options');
?>
<div class="main-header__right">
    <div class="main-header__nav-wrapper">
        <?php get_theme_part( 'header/header-nav' ); ?>
    </div>
    <div class="main-header__right-wrapper">
        <div class="main-header__search-button-wrapper">
            <button class="main-header__search-button" aria-label="Search Button">
                <i class="icon-search"></i>
            </button>
        </div>
        <div class="main-header__login">
            <a
                href="<?php echo $log_in_link['url']; ?>"
                <?php if ($log_in_link['target']) : ?>target="<?php echo $log_in_link['target']; ?>"<?php endif; ?>
                class="main-header__login-link"
            >
                <?php echo $log_in_link['title']; ?>
            </a>
        </div>
        <div class="main-header__bottom-menu">
            <button class="main-header__info-for">
                <?php echo __('Info for...', 'northeasternUniversity'); ?>
            </button>
            <?php wp_nav_menu( array( 'theme_location' => 'info_for', 'container' => false ) ); ?>
        </div>
    </div>
</div>