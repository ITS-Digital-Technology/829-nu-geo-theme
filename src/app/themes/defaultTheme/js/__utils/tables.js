const $ = jQuery.noConflict();
class Tables {
    constructor() {
        this.tables = $('table.tablepress');
    }
    init() {
        this.wrapTables();
        this.responsiveTableWidth();
        this.toggleTablesShadow();
    }
    wrapTables() {
        this.tables.wrap('<div class="table-wrapper"></div>');
    }
    toggleTablesShadow() {
        function shadowFunc() {
            const el = $(this);
            const body = el.find('tbody');
            if (body[0].offsetWidth < body[0].scrollWidth) {
                el.addClass('has-scroll');
            } else {
                el.removeClass('has-scroll');
            }
        }
        this.tables.each(shadowFunc);
    }
    responsiveTableWidth() {
        function tableWidth() {
            const newWidth = $(window).width() - $(this).offset().left;
            if ($('.tablet-checker').is(':visible')) {
                $(this).width(newWidth);
            } else {
                $(this).width('');
            }
        }
        this.tables.each(tableWidth);
    }
}
export default new Tables();
