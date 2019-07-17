const Video = () => {
    const frames = Array.prototype.slice.call(document.querySelectorAll('.page-content iframe'));
    for (let i = 0; i < frames.length; i += 1) {
        if (frames[i].parentNode.classList.contains('iframe-wrapper') !== true) {
            const html = document.createElement('div');
            html.classList.add('iframe-wrapper');
            html.innerHTML = frames[i].outerHTML;
            frames[i].parentNode.insertBefore(html, frames[i]);
            frames[i].remove();
        }
    }
};

export default Video;
