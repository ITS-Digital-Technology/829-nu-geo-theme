const stickyHeader = {
    header: document.querySelector('.main-header'),
    alertBar: document.querySelector('.alert-bar'),
    searchBar: document.querySelector('.search-bar'),
    page: document.querySelector('#page'),

    resized() {
        this.page.style.paddingTop = `${this.header.offsetHeight}px`;
    },

    scroll() {
        let alertBarHeight = 0;
        if (this.alertBar) {
            alertBarHeight = this.alertBar.offsetHeight;
        }

        if (window.scrollY > alertBarHeight + 10) {
            this.header.classList.add('is-sticky');
            this.header.style.transform = `translateY(-${alertBarHeight}px)`;
            this.searchBar.style.transform = `translateY(${alertBarHeight}px)`;
        } else {
            this.header.classList.remove('is-sticky');
            this.header.style.transform = `translateY(0)`;
            this.searchBar.style.transform = `translateY(0)`;
        }
    }
};

export default stickyHeader;