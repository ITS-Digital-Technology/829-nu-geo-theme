<!-- As the search box appears as an overlay, it is good candidate for being semantic dialog.
<div class="main-header__search search-bar">
-->
<div class="main-header__search search-bar" role="dialog" aria-modal="true">
    <div class="search-bar__wrapper">
        <?php get_search_form(); ?>
    </div>
    <button class="search-bar__close" aria-label="Close Search">
        <span class="icon-close"></span>
    </button>
</div>