import screenLock from '../__utils/lockScroll';
const $ = jQuery.noConflict();
class SideMenu {
    constructor() {
        this.topbar = document.querySelector('.topbar');
        this.sidemenu = document.querySelector('.topbar__subnav');
        this.tabs = document.querySelector('.subnav-tabs');
        this.tabsTriggers = document.querySelectorAll('button[data-target*="subnav-tab"]');
        this.triggerMenu = document.querySelector('.subnav-trigger');
        this.alertBar = document.querySelector('.alert-bar');
        this.mql = window.matchMedia('(max-width: 1200px)');
        this.body = document.querySelector('body');
    };

    init() {
        this.triggerMenu.addEventListener('click', () => {
            if (this.sidemenu.classList.contains('active')) {
                this.closeMenu();
            } else {
                this.openMenu();
            }
        });

        this.assignHeightToSubnav();

        document.addEventListener('click', (e) => {
            if (this.sidemenu.classList.contains('active') && (!e.target.closest('.topbar__subnav') && !e.target.closest('.topbar__button'))) {
                this.closeMenu();
            }
        });

        this.toggleTab(false, true);

        this.tabsTriggers.forEach((el) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggleTab(el);
            });
        });
    };

    assignHeightToSubnav() {
        let alertBarHeight = 0;
        if (this.alertBar && !(window.scrollY > alertBarHeight + 10)) {
            alertBarHeight = this.alertBar.offsetHeight;
        }

        const topbarHeight = this.topbar.offsetHeight;
        let heightToAdd = topbarHeight + alertBarHeight;

        this.sidemenu.style.height = window.innerHeight - heightToAdd + 'px';

        // when after 10px of scroll, sticky header fires and it gives header translateY(-50px);
        if (window.scrollY > alertBarHeight + 10 && this.body.classList.contains('alert-bar-on')) {
            heightToAdd += this.alertBar.offsetHeight;
        }

        this.sidemenu.style.top = heightToAdd + 'px';
    };

    openMenu() {
        this.sidemenu.classList.add('active');
        this.triggerMenu.classList.add('active');
        this.topbar.classList.add('active');
        screenLock.lock();
    };

    closeMenu() {
        this.sidemenu.classList.remove('active');
        this.triggerMenu.classList.remove('active');
        this.topbar.classList.remove('active');
        screenLock.unlock();
    };

    toggleTab(element, isFirst = false) {
        const name = this.mql.matches ? '.topbar__menu-accordion' : '.subnav-tabs__tab';

        if (isFirst) {
            document.querySelector(name).classList.add('active');
            document.querySelector('button[data-target*="subnav-tab"]').classList.add('active');
            if (this.mql.matches) {
                $(name).first().slideDown(300);
            }
            return;
        }

        if (element.dataset) {
            const currentActiveTab = document.querySelector(`${name}.active`);
            if (currentActiveTab) {
                currentActiveTab.classList.remove('active');
                if (this.mql.matches) {
                    $(currentActiveTab).slideUp(300);
                }
            }

            const currentActiveButton = document.querySelector('button.active[data-target*="subnav-tab"]');
            if (currentActiveButton) {
                currentActiveButton.classList.remove('active');
            }

            if (currentActiveTab && this.mql.matches && currentActiveTab.previousElementSibling == element) {
                return;
            }

            element.classList.add('active');

            if (this.mql.matches) {
                element.nextElementSibling.classList.add('active');
                $(element.nextElementSibling).slideDown(300);
            } else {
                const target = element.dataset.target;
                document.querySelector(`#${target}`).classList.add('active');
            }
        }
    };
}

export default new SideMenu;