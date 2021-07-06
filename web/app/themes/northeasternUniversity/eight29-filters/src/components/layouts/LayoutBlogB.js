import React, { useEffect, useState } from 'react';
import Sidebar from '../Sidebar';
import Posts from '../Posts';
import FilterSearch from '../filters/FilterSearch';
import FilterSelect from '../filters/FilterSelect';

function LayoutBlogB(props) {
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
    sidebarLeft = <FilterSelect
      taxonomy={filters.category.terms}
      taxSlug={'category'}
      selected={selected}

      resetSelected={resetSelected}
      toggleSelected={toggleSelected}
      replaceSelected={replaceSelected}
      addToSelected={addToSelected}
      removeFromSelected={removeFromSelected}
      isSelected={isSelected}
    ></FilterSelect>
  }

  sidebarRight = <FilterSearch
    currentSearchTerm={currentSearchTerm}
    setCurrentPage={setCurrentPage}
    searchFieldChange={searchFieldChange}
  ></FilterSearch>

  return (
    <div className="app-layout blog-b sidebar-top">
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

export default LayoutBlogB;