import React, { useState, useEffect } from 'react';
import FilterContainer from './FilterContainer';
import DropdownContainer from './DropdownContainer';

function FilterAccordionMultiSelect(props) {
  const {
    taxonomy,
    taxSlug,
    selected,
    displayPostCounts,
    label,
    collapsible,
    scrollable,
    dropdown,

    toggleSelected,
    isSelected
  } = props;

  const [closeRequest, setCloseRequest] = useState(false);
  const allTerms = [];
  let parentContent;
  let childContent;
  let filterContent;

  function clickHandler(e, object) {
    e.preventDefault();
    toggleSelected(object, taxSlug);
  }

  function activeButtonClass(id) {
    let classString = '';

    if(isSelected(id, taxSlug)) {
      classString = 'active';
    }

    return classString;
  }

  if (taxonomy) {
    taxonomy.forEach(term => {
      if (displayPostCounts) {
        parentContent = `${term.name} (${term.count})`;
      }
      else {
        parentContent = term.name;
      }

      allTerms.push(
        <li key={term.id}>
          <button 
            id={`${taxSlug}-${term.id}`}
            onClick={(e) => {clickHandler(e, term)}}
            className={activeButtonClass(term.id)}
          >
            {parentContent}
          </button>
        </li>
      )

      if (term.children) {
        term.children.forEach(child => {
          if (displayPostCounts) {
            childContent = `${child.name} (${child.count})`;
          }
          else {
            childContent = child.name;
          }

          allTerms.push(
            <li key={child.id}>
              <button 
                id={`${taxSlug}-${child.id}`}
                onClick={(e) => {clickHandler(e, child)}}
                className={activeButtonClass(child.id)}
              >
              {childContent}
              </button>
            </li>
          )
        });
      }
    });
  }

  if (dropdown) {
    filterContent = <DropdownContainer
    selected={selected}
    taxSlug={taxSlug} 
    taxonomy={taxonomy}
    closeRequest={closeRequest}
    setCloseRequest={setCloseRequest}
    defaultLabel={label}>
      <ul className="dropdown-list">
        {allTerms}
      </ul>
    </DropdownContainer>
  }
  else {
    filterContent = <ul>
      {allTerms}
    </ul>
  }

  return (
    <FilterContainer 
    className="filter-accordion-multi-select"
    label={label}
    selected={selected}
    taxSlug={taxSlug}
    collapsible={collapsible}
    scrollable={scrollable}
    >
      {filterContent}
    </FilterContainer>
  )
}

export default FilterAccordionMultiSelect;