let resizeTimer;
let windowWidth = window.innerWidth;
function stopAnimation() {
    if (windowWidth != window.innerWidth) {
        windowWidth = window.innerWidth;
        document.body.classList.add('resize-animation-stopper');
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            document.body.classList.remove('resize-animation-stopper');
        }, 100);
    }
}
export default stopAnimation;