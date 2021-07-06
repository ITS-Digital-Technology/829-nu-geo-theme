import controller from './__init/controller';
import detectTabNav from './__utils/detectTabNav';
import throttle from 'lodash/throttle';

let handled = false;

const handleMouseAndTouchEvents = (e) => {
	if (e.type === "touchend") {
		handled = true;
		controller.mouseUp(e);
	} else if (e.type === "mouseup" && !handled) {
		controller.mouseUp(e);
	} else {
		handled = false;
	}
};

controller.init();
window.addEventListener('load', controller.loaded);
window.addEventListener('scroll', throttle(controller.scrolled, 100), { passive: true });
window.addEventListener('resize', throttle(controller.resized, 100));
window.addEventListener('keydown', e => {
    detectTabNav(e);
    controller.keyDown(e);
});
document.addEventListener('mouseup', handleMouseAndTouchEvents);
document.addEventListener('touchend', handleMouseAndTouchEvents);

// Gravity Forms
jQuery(document).on('gform_post_render', controller.gformRender);