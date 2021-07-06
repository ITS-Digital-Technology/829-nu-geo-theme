import React from 'react';

function LoadMore(props) {
  const {
    currentPage, 
    maxPages,
    pageNext,
    pagePrev,

    setCurrentPage,
    scrollUp
  } = props;

  function clickHandler() {
    pageNext();
  }

  return (
    <div className="c-btn-wrapper text-center">
      <button 
        onClick={() => {clickHandler()}}
        disabled={currentPage >= maxPages} 
        className="c-btn c-btn-secondary c-btn-color-normal"
      >Load More</button>
    </div>
  )
}

export default LoadMore;