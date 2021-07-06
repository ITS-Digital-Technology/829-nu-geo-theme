const $ = jQuery.noConflict();

class Slider {
    constructor(selector, args = {}) {
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
            rows: 0,
        }
    }

    /**
     * Override our default slick settings with args provided to the class.
     */
    getSlickSettings() {
        return Object.assign({}, this.getDefaultSlickSettings(), this.args);
    }

    init() {
        // Set max-width to slider captions when variableWidth = true
        $(this.selector).on('setPosition', () => {
            $(this.selector).find('figcaption').each((i, item) => {
                const caption = $(item);
                const width = caption.prev('img').width();

                caption.css('max-width', width > 0 ? `${width}px` : '');
            });
        });

        let settings = this.getSlickSettings();

        if( !$(this.selector).hasClass('slick-initialized') ) {
            $( this.selector ).slick( settings );
        }
    }
}


const GallerySlider = new Slider(
    '.block-gallery-slider__slider',
    {
        variableWidth: true,
        centerMode: true,
    }
);

const TestimonialSlider = new Slider(
    '.testimonial-slider',
    {
        dots: true
    }
);

const LightboxSlider = new Slider(
    '.block-gallery-lightbox__slider',
    {
        variableWidth: true,
        centerMode: true,
    }
);

const CompareProductsSlider = new Slider(
    '.block-program-comparison__programs-tab-wrapper',
    {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        mobileFirst: true,
        responsive: [
            {
                breakpoint: 992,
                settings: 'unslick'
            }
        ]
    }
);

export { GallerySlider, TestimonialSlider, LightboxSlider, CompareProductsSlider };
