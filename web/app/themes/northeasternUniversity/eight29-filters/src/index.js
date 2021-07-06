import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import 'regenerator-runtime/runtime';

document.querySelectorAll('.eight29-filters').forEach(app => {
  //Props & Default values
  const layout = app.getAttribute('data-layout') ? app.getAttribute('data-layout') : 'default';
  const rememberFilters = app.getAttribute('data-remember-filters') && app.getAttribute('data-remember-filters') === 'true' ? true : false;
  const postType = app.getAttribute('data-post-type') ? app.getAttribute('data-post-type') : 'post';
  const postsPerRow = app.getAttribute('data-posts-per-row') ? app.getAttribute('data-posts-per-row') : 3;
  const postsPerPage = app.getAttribute('data-posts-per-page') ? app.getAttribute('data-posts-per-page') : 10;
  const taxonomy = app.getAttribute('data-taxonomy') ? app.getAttribute('data-taxonomy') : false;
  const termId = app.getAttribute('data-term-id') ? app.getAttribute('data-term-id') : false;
  const excludePosts = app.getAttribute('data-exclude-posts') ? app.getAttribute('data-exclude-posts') : false;
  const taxRelation = app.getAttribute('data-tax-relation') === 'OR' ? 'OR' : 'AND';
  const mobileStyle = app.getAttribute('data-mobile-style') ? app.getAttribute('data-mobile-style') : false;
  const orderBy = app.getAttribute('data-order-by') ? app.getAttribute('data-order-by') : false;
  const paginationStyle = app.getAttribute('data-pagination-style') ? app.getAttribute('data-pagination-style') : 'pagination';
  const preSelect = document.querySelector('.posts-list') && document.querySelector('.posts-list').getAttribute('data-pre-select') && !taxonomy && !termId ? document.querySelector('.posts-list').getAttribute('data-pre-select') : false;
  const displaySidebar = app.getAttribute('data-display-sidebar') ? app.getAttribute('data-display-sidebar') : 'top';
  const displayPostCounts = app.getAttribute('data-display-post-counts') === 'true' ? true : false;
  const displaySelected = app.getAttribute('data-display-selected') === 'true' ? true : false;
  const displayExcerpt = app.getAttribute('data-display-excerpt') === 'true' ? true : false;
  const displayAuthor = app.getAttribute('data-display-author') === 'false' ? false : true;
  const displayDate = app.getAttribute('data-display-date') === 'true' ? true : false;
  const displayCategories = app.getAttribute('data-display-categories') === 'false' ? false : true;
  const displayResults = app.getAttribute('data-display-results') === 'true' ? true : false;
  const displayReset = app.getAttribute('data-display-reset') === 'true' ? true : false;
  const displaySearch = app.getAttribute('data-display-search') === 'true' ? true : false;
  const displaySort = app.getAttribute('data-display-sort') === 'true' ? true : false;
  const displayNewsletter = (document.querySelector('.posts-list') && document.querySelector('.posts-list').getAttribute('data-display-newsletter') === 'true') ? true : false;
  const newsletterPostRow = (document.querySelector('.posts-list') && document.querySelector('.posts-list').getAttribute('data-newsletter-post-row')) ? document.querySelector('.posts-list').getAttribute('data-newsletter-post-row') : 4;
  const searchTerm = (document.querySelector('.page-content--search') && document.querySelector('.page-content--search').getAttribute('data-search-term')) ? document.querySelector('.page-content--search').getAttribute('data-search-term') : '';

  ReactDOM.render(<App
    layout={layout}
    rememberFilters={rememberFilters}
    postType={postType}
    postsPerRow={postsPerRow}
    postsPerPage={postsPerPage}
    taxonomy={taxonomy}
    termId={termId}
    preSelect={JSON.parse(preSelect)}
    excludePosts={excludePosts}
    taxRelation={taxRelation}
    mobileStyle={mobileStyle}
    orderBy={orderBy}
    newsletterPostRow={newsletterPostRow}
    paginationStyle={paginationStyle}
    displayNewsletter={displayNewsletter}
    displaySidebar={displaySidebar}
    displayPostCounts={displayPostCounts}
    displaySelected={displaySelected}
    displayExcerpt={displayExcerpt}
    displayAuthor={displayAuthor}
    displayDate={displayDate}
    displayCategories={displayCategories}
    displayResults={displayResults}
    displayReset={displayReset}
    displaySearch={displaySearch}
    displaySort={displaySort}
    searchTerm={searchTerm}
  />, app);
});