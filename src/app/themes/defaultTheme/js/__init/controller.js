import MegaMenu from '../__header/MegaMenu';
import MobileHeader from '../__header/MobileHeader';
import Accordion from '../__shortcodes/Accordions';
import Tabs from '../__page/Tabs';
import LightboxGallery from '../__page/LightboxGallery';
import video from '../__utils/video';
import { SimpleSlider, LightboxSlider } from '../__utils/Sliders';
import smoothScroll from '../__utils/smoothScroll';
import Tables from '../__utils/Tables';
import Forms from '../__utils/forms';
import vhUnit from '../__utils/vhUnit';

// GLOBAL APP CONTROLLER
const controller = {
    init() {
        document.querySelector('html').classList.remove('no-js');
        MegaMenu.init();
        MobileHeader.init();
        Accordion.init();
        Tabs.init();
        video.init();
        SimpleSlider.init();
        LightboxSlider.init();
        LightboxGallery.init();
        smoothScroll();
        Tables.init();
        vhUnit();
    },
    loaded() {
        document.querySelector('body').classList.add('page-has-loaded');
        Forms();
        vhUnit();
    },
    resized() {
        MobileHeader.resized();
        Tables.toggleShadow();
        LightboxGallery.refreshSlider();
        vhUnit();
    },
    scrolled() {

    },
    keyDown(e){

    },
    mouseUp(e) {
        MobileHeader.hideOutsideClick(e);
    },
};
export default controller;
