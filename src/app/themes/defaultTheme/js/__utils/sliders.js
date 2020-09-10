const $ = jQuery.noConflict();

class Slider {
    constructor( selector, args = {} ) {
        this.selector = selector;
        this.args = args;
    }

    getDefaultSlickSettings() {
        return {
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            speed: 600,
        }
    }

    /**
     * Override our default slick settings with args provided to the class.
     */
    getSlickSettings() {
        return Object.assign( {}, this.getDefaultSlickSettings(), this.args );
    }

    init() {
        let settings = this.getSlickSettings();

        $( this.selector ).slick( settings );
    }
}
const SimpleSlider = new Slider('.bc-gallery__slider');
const LightboxSlider = new Slider('.lightbox-gallery__slider');

export { SimpleSlider, LightboxSlider };
