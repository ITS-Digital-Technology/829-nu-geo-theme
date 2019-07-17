const $ = jQuery.noConflict();

class Accordions {
    constructor(trigger) {
        this.trigger = $(trigger);
    }
    init() {
        this.bindEvents();
    }
    bindEvents() {
        this.trigger.on('click', this.toggleAccordion);
    }
    toggleAccordion() {
        $(this).parent().toggleClass('active');
        $(this).next().stop().slideToggle(250);
    }
}

export default new Accordions('.single-accordion__title');
