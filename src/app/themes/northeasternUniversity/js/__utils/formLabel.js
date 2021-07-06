const $ = jQuery.noConflict();
const formLabel = {

    init() {
        this.textareas = document.querySelectorAll('textarea');
        this.watchTextareas();
    },

    watchTextareas() {
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(el => {
            el.setAttribute('rows', '0');

            el.addEventListener('input', (e) => {
                e.target.style.height = 'auto';
                e.target.style.height = e.target.scrollHeight + 'px';
            }, false);
        });

    },
};

export default formLabel;
