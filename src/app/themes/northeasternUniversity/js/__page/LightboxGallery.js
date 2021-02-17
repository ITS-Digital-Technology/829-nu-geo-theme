import screenLock from '../__utils/lockScroll';

const $ = jQuery.noConflict();

class LightboxGallery {
    constructor() {
        this.lightboxBlock = $('.block-gallery-lightbox');
        this.lightboxWrapper = this.lightboxBlock.find('.block-gallery-lightbox__gallery-wrapper');
        this.lightboxes = this.lightboxBlock.find('.block-gallery-lightbox__slider');
        this.lightboxThumb = this.lightboxBlock.find('.block-gallery-lightbox__single-thumb');
        this.lightboxClose = this.lightboxBlock.find('.block-gallery-lightbox__close');
    }

    init() {
        this.lightboxThumb.on('click', this.openLightbox);
        this.lightboxClose.on('click', this.closeLightbox.bind(this));
    }

    openLightbox(e) {
        screenLock.lock();

        e.preventDefault();
        const slideNum = parseInt(this.hash.slice(1), 10);
        const lightboxBlock = $(this).closest('.block-gallery-lightbox');

        lightboxBlock.find('.block-gallery-lightbox__gallery-wrapper').addClass('active');
        lightboxBlock.find('.block-gallery-lightbox__slider').slick('slickGoTo', slideNum, true);
    }

    closeLightbox() {
        this.lightboxWrapper.removeClass('active');
        screenLock.unlock();
    }

    refresh() {
        this.lightboxes.slick('refresh');
    }

    keyDown(e) {
        if (e.keyCode == 27 && this.lightboxWrapper.hasClass('active') ) {
            this.closeLightbox();
        }
    }
}

export default new LightboxGallery();
