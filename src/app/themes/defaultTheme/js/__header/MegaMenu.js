const $ = jQuery.noConflict();

function isTouchDevice() {
    return 'ontouchstart' in window || navigator.msMaxTouchPoints;
}
class MegaMenu {
    constructor() {
        this.menu = $('.main-header__nav');
        this.menuItems = this.menu.find('> .menu > .menu-item-type-post_type');
        this.menuItemsLinks = this.menuItems.find('> a');
    }
    static showMegaMenu() {
        const megaMenuWrapper = $(this).find('.mega-menu-wrapper');
        const megaMenuCols = megaMenuWrapper.find('[class*="col-"]');
        const timer = $('.main-header .mega-menu-background').height() !== 0 ? 0 : 250;

        MegaMenu.menuTimeout = setTimeout(() => {
            megaMenuCols.each((i, v) => {
                MegaMenu.animateItemsIn($(v).find('*'));
            });

            megaMenuWrapper.addClass('active');
            MegaMenu.animateMenuBackground(megaMenuWrapper.outerHeight());
        }, timer);
    }
    static hideMegaMenu() {
        clearTimeout(MegaMenu.menuTimeout);
        const activeMegaMenu = $('.mega-menu-wrapper.active');
        const activeMegaMenuItems = activeMegaMenu.find('*');

        activeMegaMenu.removeClass('active');
        activeMegaMenuItems.removeClass('active');

        MegaMenu.animateMenuBackground(0);
    }
    static hideMegaMenuOnTouch(e) {
        const container = $('.main-header__nav');
        if (!container.is(e.target) && container.has(e.target).length === 0 && $('.mega-menu-wrapper').hasClass('active')) {
            MegaMenu.hideMegaMenu();
        }
    }
    static animateItemsIn(items) {
        let delay = 0;
        items.each((i, v) => {
            delay += 0.04;
            $(v).css('transition-delay', `${delay}s`);
            $(v).addClass('active');
        });
    }
    static animateMenuBackground(height) {
        $('.main-header .mega-menu-background').stop().animate({
            height: `${height}px`,
        }, 300);
    }
    bindEvents() {
        if (isTouchDevice()) {
            this.menuItemsLinks.on('click', this.toggleMegaMenu);
            $(document).on('click touchstart', MegaMenu.hideMegaMenuOnTouch);
        } else {
            this.menuItems.on('mouseenter', MegaMenu.showMegaMenu);
            this.menuItems.on('mouseleave', MegaMenu.hideMegaMenu);
        }
    }
    toggleMegaMenu(e) {
        e.preventDefault();
        const megaMenuWrapper = $(this).next('.mega-menu-wrapper');
        const megaMenuCols = megaMenuWrapper.find('[class*="col-"]');

        if (megaMenuWrapper.hasClass('active')) {
            return;
        }

        MegaMenu.hideMegaMenu();
        megaMenuCols.each((i, v) => {
            MegaMenu.animateItemsIn($(v).find('*'));
        });

        megaMenuWrapper.addClass('active');
        MegaMenu.animateMenuBackground(megaMenuWrapper.outerHeight());
    }
    init() {
        this.bindEvents();
    }
}
export default new MegaMenu();
