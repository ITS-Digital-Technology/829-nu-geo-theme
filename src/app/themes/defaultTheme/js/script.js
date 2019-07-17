import controller from './__init/controller';

controller.init();

window.onload = () => {
    controller.loaded();
};
window.onresize = () => {
    controller.resized();
};
jQuery(document).bind("mouseup touchend", (e) => {
    controller.mouseUp(e);
});
