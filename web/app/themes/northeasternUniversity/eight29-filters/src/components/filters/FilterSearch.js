import React, { useState, useEffect } from 'react';
import FilterContainer from './FilterContainer';

function FilterSearch(props) {
    const {
        filterReset,
        setFilterReset,
        currentSearchTerm,
        label,
        collapsible,
        scrollable,
        postType,

        searchFieldChange,
        setCurrentPage,
        setChangedFilter
    } = props;

    const [term, setTerm] = useState('');

    let clearSearchVisible = '';

    function changeHandler(e) {
        e.preventDefault();
        setTerm(e.target.value);
    }

    function clearSearchTerm(e) {
        if (e) {
            e.preventDefault();
        }

        setTerm('');
        searchFieldChange('');
        setCurrentPage(1);
        setChangedFilter(true);
    }

    function onReset() {
        if (filterReset) {
            clearSearchTerm();
            setFilterReset(false);
        }
    }

    function keyHandler(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchFieldChange(term);
            setCurrentPage(1);
            setChangedFilter(true);
        }
    }

    if (term && term.length > 0) {
        clearSearchVisible = 'visible';
    }

    useEffect(() => {
        onReset();
    }, [filterReset])

    let placeholder;
    placeholder = postType === 'program' ? 'Keywords...' : 'Search';
    return (
        <FilterContainer
            className="filter-search"
            label={label}
            collapsible={collapsible}
            scrollable={scrollable}
        >
            <h6 className="filter-input__label"><span>Search</span></h6>
            <div className="filter-input">
                <input type="search"
                    placeholder={placeholder}
                    value={term}
                    onChange={(e) => { changeHandler(e) }}
                    onKeyPress={(e) => { keyHandler(e) }}
                ></input>
                <button
                    className={`clear-search ${clearSearchVisible}`}
                    onClick={(e) => { clearSearchTerm(e) }}
                    tabIndex="-1"
                >
                    <span>+</span>
                </button>
            </div>
        </FilterContainer>
    );
}

export default FilterSearch;
