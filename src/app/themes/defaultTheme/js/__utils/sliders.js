const $ = jQuery.noConflict();

class Slider {
    constructor(sel, fade = false, num = 1, tabNum = 1, slideSpeed = 600, variableWidth = false) {
        this.selector = sel;
        this.num = num;
        this.tabNum = tabNum;
        this.variableWidth = variableWidth;
        this.slideSpeed = slideSpeed;
        this.fade = fade;
    }
    init() {
        const {
            num,
            fade,
            tabNum,
            slideSpeed,
            variableWidth,
        } = this;

        function slideSettings() {
            $(this).slick({
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: num,
                slidesToScroll: 1,
                variableWidth,
                fade,
                pauseOnHover: false,
                speed: slideSpeed,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: tabNum,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        }
        $(this.selector).each(slideSettings);
    }
}
const SimpleSlider = new Slider('.bc-gallery__slider');
const LightboxSlider = new Slider('.lightbox-gallery__slider');

export { SimpleSlider, LightboxSlider };
