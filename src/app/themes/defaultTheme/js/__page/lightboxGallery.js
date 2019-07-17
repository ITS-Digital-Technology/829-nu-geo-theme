import { enableScroll, stopScroll } from '../__utils/lockScroll';

const $ = jQuery.noConflict();

class LightboxGallery {
    constructor() {
        this.lightboxes = $('.lightbox-gallery__slider');
        this.lightboxOpen = $('.lightbox-gallery__single-thumb');
        this.lightboxClose = $('.lightbox-gallery__close');
    }
    init() {
        this.bindEvents();
    }
    bindEvents() {
        this.lightboxOpen.on('click', this.openLightbox);
        this.lightboxClose.on('click', this.closeLightbox);
    }
    openLightbox(e) {
        e.preventDefault();
        const slideNum = parseInt(this.hash.slice(1), 10);
        const lightboxBlock = $(this).closest('.block-gallery-lightbox');

        lightboxBlock.find('.lightbox-gallery__gallery-wrapper').addClass('active');
        lightboxBlock.find('.lightbox-gallery__slider').slick('slickGoTo', slideNum, true);
        stopScroll();
    }
    refreshSlider() {
        this.lightboxes.slick('refresh');
    }
    closeLightbox() {
        const lightboxWrapper = $(this).parent('.lightbox-gallery__gallery-wrapper');
        lightboxWrapper.removeClass('active');
        enableScroll();
    }
}
export default new LightboxGallery();
