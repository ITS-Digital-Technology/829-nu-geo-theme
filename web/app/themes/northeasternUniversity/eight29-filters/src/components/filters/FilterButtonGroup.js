import React, {useState} from 'react';
import FilterContainer from './FilterContainer';

function FilterButtonGroup(props) {
  const {
    taxonomy,
    taxSlug,
    selected,
    displayPostCounts,
    label,
    collapsible,
    scrollable,

    resetSelected,
    replaceSelected,
    isSelected
  } = props;

  const allTerms = [];

  let termContent;
  let filterId = '';

  function resetCat(e) {
    e.preventDefault();
    resetSelected();
  }

  function changeCat(event, id) {
    event.preventDefault();
    replaceSelected(id, taxSlug);
  }

  function allClass() {
    let classString = '';

    if (selected[taxSlug] !== undefined && selected[taxSlug].length === 0) {
      classString = 'active';
    }

    return classString;
  }

  function termClass(id) {
    let classString = '';

    if (isSelected(id, taxSlug)) {
      classString = 'active';
    }

    return classString;
  }

  if (taxonomy) {
    allTerms.push(
        <button
          key={0}
          id="0"
          onClick={(e) => resetCat(e)}
          className={allClass()}
        >
        All
        </button>
    );

    taxonomy.forEach(term => {
      if (displayPostCounts) {
        termContent = `${term.name} (${term.count})`;
      }
      else {
        termContent = term.name;
      }

      allTerms.push(
        <button
          key={term.id}
          id={term.id}
          onClick={(e) => changeCat(e, term.id)}
          className={termClass(term.id)}
        >
        {termContent}
        </button>
      )
    });
  }

  if (taxSlug) {
    filterId = `filter-${taxSlug}`;
  }

  return (
    <FilterContainer
    filterId={filterId}
    className="filter-button-group"
    label={label}
    selected={selected}
    taxSlug={taxSlug}
    collapsible={collapsible}
    scrollable={scrollable}
    >
      <div className="button-wrap">
        {allTerms}
      </div>
    </FilterContainer>
  )
}

export default FilterButtonGroup;