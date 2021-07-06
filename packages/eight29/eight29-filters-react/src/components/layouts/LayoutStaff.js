import React, { useEffect, useState } from 'react';
import Sidebar from '../Sidebar';
import Posts from '../Posts';
import FilterSelect from '../filters/FilterSelect';
import FilterOrderBy from '../filters/FilterOrderBy';

function LayoutStaff(props) {
  const {
    results,
    filters,
    currentSearchTerm,
    selected,
    mobileStyle,
    displayPostCounts,
    order,
    posts,
    postsPerRow,
    currentPage,
    maxPages,
    loading,
    postType,
    postTypes,
    paginationStyle,

    pageNext,
    pagePrev,
    setCurrentPage,
    orderChange,
    toggleSelected,
    replaceSelected,
    isSelected,
    resetSelected,
    searchFieldChange,
    scrollUp,
    isEmpty
  } = props;

  let sidebarLeft, sidebarRight;

  if (!isEmpty(filters)) {
    sidebarLeft = <FilterSelect
      label={filters.staff_department.label}
      taxonomy={filters.staff_department.terms}
      taxSlug={'staff_department'}
      selected={selected}

      resetSelected={resetSelected}
      toggleSelected={toggleSelected}
      replaceSelected={replaceSelected}
      isSelected={isSelected}
    ></FilterSelect>
  }

  sidebarRight = <FilterOrderBy 
    order={order}
    orderChange={orderChange}
  ></FilterOrderBy>

  return (
    <div className="app-layout layout-staff sidebar-top">
      <Sidebar
        results={results}
        filters={filters}
        currentSearchTerm={currentSearchTerm}
        selected={selected}
        mobileStyle={mobileStyle}
        displayPostCounts={displayPostCounts}
        order={order}
        sidebarLeft={sidebarLeft}
        sidebarRight={sidebarRight}
        
        orderChange={orderChange}
        toggleSelected={toggleSelected}
        replaceSelected={replaceSelected}
        isSelected={isSelected}
        resetSelected={resetSelected}
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

export default LayoutStaff;