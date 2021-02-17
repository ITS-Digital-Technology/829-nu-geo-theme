import screenLock from '../__utils/lockScroll';

const $ = jQuery.noConflict();

class LightboxVideo {
    constructor() {
        this.lightboxTrigger = $('.js-play-lightbox-video');
        this.lightboxWrapper = $('.video-lightbox').first();
        this.lightboxClose = this.lightboxWrapper.find('.video-lightbox__close');
        this.videoWrapper = this.lightboxWrapper.find('.video-lightbox__video');
    }

    init() {
        this.lightboxTrigger.on('click', this.openLightbox.bind(this));
        this.lightboxClose.on('click', this.closeLightbox.bind(this));
    }

    openLightbox(e) {
        e.preventDefault();

        screenLock.lock();
        this.lightboxWrapper.addClass('active');

        let iframe = this.videoWrapper.children('iframe');
        if (!iframe.length) {
            this.videoWrapper.append('<iframe>');
            iframe = this.videoWrapper.children('iframe');
            iframe.attr('allow', 'autoplay');
        }

        const url = e.delegateTarget.dataset.video;
        if (this.isWistia(url)) {
            iframe.attr('src', `https://fast.wistia.net/embed/iframe/${this.isWistia(url)}?autoPlay=1&silentAutoPlay=false&wmode=transparent`);
        } else {
            iframe.attr('src', `${url}&autoplay=1&rel=0&wmode=transparent`);
        }
    }

    closeLightbox() {
        this.videoWrapper.children('iframe').attr('src', '');
        this.lightboxWrapper.removeClass('active');
        screenLock.unlock();
    }

    keyDown(e) {
        if (e.keyCode == 27 && this.lightboxWrapper.hasClass('active')) {
            this.closeLightbox();
        }
    }

    isWistia(url) {
        const wistia = /(?:(?:medias|iframe)\/|wvideo=)([\w-]+)/;
        return (url.match(wistia)) ? RegExp.$1 : false;
    }
}

export default new LightboxVideo();
