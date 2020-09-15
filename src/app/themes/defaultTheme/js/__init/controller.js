import MegaMenu from '../__header/MegaMenu';
import MobileHeader from '../__header/mobileHeader';
import Accordion from '../__shortcodes/accordions';
import Tabs from '../__page/tabs';
import GalleryLightbox from '../__page/lightboxGallery';
import video from '../__utils/video';
import { SimpleSlider, LightboxSlider } from '../__utils/sliders';
import smoothScroll from '../__utils/smoothScroll';
import Tables from '../__utils/tables';
import Forms from '../__utils/forms';

const headerMobile = new MobileHeader();

// GLOBAL APP CONTROLLER
const controller = {
    init() {
        document.querySelector('html').classList.remove('no-js');
        MegaMenu.init();
        headerMobile.init();
        Accordion.init();
        Tabs.init();
        video.init();
        SimpleSlider.init();
        LightboxSlider.init();
        GalleryLightbox.init();
        smoothScroll();
        Tables.init();
    },
    loaded() {
        document.querySelector('body').classList.add('page-has-loaded');
        Forms();
    },
    resized() {
        headerMobile.resized();
        Tables.toggleShadow();
        GalleryLightbox.refreshSlider();
    },
    scrolled() {

    },
    keyDown(e){

    },
    mouseUp(e) {
        headerMobile.hideOutsideClick(e);
    },
};
export default controller;
