import React from 'react';
import PaginationItem from './PaginationItem.js';

function pagination(props) {
  const {
    currentPage, 
    maxPages,
    pageNext,
    pagePrev,

    setCurrentPage,
    scrollUp
  } = props;

  let paginationOutput = '';
  const pageItemsDisplayed = 3; //Sets number of page items to display between the first and last page

  function clickNext() {
    scrollUp();
    pageNext();
  }

  function clickPrev() {
    scrollUp();
    pagePrev();
  }

  const pageItems = function(amount) {
    amount = amount > maxPages ? maxPages : amount;

    const middle = Math.round(amount/2);
    const list = [];
    const firstPages = currentPage > 0 && currentPage < amount;
    const lastPages = currentPage <= maxPages && currentPage > maxPages - (amount - 1);
    let output;
    let first = '';
    let last = '';

    for(let i = 0; i < amount; i++) {
      //Beginning
      if (firstPages) {
        output = 1 + i;
      }

      //End
      else if (lastPages) {
        output = (maxPages - amount) + (1 + i);
      }

      //Middle
      else { 
        output = currentPage - (middle - (i + 1));
      }

      if (output > 0 && output <= maxPages) {
        list.push(
          <PaginationItem key={i} 
            currentPage={currentPage} 
            pageNumber={output}

            setCurrentPage={setCurrentPage} 
            scrollUp={scrollUp}
          ></PaginationItem>
        );
      }
    }

    if(!firstPages && maxPages > list.length) {
      first = <PaginationItem 
        currentPage={currentPage} 
        setCurrentPage={setCurrentPage} 
        pageNumber={1}
        className={'first-item'}
        scrollUp={scrollUp}
      ></PaginationItem>
    }

    if (!lastPages && maxPages > list.length) {
      last = <PaginationItem 
        currentPage={currentPage} 
        setCurrentPage={setCurrentPage} 
        pageNumber={maxPages}
        className={'last-item'}
        scrollUp={scrollUp}
      ></PaginationItem>
    }

    return (
      <ul className="eight29-pagination-list">
        {first}
        {list}
        {last}
      </ul>
    );
  };

  if (maxPages > 1) {
    paginationOutput = <ul className="eight29-pagination">
      <li className="eight29-pagination-prev">
        <button className="eight29-pagination-arrow" title="Previous Page" onClick={() => clickPrev()} disabled={currentPage <= 1}>&lt;</button>
      </li>

      {pageItems(pageItemsDisplayed)}

      <li className="eight29-pagination-next">
        <button className="eight29-pagination-arrow" title="Next Page" onClick={() => clickNext()} disabled={currentPage >= maxPages}>&gt;</button>
      </li>
    </ul>
  }

  return paginationOutput;
}

export default pagination;