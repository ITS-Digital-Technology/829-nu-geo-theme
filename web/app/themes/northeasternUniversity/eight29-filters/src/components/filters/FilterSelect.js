import React, {useState} from 'react';
import FilterContainer from './FilterContainer';

function FilterSelect(props) {
  const {
    taxonomy,
    taxSlug,
    selected,
    displayPostCounts,
    label,
    collapsible,
    scrollable,
    classFilter,
    terraDotta,

    replaceSelected,
    isSelected
  } = props;

  const allTerms = [];

  let parentContent;
  let childContent;
  let filterId = '';

  function changeValue(value) {
    if (value === 'empty') {
      replaceSelected(null, taxSlug);
    }

    else {
      replaceSelected(value, taxSlug);
    }
  }

  if (taxonomy) {
    allTerms.push(
        <option 
          key={`empty-${taxSlug}`}
          value={'empty'}
          id={`empty-${taxSlug}`}
        >Select {label}
        </option>
    );

    taxonomy.forEach(term => {
      if (displayPostCounts) {
        parentContent = `${term.name} (${term.count})`;
      }
      else {
        parentContent = term.name;
      }

      allTerms.push(
        <option 
          key={term.id}
          value={`${term.id}`}
          id={`${taxSlug}-${term.id}`}
        >
        {parentContent}
        </option>
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
            <option 
              key={child.id}
              value={`${child.id}`}
              id={child.id}
            >
            {childContent}
            </option>
          )
        });
      }
    });
  }

  if (taxSlug) {
    filterId = `filter-${taxSlug}`;
  }

  const filterClass = `filter-select ${classFilter}`;

  return (
    <FilterContainer
    filterId={filterId} 
    className={filterClass}
    label={label}
    collapsible={collapsible}
    scrollable={scrollable}
    terraDotta={terraDotta}
    >
      <select
        id={`select-${filterId}`}
        multiple={false}
        value={String(selected[taxSlug])}
        onChange={(e) => {changeValue(e.target.value)}}
      >
        {allTerms}
      </select>
    </FilterContainer>
  )
}

export default FilterSelect;