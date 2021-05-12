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
    {id: 1, value: 'abc', label: 'Sort Alphabetical(A - Z)'},
    {id: 2, value: 'xyz', label: 'Sort Alphabetical(Z - A)'}
  ]

  const [closeRequest, setCloseRequest] = useState(false);
  const [menuList, setMenuList] = useState(options);

  const items = menuList.map(item => {
    return (
      <option 
        key={item.id}
        id={`order-${item.value}`} 
        className={activeClass(item.value)} 
        value={item.value}
      >
        {item.label}
      </option>
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
    <select 
      value={order}
      className="dropdown-list eight29-orderby"
      onChange={(e) => {clickHandler(e)}}
    >
      {items}
    </select>
  )
}

export default FilterOrderBy;