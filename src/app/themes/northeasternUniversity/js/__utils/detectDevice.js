function isTouchDevice() {
    return 'ontouchstart' in window || navigator.msMaxTouchPoints;
}


function detectDevice() {
    if (isTouchDevice()) {
        document.querySelector('html').classList.add('touch-device');

        const iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
        if (iOS) {
            document.querySelector('html').classList.add('ios');
        }
    }
}

export default detectDevice;