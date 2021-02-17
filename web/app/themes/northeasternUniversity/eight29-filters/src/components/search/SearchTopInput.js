import React, { useState, useEffect } from 'react';
// import IconSearch from '../assets/images/icons/IconSearch.svgr';
// import ClearSearch from '../assets/images/icons/ClearSearch.svgr';

function SearchTopInput(props) {
    const {
        currentSearchTerm,
        results,

        searchFieldChange,
    } = props;
    const [term, setTerm] = useState(currentSearchTerm);
    const [statusFilter, setStatusFilter] = useState('');
    let classSearch = 'search-filter';

    function changeHandler(e) {
        setTerm(e.target.value);
    }

    function clearSearchInput(e) {
        if (e) {
            e.preventDefault();
        }
        setTerm('');
    }

    if( term ) {
        classSearch += ' filled';
    }

    function focusInput(e) {
        setStatusFilter( 'typing' );
    }

    function keyHandler(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchFieldChange(term);
        }
    }

    function submitForm(e){
        e.preventDefault();
        searchFieldChange(term);
        setStatusFilter('');
        let newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?s=${term}`;
        window.history.replaceState(null, null, newUrl);
    }

    return (
        <div className={`${classSearch} ${statusFilter}`}>
            <form className="search-form" onSubmit={submitForm}>
                <label>Search</label>
                <input
                    type="search"
                    className="search-form__input"
                    value={term}
                    onKeyUp={e => { keyHandler(e); }}
                    onChange={e => changeHandler(e)}
                    onFocus={e => focusInput(e)}
                    placeholder = "Search"
                />
                <button
                    className="search-form__submit search-button"
                    type="submit"
                    aria-label="Search Form Submit"
                    value="Search"
                    type="submit"
                >
                    <i className="icon-search"></i>
                </button>
                <button
                    className="search-form__close clear-input"
                    onClick={e => clearSearchInput(e) }
                >
                    <i className="icon-close"></i>
                </button>
            </form>
        </div>
    );
}

export default SearchTopInput;
