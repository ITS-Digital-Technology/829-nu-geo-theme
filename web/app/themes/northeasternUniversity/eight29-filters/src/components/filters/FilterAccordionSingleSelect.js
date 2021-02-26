import React, { useState, useEffect } from 'react';
import FilterContainer from './FilterContainer';
import DropdownContainer from './DropdownContainer';

function FilterAccordionSingleSelect(props) {
  const {
    taxonomy,
    taxSlug,
    selected,
    displayPostCounts,
    label,
    collapsible,
    scrollable,
    dropdown,
    postType,

    replaceSelected,
    isSelected
  } = props;

  const [closeRequest, setCloseRequest] = useState(false);
  const allTerms = [];
  const allTermsID = `${taxSlug}-all`;
  let parentContent;
  let childContent;
  let filterContent;
  let filterId = '';

  function clickHandler(e, object) {
    e.preventDefault();
    replaceSelected(object.id, taxSlug);
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
            onClick={(e) => {clickHandler(e, term), setCloseRequest(true)}}
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
                onClick={(e) => {clickHandler(e, child), setCloseRequest(true)}}
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

  if(postType === 'post' || postType === 'staff'){
    allTerms.unshift(
        <li key="all">
            <button
                type="button"
                id={allTermsID}
                onClick={(e) => {
                    e.preventDefault();
                    replaceSelected(allTermsID, taxSlug);
                    setCloseRequest(true);
                }}
                className={activeButtonClass(allTermsID)}
            >
                All {label}
            </button>
        </li>
        );
    }

  if (dropdown) {
    filterContent = <DropdownContainer
      selected={selected}
      taxSlug={taxSlug}
      taxonomy={taxonomy}
      postType={postType}
      closeRequest={closeRequest}
      setCloseRequest={setCloseRequest}
      defaultLabel={label}
      >
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

  if (taxSlug) {
    filterId = `filter-${taxSlug}`;
  }

  return (
    <FilterContainer
    filterId={filterId}
    className="filter-accordion-single-select"
    label={label}
    postType={postType}
    collapsible={collapsible}
    scrollable={scrollable}
    >
      {filterContent}
    </FilterContainer>
  )
}

export default FilterAccordionSingleSelect;