import screenLock from '../__utils/lockScroll';
const $ = jQuery.noConflict();

function isTouchDevice() {
    return 'ontouchstart' in window || navigator.msMaxTouchPoints;
}
class MegaMenu {
    constructor() {
        this.menu = $('.main-header__nav');
        this.menuItems = this.menu.find('> .menu > .menu-item-type-post_type');
        this.menuItemsLinks = this.menuItems.find('> a');
        // this.menuItems.attr('aria-expanded', 'false');
    }
    static hideMegaMenu() {

        clearTimeout(MegaMenu.menuTimeout);
        const activeMegaMenu = $('.mega-menu-wrapper.active');
        const activeMegaMenuItems = activeMegaMenu.find('*');

        activeMegaMenu.removeClass('active');
        activeMegaMenuItems.removeClass('active');
        activeMegaMenu.prev().removeClass('active');
        screenLock.unlock();

        MegaMenu.animateMenuBackground(0);
    }
    static hideMegaMenuOnTouch(e) {

        const container = $('.main-header__nav');
        if (!container.is(e.target) && container.has(e.target).length === 0 && $('.mega-menu-wrapper').hasClass('active')) {
            MegaMenu.hideMegaMenu();
        }
    }
    static animateItemsIn(items) {
        items.each((i, v) => {
            $(v).addClass('active');
        });
    }
    static animateMenuBackground(height) {
        $('.main-header .mega-menu-background').stop().animate({
            height: `${height}px`,
        }, 0);
    }
    bindEvents() {
        this.menuItemsLinks.on('click', this.toggleMegaMenu);
        $('.menu-item-type-post_type').on('click', function () {

            // $('.menu-item-type-post_type').attr('aria-expanded', 'false');
            // $(this).attr('aria-expanded', 'true');
        });

        // $('.menu-item-type-post_type a').focus('focusin', function () {
        //     MegaMenu.hideMegaMenu();
        // });
        $(document).on('click touchstart', MegaMenu.hideMegaMenuOnTouch);
    }
    toggleMegaMenu(e) {

        e.preventDefault();
        const megaMenuWrapper = $(this).next('.mega-menu-wrapper');
        const megaMenuCols = megaMenuWrapper.find('[class*="col-"]');

        if (megaMenuWrapper.hasClass('active')) {
            MegaMenu.hideMegaMenu();
            return;
        }

        MegaMenu.hideMegaMenu();
        megaMenuCols.each((i, v) => {
            MegaMenu.animateItemsIn($(v).find('*'));
        });

        screenLock.lock();
        megaMenuWrapper.addClass('active');
        megaMenuWrapper.prev().addClass('active');
        MegaMenu.animateMenuBackground(megaMenuWrapper.outerHeight());

    }
    init() {
        this.bindEvents();
    }
}
export default new MegaMenu();