import React, {useState, useEffect} from 'react';
import FilterContainer from './FilterContainer';
import DropdownContainer from './DropdownContainer';

function FilterOrderBy(props) {
  const {
    order,
    orderChange,
    label,
    collapsible,
    scrollable
  } = props;

  const options = [
    {id: 0, value: 'date', label: 'Newest/Featured'},
    {id: 1, value: 'abc', label: 'Alphabetical(A - Z)'},
    {id: 2, value: 'xyz', label: 'Alphabetical(Z - A)'}
  ]

  const [closeRequest, setCloseRequest] = useState(false);
  const [menuList, setMenuList] = useState(options);

  const items = menuList.map(item => {
    return (
      <li
        key={item.id}
      >
        <button
          id={`order-${item.value}`}
          className={activeClass(item.value)}
          value={item.value}
          onClick={(e) => {clickHandler(e)}}
        >{item.label}</button>
      </li>
    )
  });

  function clickHandler(e) {
    e.preventDefault();
    orderChange(e.target.value);
    setCloseRequest(true);
  }

  function updateActive() {
    const itemsCopy = [...menuList];
    itemsCopy.forEach(item => {
      item.active = false;

      if (item.value === order) {
        item.active = true;
      }
    });

    setMenuList(itemsCopy);
  }

  function activeClass(value) {
    const classString = value === order ? 'active' : '';
    return classString;
  }

  useEffect(() => {
    updateActive();
  }, [order])

  return (
    <FilterContainer
      className="filter-orderby"
      label={label}
      collapsible={collapsible}
      scrollable={scrollable}
    >
      <DropdownContainer
      closeRequest={closeRequest}
      orderBy ={true}
      setCloseRequest={setCloseRequest}
      menuList={menuList}
      defaultLabel="Newest/Featured"
      >
        <ul className="dropdown-list">
          {items}
        </ul>
      </DropdownContainer>
    </FilterContainer>
  )
}

export default FilterOrderBy;