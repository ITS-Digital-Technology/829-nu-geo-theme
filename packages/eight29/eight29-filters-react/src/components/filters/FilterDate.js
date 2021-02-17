import React, {useState, useEffect} from 'react';
import FilterContainer from './FilterContainer';
import DatePicker from 'react-datepicker';

function FilterDate(props) {
  const {
    taxonomy,
    taxSlug,
    selected,
    label,
    scrollable,
    collapsible,
    filterReset,

    replaceSelected,
    isSelected,
    setFilterReset
  } = props;
  
  const [today, setToday] = useState(new Date());
  const [startDate, setStartDate] = useState(new Date());

  function changeHandler(date) {
    let dateFound = false;
    let formattedDate = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
    formattedDate = formattedDate.replaceAll('-', '');
    setStartDate(date);

    taxonomy.forEach(term => {
      if (term.slug === formattedDate) {
        replaceSelected(term.id, taxSlug);
        dateFound = true;
      }
    });

    if (!dateFound) {
      replaceSelected(undefined, taxSlug);
    }
  }

  function resetDate() {
    if (filterReset) {
      setStartDate(today);
      setFilterReset(false);
    }
  }

  useEffect(() => {
    resetDate();
  }, [filterReset]);

  return(
    <FilterContainer 
      className="filter-date"
      label={label}
      collapsible={collapsible}
      scrollable={scrollable}
    >
      <DatePicker
        selected={startDate}
        onChange={(date) => {changeHandler(date)}}
      ></DatePicker>
    </FilterContainer>
  )
}

export default FilterDate;
