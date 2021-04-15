import MegaMenu from '../__header/MegaMenu';
import MobileHeader from '../__header/MobileHeader';
import alertBar from '../__header/alertBar';
import stickyHeader from '../__header/stickyHeader';
import SideMenu from '../__header/SideMenu';
import Search from '../__header/search';
import Accordion from '../__shortcodes/Accordions';
import Tabs from '../__page/Tabs';
import LightboxGallery from '../__page/LightboxGallery';
import video from '../__utils/video';
import { GallerySlider, TestimonialSlider, LightboxSlider, CompareProductsSlider } from '../__utils/Sliders';
import smoothScroll from '../__utils/smoothScroll';
import Tables from '../__utils/Tables';
import forms from '../__utils/forms';
import vhUnit from '../__utils/vhUnit';
import detectDevice from '../__utils/detectDevice';
import LightboxVideo from '../__page/LightboxVideo';
import ProgramFilters from '../__page/ProgramFilters';
import ArchiveModal from '../__page/ArchiveModal';
import ComparePrograms from '../__page/ComparePrograms';
import focusArea from '../__staff/focusArea';
import cookieBar from '../__utils/cookieBar';
import VideoBackground from '../__page/VideoBackground';

import formLabel from '../__utils/formLabel';
import stopAnimation from '../__utils/stopAnimation';
// GLOBAL APP CONTROLLER
const controller = {
	init() {
		document.querySelector('html').classList.remove('no-js');
		detectDevice();
		MegaMenu.init();
		//SideMenu.init();
		MobileHeader.init();
		stickyHeader.resized();
		Search.init();
		Accordion.init();
		Tabs.init();
		video.init();
		GallerySlider.init();
		TestimonialSlider.init();
		LightboxVideo.init();
		LightboxGallery.init();
		LightboxSlider.init();
		alertBar.init();
		ProgramFilters.init();
		smoothScroll();
		formLabel.init();
		Tables.init();
		vhUnit();
		ComparePrograms.init();
		CompareProductsSlider.init();
		focusArea();
		cookieBar.init();
		VideoBackground.init();
	},
	loaded() {
		document.querySelector('body').classList.add('page-has-loaded');
		vhUnit();
	},
	resized() {
		MobileHeader.resized();
		MobileHeader.assignHeightToNav();
		Tables.toggleShadow();
		LightboxGallery.refresh();
		vhUnit();
		SideMenu.assignHeightToSubnav();
		ArchiveModal.resized();
		stickyHeader.resized();
		CompareProductsSlider.init();
		stopAnimation();
		VideoBackground.resized();
	},
	scrolled() {
		stickyHeader.scroll();
		SideMenu.assignHeightToSubnav();
		MobileHeader.assignHeightToNav();
	},
	keyDown(e) {
		LightboxGallery.keyDown(e);
		LightboxVideo.keyDown(e);
		Search.keyDown(e);
	},
	mouseUp(e) {
		MobileHeader.hideOutsideClick(e);
		ProgramFilters.hideOutsideClick(e);
		Search.hideOutsideClick(e);
	},
	gformRender() {
		forms.select();
		formLabel.init();
	},
};
export default controller;
