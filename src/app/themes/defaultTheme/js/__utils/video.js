const $ = jQuery.noConflict();

const video = {
    iframeWrapper: $('.iframe-wrapper'),
    init() {
        const overlay = video.iframeWrapper.find('.iframe-wrapper__overlay');
        overlay.on('click', this.hideOverlay);
    },
    hideOverlay(e) {
        e.preventDefault();
        video.iframeWrapper.each((i ,el)=>{
            const iframeSrc = $(el).find('iframe').attr('src');
            if(iframeSrc) {
                $(el).find('iframe')[0].src = '';
            }
            const imageUrl = $(el).data('image-src');
            $(el).find('.iframe-wrapper__overlay').css('background-image', 'url(' + imageUrl + ')').show();
        });

        const parent = $(this).parents('.iframe-wrapper');
        parent.find('iframe')[0].src = parent.find('iframe')[0].dataset.src;
        if (!parent.hasClass('wistia')) {
            parent.find('iframe')[0].src += '&autoplay=1&loop=1&rel=0&wmode=transparent';
        } else {
            parent.find('iframe')[0].src = `https://fast.wistia.net/embed/iframe/${parent.data('video-id')}?autoplay=1&silentAutoPlay=false`;
        }
        $(this).delay(300).fadeOut();
    }
};

export default video;
