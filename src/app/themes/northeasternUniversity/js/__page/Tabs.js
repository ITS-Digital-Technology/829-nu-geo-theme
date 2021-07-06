const $ = jQuery.noConflict();

class Tabs {
    constructor() {
        this.tabs = $('.block-tabs');
        this.tabsTriggers = this.tabs.find('.block-tabs__list-item');
        this.tabsContent = this.tabs.find('.block-tabs__tab-content');
        this.tabsMobileTrigger = this.tabs.find('.tabs-mobile-trigger');

    }

    init() {
        this.tabsTriggers.each((i, el) => $(el).on('click', (e) => {
            const clicked = $(e.delegateTarget);
            if (clicked.hasClass('active')) {
                return;
            }
            this.toggleTab(clicked);
        }));
        this.tabsMobileTrigger.on('click', this.toggleMobile.bind(this));
    }

    toggleMobile(e) {
        e.preventDefault();
        let desire = 0;
        this.tabsTriggers.each((i, el) => {
            if ($(el).hasClass('active')) {
                desire = i;
            }
        });

        if ($(e.delegateTarget).hasClass('prev-tab')) {
            desire = desire === 0 ? this.tabsTriggers.length - 1 : desire - 1;
        } else {
            desire = desire === this.tabsTriggers.length - 1 ? 0 : desire + 1;
        }

        if (desire === 0) {
            $('.tabs-mobile-trigger.prev-tab').addClass('hide');
        } else if (desire === this.tabsTriggers.length - 1) {
            $('.tabs-mobile-trigger.next-tab').addClass('hide');
        } else {
            $('.tabs-mobile-trigger.next-tab,.tabs-mobile-trigger.prev-tab').removeClass('hide');
        }

        const tab = this.tabsTriggers[desire];
        this.toggleTab(tab);
    }

    toggleTab(tab) {
        this.tabsTriggers.removeClass('active');
        this.tabsContent.removeClass('active');;

        $(tab).addClass('active');

        this.tabsContent.filter((i, el) => $(el).attr('data-tab') === $(tab).attr('data-tab')).addClass('active');
    }
}

export default new Tabs();
