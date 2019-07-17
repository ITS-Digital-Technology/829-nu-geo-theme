// Fix for disabled scroll on IOS
const $ = jQuery.noConflict();
let disableScroll = false;
let scrollPos = 0;
function stopScroll() {
    disableScroll = true;
    scrollPos = $(window).scrollTop();
    $('body').addClass('lock-scroll');
}
function enableScroll() {
    disableScroll = false;
    $('body').removeClass('lock-scroll');
}
function bindScrollEvents() {
    $(window).bind('scroll', () => {
        if (disableScroll) {
            $(window).scrollTop(scrollPos);
        }
    });
    $(window).bind('touchmove', () => {
        $(window).trigger('scroll');
    });
}
export default bindScrollEvents;
export { enableScroll, stopScroll };
