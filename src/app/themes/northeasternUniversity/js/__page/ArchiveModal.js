const $ = jQuery.noConflict();
class ArchiveModal {
    constructor() {
        this.body = $('body');
        this.sidebar = $(document).find('.eight29-sidebar');
        this.sidebarTop = $(document).find('.eight29-sidebar-top');
        this.breakpoint = 992;
    }
    resized() {
        if (window.matchMedia(`(min-width: ${this.breakpoint}px)`).matches && this.sidebar.hasClass('modal-active') && this.body.hasClass('modal-open') ) {
            this.sidebar.removeClass('modal-active');
            this.body.removeClass('modal-open');
        }
    }
    // hideOutsideClick(e) {
    //     if (this.body.hasClass('post-type-archive-sample_itinerary') && this.sidebar.hasClass('modal-active') && !this.sidebarTop.is(e.target) && this.sidebarTop.has(e.target).length === 0 ) {
    //         this.sidebar.removeClass('modal-active');
    //         this.body.removeClass('modal-open');
    //     }
    // }
}

export default new ArchiveModal();
