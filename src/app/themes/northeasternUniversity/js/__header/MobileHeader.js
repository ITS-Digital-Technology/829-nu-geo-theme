import screenLock from '../__utils/lockScroll';

class MobileHeader {
    constructor() {
        this.trigger = document.querySelector('.btn-hamburger');
        this.navMenu = document.querySelector('.main-header__nav-mobile');
        this.body = document.querySelector('body');
        this.listParent = document.querySelectorAll('.main-header__mobile-menu-wrapper > ul > li > a');
        this.backButtons = document.querySelectorAll('.mega-menu-back');
        this.undermenu = document.querySelector('.undermenu');
        this.undermenuTrigger = document.querySelector('.undermenu__trigger');
    }

    init() {
        this.trigger.onclick = e => {
            e.preventDefault();
            if (this.trigger.classList.contains('open')) {
                this.hideWrapper();
            } else {
                this.showWrapper();
            }
        };

        this.listParent.forEach(element => {
            element.onclick = e => {
                e.preventDefault();
                if (!e.target.closest('li').classList.contains('active')) {
                    e.target.closest('li').classList.add('active');
                } else {
                    e.target.closest('li').classList.remove('active');
                }
            };
        });

        this.backButtons.forEach(element => {
            element.onclick = e => {
                e.target.closest('li').classList.remove('active');
            };
        });

        if (this.undermenu && this.undermenuTrigger) {
            this.undermenuTrigger.textContent = this.undermenu.querySelector('.menu li a').textContent;
            this.undermenuTrigger.onclick = e => {
                this.triggerUndermenu();
            };
        }
    }

    assignHeightToNav() {
        const alertBar = document.querySelector('.alert-bar');
        const header = document.querySelector('.main-header');
        let heightToAdd = header.offsetHeight;

        this.navMenu.style.top = `${heightToAdd}px`;

        if (alertBar && header.classList.contains('is-sticky')) {
            heightToAdd -= alertBar.offsetHeight;
        }

        this.navMenu.style.height = `${window.innerHeight - heightToAdd}px`;
    }

    hideWrapper() {
        this.trigger.classList.remove('open');
        this.body.classList.remove('overlayed');
        this.navMenu.classList.remove('active');
        document.querySelectorAll('.main-header__mobile-menu-wrapper li.active').forEach(el => {
            el.classList.remove('active');
        });
        screenLock.unlock();
    }

    showWrapper() {
        this.assignHeightToNav();

        this.trigger.classList.add('open');
        this.body.classList.add('overlayed');
        this.navMenu.classList.add('active');
        screenLock.lock();
    }

    resized() {
        if (window.matchMedia('(min-width: 991px)').matches) {
            if (this.trigger.classList.contains('open')) {
                this.hideWrapper();
            }
        }
    }

    hideOutsideClick(e) {
        if (this.trigger.length > 0 && this.trigger.classList.contains('open')) {
            const container = $('.main-header');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                this.hideWrapper();
            }
        }
    }

    triggerUndermenu() {
        if (this.undermenu.classList.contains('active')) {
            this.undermenu.classList.remove('active');
        } else {
            this.undermenu.classList.add('active');
        }
    }
}

export default new MobileHeader();