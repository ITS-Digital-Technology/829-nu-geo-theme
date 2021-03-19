import MobileHeader from '../__header/MobileHeader';

const $ = jQuery.noConflict();
function scrollFunc(e) {
    e.preventDefault();
    const header = $('.main-header');
    const target = $($(this).attr('href'));
    const headerHeight = header.outerHeight();
    
    if ($(this).attr('href') === '#next' && $(this).parents('section').next().length > 0) {
        // Smooth Scroll to next section
        $('html, body').animate({
            scrollTop: $(this).parents('section').next().offset().top - headerHeight,
        }, 600);
        MobileHeader.hideWrapper('.btn-hamburger', $('body'));
    } else if (target.length) {
        $('html, body').animate({
            scrollTop: target.offset().top - headerHeight,
        }, 600);
        MobileHeader.hideWrapper('.btn-hamburger', $('body'));
    }
}
function smoothScroll() {
    $('a[href^="#"]:not([href="#"])').on('click', scrollFunc);
}
export default smoothScroll;
