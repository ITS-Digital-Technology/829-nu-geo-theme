const $ = jQuery.noConflict();
import screenLock from '../__utils/lockScroll';

class ProgramFilters {
    constructor() {
        this.filters = $('.program-filters');
        this.trigger = this.filters.find('.program-filters__filter-trigger');
        this.dropdown = this.filters.find('.program-filters__filter-list-wrapper')
        this.searchProgramsBtn = this.filters.find('.program-filters__search-wrapper > a');
        this.filterInputs = this.filters.find('.program-filters__filter-list-item input[type=checkbox]');
        this.btnHref = this.searchProgramsBtn.attr('href');

        //Mobile
        this.openMobileProgramsBtn = this.filters.find('.program-filters__trigger-mobile');
        this.closeMobileProgramsBtn = this.filters.find('.program-filters__mobile-close');
        this.outerWrapperPrograms = this.filters.find('.program-filters__wrapper-outer');
        // Data Passed
        this.programsTypes = [];
        this.countries = [];
        this.terms = [];
        this.fieldsOfStudy =[];
    }

    init() {
        this.trigger.on('click', this.toggleDropdown.bind(this));
        // Apply filter term
        this.filterInputs.on('change', (e) => {
            this.applyTerms(e);
        });
        this.openMobileProgramsBtn.on('click', this.openMobilePrograms.bind(this));
        this.closeMobileProgramsBtn.on('click', this.closeMobilePrograms.bind(this));
    }

    openMobilePrograms() {
        this.outerWrapperPrograms.addClass('active');
        screenLock.lock();
    }
    closeMobilePrograms() {
        if(this.outerWrapperPrograms.hasClass('active')){
            this.outerWrapperPrograms.removeClass('active');
        }
        screenLock.unlock();

    }

    applyTerms(e) {
        this.programsTypes = [];
        this.countries = [];
        this.terms = [];
        this.fieldsOfStudy = [];

        const filtersAll = $(e.delegateTarget).closest('.program-filters__filter-list').find('input[type=checkbox]:not([data-id="all"])');
        let bool = false;
        filtersAll.each((index,el) =>{
            if($(el).prop('checked') === false) {
                bool = false;
                return false;
            } else {
                bool= true;
            }
        });

        if ($(e.delegateTarget).data('id') === 'all' ) {
            $(e.delegateTarget).closest('.program-filters__filter-list').find('input[type=checkbox]').prop('checked', true);
            $(e.delegateTarget).attr('disabled',true);
        }

        if( $(e.delegateTarget).data('id') !== 'all' && $(e.delegateTarget).prop('checked') === false ){
           $(e.delegateTarget).closest('.program-filters__filter-list').find('input[type=checkbox][data-id="all"]').attr('disabled', false);
           $(e.delegateTarget).closest('.program-filters__filter-list').find('input[type=checkbox][data-id="all"]').prop('checked', false);
        } else if(bool){
            $(e.delegateTarget).closest('.program-filters__filter-list').find('input[type=checkbox][data-id="all"]').attr('disabled', true);
            $(e.delegateTarget).closest('.program-filters__filter-list').find('input[type=checkbox][data-id="all"]').prop('checked', true);
        }


        //type
        if ($(e.delegateTarget).data('tax') === 'program_type' ) {
            $(e.delegateTarget).closest('.program-filters__filter-list-wrapper').prev().text('All Programs');
        }

        this.filterInputs.filter((i, e) => $(e).data('tax') === 'program_type' && $(e).is(':checked')).each((i, e) => {
            if ($(e).data('id') !== 'all') {
                this.programsTypes.push($(e).data('id'));
                 if(this.programsTypes.length <= 1){
                    $(e).closest('.program-filters__filter-list-wrapper').prev().text($(e).next().text());
                } else {
                    $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                }
            } else {
                this.programsTypes = [];
                $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                return false;
            }

        });

        if ($(e.delegateTarget).data('tax') === 'country' ) {
            $(e.delegateTarget).closest('.program-filters__filter-list-wrapper').prev().text('All Countries');
        }
        this.filterInputs.filter((i, e) => $(e).data('tax') === 'country' && $(e).is(':checked')).each((i, e) => {
            if ($(e).data('id') !== 'all') {
                this.countries.push($(e).data('id'));
                if(this.countries.length <= 1){
                   $(e).closest('.program-filters__filter-list-wrapper').prev().text($(e).next().text());
                } else {
                   $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                }
            } else {
                this.countries = [];
                $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                return false;
            }
        });

        if ($(e.delegateTarget).data('tax') === 'term' ) {
            $(e.delegateTarget).closest('.program-filters__filter-list-wrapper').prev().text('All Terms');
        }
        this.filterInputs.filter((i, e) => $(e).data('tax') === 'term' && $(e).is(':checked')).each((i, e) => {
            if ($(e).data('id') !== 'all') {
                this.terms.push($(e).data('id'));
                if(this.terms.length <= 1){
                    $(e).closest('.program-filters__filter-list-wrapper').prev().text($(e).next().text());
                 } else {
                    $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                 }
            } else {
                this.terms = [];
                $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                return false;
            }
        });

        if ($(e.delegateTarget).data('tax') === 'field_of_study' ) {
            $(e.delegateTarget).closest('.program-filters__filter-list-wrapper').prev().text('All Fields');
        }

        this.filterInputs.filter( (i, e) => $(e).data('tax') === 'field_of_study' && $(e).is(':checked')).each((i, e) => {
            if ($(e).data('id') !== 'all') {
                this.fieldsOfStudy.push($(e).data('id'));
                if(this.fieldsOfStudy.length <= 1){
                    $(e).closest('.program-filters__filter-list-wrapper').prev().text($(e).next().text());
                 } else {
                    $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                 }
            } else {
                this.fieldsOfStudy = [];
                $(e).closest('.program-filters__filter-list-wrapper').prev().text('Multiple');
                return false;
            }
        });



        this.closeDropdown();
        this.updateBtnURL();
    }

