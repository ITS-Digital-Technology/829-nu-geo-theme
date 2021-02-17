import React, { useState } from 'react';
import FilterSearch from './filters/FilterSearch';
import FilterCheckbox from './filters/FilterCheckbox';
import FilterSelect from './filters/FilterSelect';
import FilterAccordionMultiSelect from './filters/FilterAccordionMultiSelect';
import FilterAccordionSingleSelect from './filters/FilterAccordionSingleSelect';
import FilterButtonGroup from './filters/FilterButtonGroup';
import FilterOrderBy from './filters/FilterOrderBy';
import FilterDate from './filters/FilterDate';
import CloseIcon from '../assets/images/icons/CloseIcon.svgr';


function sidebar(props) {
    const [modalVisible, setModalVisible] = useState(false);

    const {
        layout,
        filters,
        results,
        currentSearchTerm,
        selected,
        mobileStyle,
        displayPostCounts,
        order,
        autoLoadFilters,
        filterReset,
        sidebarLeft,
        sidebarRight,
        displayReset,
        displayResults,
        displaySort,
        displaySearch,
        postsPerPage,
        currentPage,
        maxPages,
        postType,

        orderChange,
        toggleSelected,
        replaceSelected,
        addToSelected,
        isSelected,
        resetSelected,
        searchFieldChange,
        setCurrentPage,
        setChangedFilter,
        setFilterReset,
    } = props;

    const className = props.className ? props.className : '';

    const components = {
        'checkbox': FilterCheckbox,
        'select': FilterSelect,
        'button-group': FilterButtonGroup,
        'accordion-multi-select': FilterAccordionMultiSelect,
        'accordion-single-select': FilterAccordionSingleSelect,
        'date': FilterDate
    }

    const filterList = autoLoadFilters ? [] : props.children;
    let modalClose;
    let modalOpen;
    let applyFilters;
    let contentLeft;
    let contentRight;
    let sidebarDetail;
    let reset;
    let sidebarReset;
    let totalResults;
    let searchComponent;
    let sortComponent;
    let sidebarBottom;
    let moreFiltersButton;


    function toggleModal(e) {
        e.preventDefault();
        if (document.body.classList.contains('modal-open')) {
            document.body.classList.remove('modal-open');
            document.querySelector('.eight29-sidebar').classList.remove('modal-active');
        } else {
            document.body.classList.add('modal-open');
            document.querySelector('.eight29-sidebar').classList.add('modal-active');
        }

        setModalVisible(!modalVisible);
    }

    function resetCat(e) {
        e.preventDefault();
        resetSelected();
      }


    function toggleFilters(e) {
        e.preventDefault();
        const filtersWrapper = document.querySelector('.more-less-wrapper');
        const filters = document.querySelectorAll('.eight29-filter.filter-checkbox');
        const buttonMore = document.querySelector('button.more-filters');
        filtersWrapper.classList.toggle('active');
        if ( filtersWrapper.classList.contains('active') ) {
            buttonMore.innerHTML = 'Less Filters';
            filters.forEach(el => {
                el.classList.remove('d-hide');
            });
        }else{
            buttonMore.innerHTML = 'More Filters';
            filters.forEach( (el,index ) => {
                if(index >= 4){
                    el.classList.add('d-hide');
                }
            });
        }
    }

    if (Object.entries(filters).length !== 0 && autoLoadFilters) {
        let i = 0;
        for (const taxonomy in filters) {
            const type = filters[taxonomy].type;
            const TheFilter = components[type];
            const classFilter = '';
            if(postType === "program"){
                if ( i >= 4 ) {
                    classFilter = 'd-hide';
                }
                if( i > 4) {
                    moreFiltersButton = <div className="more-less-wrapper"><button
                        className="more-filters"
                        onClick={(e) => { toggleFilters(e) }}
                    >
                    More Fiters
                    </button>
                    </div>
                }
            }

            filterList.push(
                <TheFilter
                    key={i++}
                    label={filters[taxonomy].label}
                    taxonomy={filters[taxonomy].terms}
                    taxSlug={taxonomy}
                    terraDotta={filters[taxonomy].terraDotta}
                    selected={selected}
                    displayPostCounts={displayPostCounts}
                    collapsible={filters[taxonomy].collapsible}
                    scrollable={filters[taxonomy].scrollable}
                    dropdown={filters[taxonomy].dropdown}
                    filterReset={filterReset}
                    classFilter ={classFilter}
                    resetSelected={resetSelected}
                    toggleSelected={toggleSelected}
                    replaceSelected={replaceSelected}
                    addToSelected={addToSelected}
                    isSelected={isSelected}
                    postType={postType}
                    setCurrentPage={setCurrentPage}
                    setChangedFilter={setChangedFilter}
                    setFilterReset={setFilterReset}
                ></TheFilter>
            );

        }
    }

    if (mobileStyle === 'modal') {
        modalClose =
        <div className="eight29-sidebar-close-wrapper">
        <h3 className="eight29-sidebar-close-title">Filters</h3>
        <button
            className="eight29-sidebar-close"
            onClick={(e) => { toggleModal(e) }}
        >
            <CloseIcon></CloseIcon>
        </button>
        </div>

        modalOpen =
            <button
                className="eight29-sidebar-open c-btn c-btn-secondary c-btn-color-normal"
                onClick={(e) => { toggleModal(e) }}
            >
                <span>Filter</span>
                <span className="c-btn-icon"><i className="icon-filter"></i></span>
            </button>


        applyFilters =
            <button
                className="apply-filters c-btn c-btn-primary c-btn-color-normal"
                onClick={(e) => { toggleModal(e) }}
            >Apply Filters</button>
    }

    if (displayReset) {
        reset = <div className="eight29-reset-wrapper">
            <button className="eight29-reset" onClick={(e) => { resetCat(e) }}>
                <span>Clear All</span>
            </button>
        </div>
    }

    if (displaySearch && layout === 'default') {
        searchComponent = <FilterSearch
            filterReset={filterReset}
            currentSearchTerm={currentSearchTerm}
            postType={postType}

            searchFieldChange={searchFieldChange}
            setFilterReset={setFilterReset}
            setCurrentPage={setCurrentPage}
            setChangedFilter={setChangedFilter}
        ></FilterSearch>
    }

    if (displaySort && layout === 'default') {
        sortComponent = <FilterOrderBy
            order={order}
            orderChange={orderChange}
        ></FilterOrderBy>
    }

    if (autoLoadFilters) {
        contentLeft = <div className="eight29-filter-list left-content">

            {postType === 'program' ? searchComponent : ''}
            {filterList}
            {moreFiltersButton}
        </div>
    } else {
        contentLeft = <div className="eight29-filter-list left-content">
            {postType==='program' ? searchComponent : ''}
            {sidebarLeft}
            {moreFiltersButton}
        </div>
    }

    if (sidebarRight && layout !== 'default') {
        contentRight = <div className="eight29-filter-list right-content">
            {sidebarRight}
        </div>
    }

    if ((layout === 'default' && reset) || layout === 'blog') {
        sidebarReset = <div className="eight29-sidebar-reset">
            {reset}
        </div>
    }
    if (displayResults) {

        const post_count   = (results - (postsPerPage * (currentPage - 1))) > postsPerPage ? postsPerPage : results - (postsPerPage * (currentPage - 1));
        const current_page = results > postsPerPage ? ( currentPage ? currentPage : 1 ) : 0;
        const first_val    = ( ( current_page - 1 ) * postsPerPage ) + 1;
        const f_val = results > 0 ? 1 : 0;
        const last_val     = parseInt(first_val) + parseInt(post_count - 1);
        const result_count = (current_page > 0 && results > 0) ? first_val + ' - ' + last_val : f_val + ' - ' + results + '';
        const result_string = `Showing ${result_count} of ${results} available programs`;
        totalResults =
            <span className="eight29-results">{result_string}</span>
    }
    if (layout === 'default' && totalResults) {
        sidebarDetail = <div className="eight29-sidebar-detail">
            {totalResults}
            {sortComponent}
        </div>
    }

    if (layout === 'default') {
        sidebarBottom = <div className="eight29-sidebar-bottom">
            <div className="container">
                {sidebarDetail}
            </div>
        </div>
    }

    const content = <div className="eight29-filter-group">
        {postType ==='post' ? searchComponent : null}
        {contentLeft}
        {contentRight}
    </div>

    return (
        <form className={`eight29-sidebar ${className}`}>
            <div className="eight29-sidebar-top">
                <div className="container">
                    <div className="eight29-sidebar-content">
                        {modalClose}
                        <div className="eight29-sidebar-content-scroll">
                            {content}
                            {sidebarReset}
                            {applyFilters}
                        </div>
                        {modalOpen}
                    </div>
                </div>
            </div>
            {sidebarBottom}
        </form>
    );
}

export default sidebar;