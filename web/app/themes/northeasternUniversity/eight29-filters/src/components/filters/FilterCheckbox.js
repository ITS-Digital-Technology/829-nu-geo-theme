import React, {useState, useRef} from 'react';
import FilterContainer from './FilterContainer';
import DropdownContainer from './DropdownContainer';

function FilterCheckbox(props) {
  const {
    taxonomy,
    selected,
    taxSlug,
    displayPostCounts,
    label,
    terraDotta,
    collapsible,
    scrollable,
    dropdown,
    classFilter,
    
    toggleSelected,
    removeFromSelected,
    addToSelected,
    isSelected
  } = props;

  const [termOpen, setTermOpen] = useState({});
  const [closeRequest, setCloseRequest] = useState(false);

  const checkboxRef = useRef({});

  let termList;
  let parentContent;
  let childrenList
  let childContent;
  let filterContent;
  let selectAll;
  let filterId = '';

  if (taxonomy) {
    termList = taxonomy.map((term, index) => {
      let children;
      let childToggle;

      if (term.children && term['children'].length > 0) {
        childrenList = term['children'].map((child, index) => {
          if (displayPostCounts) {
            childContent = <label htmlFor={child.id}>
              <span>
                {child.name}
                <span className="eight29-category-count">({child.count})</span>
              </span>
            </label>
          }
          else {
            childContent = <label htmlFor={child.id}><span>{child.name}</span></label>
          }

          return (
            <li id={`term-${child.slug}`} key={index}>
              <input
                type="checkbox"
                value={child.slug}
                id={child.id}
                checked={isSelected(child.id, taxSlug)}
                onChange={() => {toggleSelected(child, taxSlug), setCloseRequest(true)}}
                onKeyPress={(e) => {keyPressHandler(e, child.id)}}
                ref={(checkbox) => checkboxRef.current[child.id] = checkbox}
              ></input>

              {childContent}
            </li>
          );
        });

        children = <ul className="eight29-category-children">
          {childrenList}
        </ul>

        childToggle = <span
          className="child-toggle"
          onClick={() => toggleTerm(term.slug)}
        ></span>
      }

      if (term.parent === 0) {
        if (displayPostCounts) {
          parentContent = <label htmlFor={term.id}>{term.name}
            <span className="eight29-category-count">({term.count})</span>
          </label>
        }
        else {
          parentContent = <label htmlFor={term.id}>{term.name}</label>
        }

        return (
          <li id={`term-${term.slug}`} key={term.id} className={`${toggleTermClass(term.slug)}`}>
            <div>
              <input
                type="checkbox"
                value={term.slug}
                id={term.id}
                name={term.id}
                checked={isSelected(term.id, taxSlug)}
                onChange={() => {toggleSelected(term, taxSlug), setCloseRequest(true)}}
                onKeyPress={(e) => {keyPressHandler(e, term.id)}}
                ref={(checkbox) => checkboxRef.current[term.id] = checkbox}
              ></input>

              {parentContent}
              {childToggle}
            </div>

            {children}
          </li>
        );
      }
    });
  }

  function keyPressHandler(e, currentIndex) {
    if (e.key === 13 || e.key === 'Enter') {
      checkboxRef.current[currentIndex].click();
    }
  }

  function modifyAll(termIds, taxSlug, totalTerms, totalSelected) {
    //if all are selected deselect all, else select all
    if (totalTerms === totalSelected) {
      removeFromSelected(termIds, taxSlug);
    }
    else {
      addToSelected(termIds, taxSlug);
    }
  }

  function toggleTerm(slug) {
    if (termOpen){
      const objectCopy = {...termOpen};
      objectCopy[slug] = !objectCopy[slug];

      setTermOpen(objectCopy);
    }
  }

  function toggleTermClass(slug) {
    let classString = '';

    if (termOpen && termOpen[slug]) {
      classString = 'open';
    }

    return classString;
  }

  if (selected[taxSlug] && taxonomy && taxonomy.length > 0) {
    const terms = taxonomy.filter(tax => tax.parent !== null);
    const termIds = terms.map(tax => tax.id);
    const totalTerms = terms.length;
    const totalSelected = selected[taxSlug].length;

    selectAll = <li key={`select-all-${taxSlug}`} className="select-all">
      <div>
        <input
          type="checkbox"
          id={`select-all-${taxSlug}`}
          name={`select-all-${taxSlug}`}
          checked={totalTerms === totalSelected}
          onChange={() => {modifyAll(termIds, taxSlug, totalTerms, totalSelected), setCloseRequest(true)}}
          onKeyPress={(e) => {keyPressHandler(e, 'all')}}
          ref={(checkbox) => checkboxRef.current['all'] = checkbox}
        ></input>

        <label htmlFor={`select-all-${taxSlug}`}>All</label>
      </div>
    </li>;

    termList.unshift(selectAll);
  }

  if (dropdown) {
    filterContent = <DropdownContainer
        selected={selected}
        taxSlug={taxSlug}
        taxonomy={taxonomy}
        closeRequest={closeRequest}
        setCloseRequest={setCloseRequest}
        defaultLabel={label}
        label={label}
      >
      <ul className="checkboxes dropdown-list" role="option">
        {termList}
      </ul>
    </DropdownContainer>
  }

  else {
    filterContent = <ul className="checkboxes">
      {termList}
    </ul>
  }

  if (taxSlug) {
    filterId = `filter-${taxSlug}`;
  }

  const filterClass = `filter-checkbox ${classFilter}`;

  return (
    <FilterContainer
    filterId={filterId}
    className={filterClass}
    label={label}
    selected={selected}
    taxSlug={taxSlug}
    taxonomy={taxonomy}
    collapsible={collapsible}
    scrollable={scrollable}
    terraDotta={terraDotta}
    >
      {filterContent}
    </FilterContainer>
  )
}

export default FilterCheckbox;