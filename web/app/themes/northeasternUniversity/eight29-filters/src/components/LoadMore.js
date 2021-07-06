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
    <div className="load-more-btn c-btn-wrapper text-center align-center">
      <button
        onClick={() => {clickHandler()}}
        disabled={currentPage >= maxPages}
        className="c-btn c-btn-secondary c-btn-color-normal"
      >Load More</button>
    </div>
  )
}

export default LoadMore;