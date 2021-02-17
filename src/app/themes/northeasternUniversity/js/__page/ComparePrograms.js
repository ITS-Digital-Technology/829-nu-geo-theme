const $ = jQuery.noConflict();

class ComparePrograms {
    constructor() {
        this.buttons = document.querySelectorAll('.block-program-comparison__programs-nav-item');
        this.compareButton = document.querySelectorAll('.block-program-comparison__programs-information-button .c-btn');
    }
    init() {
        [...this.buttons].forEach(button => {
            button.addEventListener('click', () => this.toggleTab(event))
        });

        [...this.compareButton].forEach(button => {
            button.addEventListener('click', () => this.toggleCompare(event))
        })

    }
    toggleTab(e) {
        e.preventDefault();
        const dataId = e.currentTarget.dataset.tab;
        const wrapper = e.currentTarget.closest('.block-program-comparison');
        const buttons = wrapper.querySelectorAll('.block-program-comparison__programs-nav-item');
        const tabContents = wrapper.querySelectorAll('.block-program-comparison__programs-tab');
        const tabContent = wrapper.querySelector(`.block-program-comparison__programs-tab[data-tab="${dataId}"]`);
        const slickWrapper = $(tabContent).find('.block-program-comparison__programs-tab-wrapper');

        [...buttons].forEach(button => {
            if (button.classList.contains("active")) {
                button.classList.remove('active');
            }
        });

        [...tabContents].forEach(tab => {
            tab.classList.remove('active');
            if (tab.classList.contains("active")) {
                tab.classList.remove('active');
            }
        })

        e.currentTarget.classList.add('active');
        tabContent.classList.add('active');
        slickWrapper.slick('setPosition'); 

    }

    toggleCompare(e) {
        e.preventDefault();
        const informations = $(e.currentTarget).closest('.block-program-comparison__programs-tab').find('.block-program-comparison__programs-article-informations');
        const block = e.currentTarget.closest('.block-program-comparison__programs');

        block.classList.toggle('open-info');
        e.currentTarget.classList.toggle('active');
        informations.stop().slideToggle(250); 
    }
}

export default new ComparePrograms();