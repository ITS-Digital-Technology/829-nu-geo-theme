const $ = jQuery.noConflict();

class Tabs {
    constructor(wrapper, tabsLink, tabsControls) {
        this.tabsWrapper = $(wrapper);
        this.tabsLink = $(tabsLink);
        this.tabsControls = this.tabsWrapper.find(tabsControls);
    }
    init() {
        this.tabsLink.on('click', this.toggleTab);
        this.mobileTabsNav();
    }
    mobileTabsNav() {
        const list = $('.tabs__link-list');
        function shadowFunc() {
            const el = $(this);
            const parent = el.parents('.tab-head-wrap');
            if ( el[0].offsetWidth < el[0].scrollWidth) {
                parent.addClass('has-scroll');
            } else {
               parent.removeClass('has-scroll');
            }
        }
        list.each(shadowFunc);
    }
    toggleTab(e) {
        e.preventDefault();

        const el = $(this);
        const targetId = this.hash;
        const wrapper = el.closest('.block-tabs');
        const parentList = el.parents('.tabs__link-list');

        const target = wrapper.find(`.tabs__tab-content[data-tab-id="${targetId}"]`);

        wrapper.find('.tabs__tab-content').removeClass('active');
        wrapper.find('.tabs__link').removeClass('active');

        el.parent().addClass('active');
        target.addClass('active');

       /* if (window.matchMedia('(max-width: 767px)').matches && !parentList.hasClass('slick-initialized')) {
            const childNum = parentList[0].childElementCount;
            let middle = Math.ceil(childNum / 2);
            const listActive = parentList.children('li.active');
            const elIndex = el.parent().index() + 1;
            if (elIndex > middle) {
                middle = Math.floor(childNum / 2);
            }
            parentList.find(`li:nth-child(${middle})`).after(listActive);
        }*/
    }
}

export default new Tabs('.tabs__link-list-wrapper', '.tabs__link a', '.tab-nav-button');
