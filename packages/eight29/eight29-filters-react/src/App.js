import React, { useEffect, useState } from 'react';
import LayoutDefault from './components/layouts/LayoutDefault';
import LayoutBlogA from './components/layouts/LayoutBlogA';
import LayoutBlogB from './components/layouts/LayoutBlogB';
import LayoutBlogC from './components/layouts/LayoutBlogC';
import LayoutBlogD from './components/layouts/LayoutBlogD';
import LayoutStaff from './components/layouts/LayoutStaff';

function App(props) {
  //Props
  const {
    layout,
    rememberFilters,
    postType,
    postsPerRow,
    postsPerPage,
    taxonomy,
    termId,
    preSelect,
    excludePosts,
    taxRelation,
    mobileStyle,
    orderBy,
    paginationStyle,
    displaySidebar,
    displayPostCounts,
    displaySelected,
    displayExcerpt,
    displayAuthor,
    displayDate,
    displayCategories,
    displayReset,
    displayResults,
    displaySearch,
    displaySort,
    hideUncategorized
  } = props;

  const currentPagePath = window.location.href;
  const userData = JSON.parse((localStorage.getItem('selected')));

  //State
  const [filters, setFilters] = useState({});
  const [selected, setSelected] = useState(getInitialSelected());
  const [currentFilter, setCurrentFilter] = useState({});
  const [posts, setPosts] = useState([]);
  const [currentSearchTerm, setCurrentSearchTerm] = useState('');
  const [order, setOrder] = useState(getInitialOrder());
  const [currentPage, setCurrentPage] = useState(1);
  const [maxPages, setMaxPages] = useState(1);
  const [results, setResults] = useState(0);
  const [loading, setLoading] = useState(true);
  const [postTypes, setPostTypes] = useState([]);
  const [changedFilter, setChangedFilter] = useState(false);
  const [filterReset, setFilterReset] = useState(false);

  const layouts = {
    'default': LayoutDefault,
    'blog_A': LayoutBlogA,
    'blog_B': LayoutBlogB,
    'blog_C': LayoutBlogC,
    'blog_D': LayoutBlogD,
    'staff': LayoutStaff
  }

  const CurrentLayout = layouts[layout];

  //Computed
  const postTypeParamter = function() {
    const postString = postType === 'post' ? 'posts' : postType;
    return postString;
  }

  const categoryParamter = function() {
    let categoryString = '';

    for (const taxSlug in selected) {
      if ((selected[taxSlug].length !== 0 && selected[taxSlug][0] !== null)) {
        if (taxSlug === 'category') {
          categoryString += `categories=${selected[taxSlug]}&`;
        }
        else if (taxSlug === 'post_tag') {
          categoryString += `tags=${selected[taxSlug]}&`;
        }
        else if (taxSlug === 'author') {
          categoryString += `author=${selected[taxSlug]}&`;
        }
        else if (taxSlug === 'date') {
          categoryString += `after=${getDateParamter(selected[taxSlug], 'after')}&before=${getDateParamter(selected[taxSlug], 'before')}&`;
        }

        if (filters[taxSlug] && filters[taxSlug].hasOwnProperty('meta_query')) {
          let valueString = '';
          
          selected[taxSlug].forEach(id => {
            if (id !== null && id !== undefined) {
              valueString += `${filters[taxSlug].terms[id].name},`;
            }
          });

          categoryString += `meta_key_${taxSlug}=${taxSlug}&meta_value_${taxSlug}=${valueString}&`;
        }
        else {
          categoryString += `${taxSlug}=${selected[taxSlug]}&`;
        }
      };
    }

    return categoryString;
  }

  const searchParamter = function() {
    if(currentSearchTerm.length !== 0) {
      return `search=${currentSearchTerm}&`;
    }
    else {
      return '';
    }
  }

  const orderParamter = function() {
    let orderString;

    if (order === 'date') {
      orderString = `&order=desc&orderby=date`;
    }
    else if (order === 'abc') {
      orderString = `&order=asc&orderby=title`;
    }
    else if (order === 'xyz') {
      orderString = `&order=desc&orderby=title`;
    }
    else {
      orderString = '';
    }
    return orderString;
  }

  const postsPerRowParamter = function() {
    let postsPerRowString;

    if (postsPerRow) {
      postsPerRowString = {'--posts-per-row': postsPerRow};
    }

    return postsPerRowString;
  }

  const taxRelationParamter = function() {
    const taxRelationString = `&tax_relation=${taxRelation}`;
    return taxRelationString;
  }

  const excludeParamter = function() {
    let excludeString = '';
    if (excludePosts) {
      excludeString = `&exclude=${excludePosts}`;
    }

    return excludeString;
  }

  const sidebarClassName = function() {
    let sidebarClassString;
    let sidebarClass = 'sidebar';

    if (displaySidebar === 'false') {
      sidebarClassString = `${sidebarClass}-disabled`;
    }

    else if (displaySidebar === 'top') {
      sidebarClassString = `${sidebarClass}-top`;
    }

    else if (displaySidebar === 'bottom') {
      sidebarClassString = `${sidebarClass}-bottom`;
    }

    else if (displaySidebar === 'left') {
      sidebarClassString = `${sidebarClass}-left`;
    }

    else if (displaySidebar === 'right') {
      sidebarClassString = `${sidebarClass}-right`;
    }

    else {
      sidebarClassString = `${sidebarClass}-top`;
    }

    return sidebarClassString;
  }

  const mobileClassName = function() {
    let className = '';

    if (mobileStyle === 'scroll') {
      className = 'mobile-scroll';
    }

    if (mobileStyle === 'modal') {
      className = 'mobile-modal';
    }

    return className;
  }

  //Methods
  const loadPostTypes = async function() {
    const response = await fetch(`${wp.home_url}/wp-json/eight29/v1/post-types`);
    const data = await response.json();

    setPostTypes(data);
  }

  const loadFilters = async function() {
    const response = await fetch(`${wp.home_url}/wp-json/eight29/v1/filters/${postType}`);
    const data = await response.json();

    if (data.hasOwnProperty('category') && hideUncategorized) {
      const filteredData = data.category.terms.filter((term) => term.slug !== 'uncategorized');
      data.category.terms = filteredData;
    }

    setFilters(data);
  }

  const loadPosts = async function() {
    const requestURL = `${wp.home_url}/wp-json/wp/v2/${postTypeParamter()}?${categoryParamter()}${searchParamter()}page=${currentPage}&per_page=${postsPerPage}&_embed${orderParamter()}${excludeParamter()}${taxRelationParamter()}`;

    setLoading(true);
    console.log(requestURL);

    const response = await fetch(requestURL);
    const data = await response.json();
    
    if (paginationStyle === 'more' && posts.length !== 0) {
      const postsCopy = changedFilter ? [] : [...posts];

      data.forEach(post => {
        postsCopy.push(post);
      });

      setPosts(postsCopy);
    }
    else {
      setPosts(data);
    }

    setMaxPages(parseInt(response.headers.get('X-WP-TotalPages')));
    setResults(parseInt(response.headers.get('X-WP-Total')));
    setLoading(false);
    setChangedFilter(false);
  }

  function checkMainProps() {
    if (taxonomy && termId) {
      setSelected(selected[taxonomy] = [parseInt(termId)]);
    }
  }

  function getFilterSlugs() {
    const selectedCopy = {...selected};

    for (const taxSlug in filters) {
      if (selectedCopy[taxSlug] === undefined) {
        if (filters[taxSlug].type === 'select') {
          selectedCopy[taxSlug] = '';
        }
        else {
          selectedCopy[taxSlug] = [];
        }
      }
    }
    
    setSelected(selectedCopy);
  }

  function hasChildren(id, taxSlug) {
    const terms = filters[taxSlug].terms;
    const ids = [];

    terms.forEach(term => {
      if (term.children && term.parent === 0 && term.id === id) {
        term.children.forEach(child => {
          ids.push(child.id);
        });
      }
    })

    const result = ids.length === 0 ? false : ids;
    return result;
  }

  function getParent(id, taxSlug) {
    const terms = filters[taxSlug].terms;
    let result = 0;
    let children;

    terms.forEach(term => {
      children = hasChildren(term.id, taxSlug);
      if (children && children.includes(id)) {
        result = term.id;
      }
    });

    return result;
  }

  function getSiblings(id, taxSlug) {
    const parent = getParent(id, taxSlug);
    const siblings = hasChildren(parent, taxSlug);
    return siblings;
  }

  function toggleSelected(object, taxSlug) {
    const id = object.id;
    const children = hasChildren(object.id, taxSlug);
    const parent = getParent(object.id, taxSlug);
    const parentSelected = isSelected(parent, taxSlug);
    let values;

    //Add to selected
    if (!isSelected(id, taxSlug)) {
      if (children) {
        values = [...children, id];
        addToSelected(values, taxSlug);
      }
      else {
        addToSelected(id, taxSlug);
      }
    }

    //Remove from selected
    else {
      if (children) {
        values = [...children, id];
        removeFromSelected(values, taxSlug);
      }
      else if (parentSelected) {
        values = [parent, id];
        removeFromSelected(values, taxSlug);
      }
      else {
        removeFromSelected(id, taxSlug);
      }
    }

    setCurrentFilter({object: object, taxSlug: taxSlug});
    setCurrentPage(1);
    setChangedFilter(true);
  }

  function replaceSelected(id, taxSlug) {
    const selectedCopy = {...selected};
    selectedCopy[taxSlug] = [id];

    if(isSelected(id, taxSlug)) {
      removeFromSelected(id, taxSlug)
    }
    else {
      setSelected(selectedCopy);
    }
    
    setCurrentPage(1);
    setChangedFilter(true);
  }

  function addToSelected(id, taxSlug) {
    const selectedCopy = {...selected};
    let valuesToAdd = id;

    if(!Array.isArray(id)) {
      valuesToAdd = [id];
    }

    if(selectedCopy[taxSlug]) {
      valuesToAdd.forEach(id => {
        if (!selected[taxSlug].includes(id)) {
          selectedCopy[taxSlug] = [...selectedCopy[taxSlug], id];
          setSelected(selectedCopy);
        }
      });
    }

    setChangedFilter(true);
  }

  function removeFromSelected(id, taxSlug) {
    const selectedCopy = {...selected};
    const valuesToRemove = !Array.isArray(id) ? [id] : id;

    if (selectedCopy[taxSlug]) {
      selectedCopy[taxSlug] = selectedCopy[taxSlug].filter(termId => !valuesToRemove.includes(termId));

      setSelected(selectedCopy);
    }
  }

  function isSelected(id, taxSlug) {
    if (selected[taxSlug] && Array.isArray(selected[taxSlug]) && selected[taxSlug].includes(id)) {
      return true;
    }
    else {
      return false;
    }
  }

  function isAllChildrenSelected() {
    if (!currentFilter.object) {return};

    const id = currentFilter.object.id;
    const taxSlug = currentFilter.taxSlug;
    const parent = getParent(id, taxSlug);
    const siblings = getSiblings(id, taxSlug);
    const siblingsSelected = [];

    if (!siblings) {return};
    siblings.forEach(sibling => {
      if (isSelected(sibling, taxSlug)) {
        siblingsSelected.push(sibling);
      }
    });

    if (siblings.length === siblingsSelected.length) {
      addToSelected(parent, taxSlug);
    }
  }

  function pagePrev() {
    if (!(currentPage <= 1)) {
      setCurrentPage(currentPage - 1);
    }
  }

  function pageNext() {
    if (!(currentPage >= maxPages)) {
      setCurrentPage(currentPage + 1);
    }
  }

  function scrollUp() {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: 'smooth'
    });
  }

  function searchFieldChange(value) {
    setCurrentSearchTerm(value);
  }

  function orderChange(value) {
    setOrder(value);
  }

  function clearSearchTerm() {
    searchFieldChange('');
  }

  function resetSelected() {
    let selectedCopy = {...selected};

    for (const taxonomy in selectedCopy) {
      selectedCopy[taxonomy] = [];
    }

    //If preset reset to preset values
    if (taxonomy && termId) {
      selectedCopy[taxonomy] = [parseInt(termId)];
    }

    if (preSelect) {
      selectedCopy = preSelect;
    }

    setSelected(selectedCopy);
    setCurrentPage(1);
    clearSearchTerm();
    setOrder('date');
    setFilterReset(true);
    setChangedFilter(true);
  }

  function setLocalStorage() {
    const selectedCopy = userData && userData !== null ? userData : {};

    if (rememberFilters) {
      selectedCopy[currentPagePath] = selected;
      selectedCopy[currentPagePath].order = order;
      localStorage.setItem('selected', JSON.stringify(selectedCopy));
    }
  }

  function getInitialSelected() {
    let initialSelected;
  
    if (rememberFilters && userData !== null && userData[currentPagePath]) {
      initialSelected = {...userData[currentPagePath]};
    }
    else if (preSelect) {
      initialSelected = preSelect;
    }
    else {
      initialSelected = {};
    }

    return initialSelected;
  }

  function getInitialOrder() {
    let initialOrder;

    if (orderBy) {
      initialOrder = orderBy;
    }
    else if (rememberFilters && userData !== null && userData[currentPagePath] && userData[currentPagePath].hasOwnProperty('order')) {
      initialOrder = userData[currentPagePath].order;
    }
    else {
      initialOrder = 'date';
    }

    return initialOrder;
  }

  function isEmpty(obj) {
    return Object.keys(obj).length === 0;
  }

  function getDateParamter(id, param) {
    id = parseInt(id);
    let string = '';

    if (!isEmpty(filters)) {
      const months = filters.date.terms;

      months.forEach(month => {
        if (id === month.id) {
          string = month[param];
        }
      });
    }

    return string;
  }

  //Mounted (on ready)
  useEffect(() => {
    loadFilters();
    checkMainProps();
    loadPostTypes();
  }, []);

  //Run only after specified state changes
  useEffect(() => {
    getFilterSlugs();
  }, [filters]);

  useEffect(() => {
    loadPosts();
  }, [
    filters,
    selected,
    currentPage, 
    currentSearchTerm,
    order
  ]);

  useEffect(() => {
    setLocalStorage();
  }, [
    selected,
    order
  ]);

  useEffect(() => {
    isAllChildrenSelected();
  }, [selected]);

  //Template

  return (
    <div className={`eight29-app ${mobileClassName()}`}>
      <CurrentLayout
        layout={layout}
        results={results}
        filters={filters}
        currentSearchTerm={currentSearchTerm}
        selected={selected}
        mobileStyle={mobileStyle}
        order={order}
        posts={posts}
        postsPerRow={postsPerRowParamter()}
        currentPage={currentPage}
        maxPages={maxPages}
        loading={loading}
        order={order}
        postType={postType}
        postTypes={postTypes}
        filterReset={filterReset}
        paginationStyle={paginationStyle}
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

        pageNext={pageNext}
        pagePrev={pagePrev}
        setCurrentPage={setCurrentPage}
        orderChange={orderChange}
        toggleSelected={toggleSelected}
        replaceSelected={replaceSelected}
        addToSelected={addToSelected}
        removeFromSelected={removeFromSelected}
        isSelected={isSelected}
        resetSelected={resetSelected}
        searchFieldChange={searchFieldChange}
        scrollUp={scrollUp}
        isEmpty={isEmpty}
        sidebarClassName={sidebarClassName}
        setChangedFilter={setChangedFilter}
        setFilterReset={setFilterReset}
      ></CurrentLayout>
    </div>
  );
}

export default App;