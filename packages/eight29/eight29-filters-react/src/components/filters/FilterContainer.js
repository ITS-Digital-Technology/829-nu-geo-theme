import React, {useState, useEffect} from 'react';
import SimpleBar from 'simplebar-react';

function FilterContainer(props) {
  const {
    className,
    label,
    selected,
    taxSlug,
    scrollable,
    collapsible,
  } = props;

  const collapseClass = collapsible ? 'collapsible' : '';
  const [open, setOpen] = useState(false);
  const [count, setCount] = useState(0);
  let content;
  let labelcontent;

  function countClass() {
    let classString = '';

    if (count > 0) {
      classString = 'count-visible';
    }

    return classString;
  }

  function updateCount() {
    if (selected && taxSlug && selected.hasOwnProperty(taxSlug)) {
      setCount(selected[taxSlug].length);
    }
  }

  function toggleOpen() {
    if (collapsible) {
      setOpen(!open);
    }
  }

  function toggleClass() {
    let classString = '';

    if (open) {
      classString = 'open';
    }

    return classString;
  }

  if (scrollable) {
    content = <SimpleBar>{props.children}</SimpleBar>
  }
  else {
    content = props.children;
  }

  if (label) {
    labelcontent = <h6 onClick={() => toggleOpen()} className={countClass()} data-count={count}>
      <span>{label}</span>
    </h6>
  }

   useEffect(() => {
    updateCount();
  }, [selected]);

  return(
    <div className={`eight29-filter ${className}`}>
      <div className={`accordion-select ${toggleClass()} ${collapseClass}`}>
        {labelcontent}

        <div>
          {content}
        </div>
      </div>
    </div>
  )
}

export default FilterContainer;