    updateBtnURL() {
        let programTypeAttr = '';
        let countryAttr = '';
        let termsAttr = '';
        let fieldsOfStudyAttr = '';
        let parameters = [];
        let parametersString = '';

        if(this.programsTypes.length > 0){
            programTypeAttr = `p_type=${this.programsTypes}`;
            parameters.push(programTypeAttr);
        }
        if(this.countries.length > 0){
            countryAttr = `p_country=${this.countries}`;
            parameters.push(countryAttr);
        }
        if(this.terms.length > 0){
            termsAttr = `p_term=${this.terms}`;
            parameters.push(termsAttr);
        }
        if(this.fieldsOfStudy.length > 0) {
            fieldsOfStudyAttr = `p_field_of_study=${this.fieldsOfStudy}`;
            parameters.push(fieldsOfStudyAttr);
        }
        if(parameters.length > 0){
            parametersString = `?${parameters.join("&")}`;
        }

        const newUrl =`${this.btnHref}${parametersString}`;
        this.searchProgramsBtn.attr('href',newUrl);
    }


    toggleDropdown(e) {
        const el = $(e.delegateTarget);
        if ($(el).hasClass('active')) {
            this.closeDropdown();
            return;
        }
        this.closeDropdown();
        this.openDropdown(e);
    }

    openDropdown(e) {
        const item = $(e.delegateTarget);
        const dropdown = item.next('.program-filters__filter-list-wrapper');
        this.closeDropdown();
        item.addClass('active');
        dropdown.addClass('active');
    }

    closeDropdown() {
        this.trigger.removeClass('active');
        this.dropdown.removeClass('active');
    }

    hideOutsideClick(e) {
        if (this.dropdown.hasClass('active') && !this.dropdown.is(e.target) && this.dropdown.has(e.target).length === 0 && !this.trigger.is(e.target)) {
            this.closeDropdown();
        }
    }


}

export default new ProgramFilters();
