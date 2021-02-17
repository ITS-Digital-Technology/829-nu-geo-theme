import screenLock from '../__utils/lockScroll';
const $ = jQuery.noConflict();

const search = {
    triggers: document.querySelectorAll('.main-header__search-button'),
    searchBar: document.querySelector('.search-bar'),
    searchClose: document.querySelector('.search-bar__close'),
    searchInput: document.querySelector('.search-form__input'),

    init() {
        this.triggers.forEach(el => {
            el.onclick = e => {
                e.preventDefault();
                this.triggerSearch();
            };
        });

        this.searchClose.onclick = e => {
            e.preventDefault();
            this.triggerSearch();
        }
    },

    triggerSearch() {
        if (this.searchBar.classList.contains('active')) {
            this.searchBar.classList.remove('active');
            this.searchInput.value = '';
            screenLock.unlock();
        } else {
            this.searchInput.focus();
            this.searchBar.classList.add('active');
            screenLock.lock();
        }
    }
};

export default search;