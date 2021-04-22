import React, { useEffect, useState } from 'react';
import Sidebar from '../Sidebar';
import Posts from '../Posts';
import CurrentSelected from '../CurrentSelected';

function LayoutDefault(props) {
  const {
    layout,
    results,
    filters,
    currentSearchTerm,
    selected,
    mobileStyle,
    order,
    posts,
    postsPerRow,
    currentPage,
    postsPerPage,
    maxPages,
    loading,
    acfData,
    postType,
    postTypes,
    paginationStyle,
    filterReset,
    displayNewsletter,
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
    isEmpty,
    sidebarClassName,
    setChangedFilter,
    setFilterReset
  } = props;

  let sidebarLeft, sidebarRight, sidebarTop, sidebarContent;

  if (displaySelected) {
    sidebarTop = <CurrentSelected
    selected={selected}
    filters={filters}

    removeFromSelected={removeFromSelected}
    isEmpty={isEmpty}
  ></CurrentSelected>
  }

  if (displaySidebar !== 'false') {
    sidebarContent = <Sidebar
      layout={layout}
      results={results}
      filters={filters}
      currentSearchTerm={currentSearchTerm}
      selected={selected}
      mobileStyle={mobileStyle}
      order={order}
      sidebarLeft={sidebarLeft}
      sidebarRight={sidebarRight}
      autoLoadFilters={true}
      postType={postType}
      filterReset={filterReset}
      maxPages ={maxPages}
      displayPostCounts={displayPostCounts}
      displayResults={displayResults}
      displayReset={displayReset}
      displaySearch={displaySearch}
      displaySort={displaySort}
      postsPerPage={postsPerPage}
      currentPage={currentPage}
      orderChange={orderChange}
      toggleSelected={toggleSelected}
      addToSelected={addToSelected}
      removeFromSelected={removeFromSelected}
      replaceSelected={replaceSelected}
      isSelected={isSelected}
      resetSelected={resetSelected}
      searchFieldChange={searchFieldChange}
      setCurrentPage={setCurrentPage}
      setChangedFilter={setChangedFilter}
      setFilterReset={setFilterReset}
    >
    </Sidebar>
  }

  return (
    <div className={`app-layout layout-default ${sidebarClassName()}`}>
      {sidebarTop}
      {sidebarContent}

      <Posts
        posts={posts}
        postsPerRow={postsPerRow}
        currentPage={currentPage}
        maxPages={maxPages}
        loading={loading}
        order={order}
        acfData={acfData}
        postType={postType}
        postTypes={postTypes}
        displayNewsletter={displayNewsletter}
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

export default LayoutDefault;