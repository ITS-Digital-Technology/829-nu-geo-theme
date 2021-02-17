import React from 'react';

function PaginationItem(props) {
  const {
    pageNumber,
    currentPage,

    setCurrentPage,
    scrollUp
  } = props;

  const currentClass = currentPage === pageNumber ? 'current-page' : '';
  const className = props.className !== undefined ? props.className : '';
  
  function clickHandler(pageNumber) {
    setCurrentPage(pageNumber);
    scrollUp();
  }

  return (
    <li className={className}>
      <button 
        className={`pagination-item ${currentClass}`}
        onClick={() => {clickHandler(pageNumber)}}
      >{pageNumber}</button>
    </li>
  );
}

export default PaginationItem;