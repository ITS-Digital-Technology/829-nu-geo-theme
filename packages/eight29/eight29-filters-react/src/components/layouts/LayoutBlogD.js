import React, { useEffect, useState } from 'react';
import Posts from '../Posts';

function LayoutBlogD(props) {
  const {
    results,
    filters,
    currentSearchTerm,
    selected,
    mobileStyle,
    order,
    posts,
    postsPerRow,
    currentPage,
    maxPages,
    loading,
    postType,
    postTypes,
    paginationStyle,
    displayPostCounts,
    displaySelected,
    displaySidebar,
    displayExcerpt,
    displayAuthor,
    displayDate,
    displayCategories,
    displayReset,
    displayResults,
    displaySearch,
    displaySort,

    pageNext,
    pagePrev,
    setCurrentPage,
    orderChange,
    toggleSelected,
    replaceSelected,
    addToSelected,
    removeFromSelected,
    isSelected,
    resetSelected,
    searchFieldChange,
    scrollUp,
    isEmpty
  } = props;

  return (
    <div className="app-layout blog-d">    
      <Posts
        posts={posts}
        postsPerRow={postsPerRow}
        currentPage={currentPage}
        maxPages={maxPages}
        loading={loading}
        order={order}
        postType={postType}
        postTypes={postTypes}
        paginationStyle={paginationStyle}
        displayExcerpt={displayExcerpt}
        displayAuthor={displayAuthor}
        displayDate={displayDate}
        displayCategories={displayCategories}

        pageNext={pageNext}
        pagePrev={pagePrev}
        setCurrentPage={setCurrentPage}
        orderChange={orderChange}
        replaceSelected={replaceSelected}
        resetSelected={resetSelected}
        scrollUp={scrollUp}
      ></Posts>
    </div>
  )
}

export default LayoutBlogD;