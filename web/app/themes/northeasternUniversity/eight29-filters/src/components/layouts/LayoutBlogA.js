import React, { useEffect, useState } from 'react';
import Sidebar from '../Sidebar';
import Posts from '../Posts';
import FilterButtonGroup from '../filters/FilterButtonGroup';

function LayoutBlogA(props) {
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

  let sidebarLeft, sidebarRight;

  if (!isEmpty(filters)) {
    sidebarLeft = <FilterButtonGroup
      taxonomy={filters.category.terms}
      taxSlug={'category'}
      selected={selected}

      resetSelected={resetSelected}
      toggleSelected={toggleSelected}
      replaceSelected={replaceSelected}
      isSelected={isSelected}
    ></FilterButtonGroup>
  }

  return (
    <div className="app-layout blog-a sidebar-top">
      <Sidebar
        results={results}
        filters={filters}
        currentSearchTerm={currentSearchTerm}
        selected={selected}
        mobileStyle={mobileStyle}
        order={order}
        sidebarLeft={sidebarLeft}
        sidebarRight={sidebarRight}
        displayPostCounts={displayPostCounts}
        
        orderChange={orderChange}
        toggleSelected={toggleSelected}
        replaceSelected={replaceSelected}
        addToSelected={addToSelected}
        removeFromSelected={removeFromSelected}
        isSelected={isSelected}
        resetSelected={resetSelected}
        setCurrentPage={setCurrentPage}
        searchFieldChange={searchFieldChange}
      >
      </Sidebar>
    
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

export default LayoutBlogA;