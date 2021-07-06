import React from 'react';
import Post from './posts/Post';
import Staff from './posts/Staff';
import Pagination from './Pagination';
import LoadMore from './LoadMore';

function Posts(props) {
  const {
    posts,
    postsPerRow,
    postType,
    postTypes, 
    currentPage, 
    maxPages, 
    loading,
    paginationStyle,
    displayAuthor,
    displayExcerpt,
    displayDate,
    displayCategories,

    pageNext,
    pagePrev,
    setCurrentPage,
    resetSelected,
    replaceSelected,
    orderChange,
    scrollUp
  } = props;

  //Post Type Components - Add post types and component names to this object
  const components = {
    'post': Post,
    'post_b': Post,
    'post_c': Post,
    'post_d': Post,
    'staff': Staff   
  };

  //By default each post type uses the Post component
  if (postTypes && postType) {
    if (components[postType] === undefined) {
      components[postType] = Post;
    }
  }

  const ThePost = components[postType];
  let postItems;

  if (posts) {
    postItems = posts.map((post, index) => {

      function theExcerpt(content, text = 'Read More') {
        content = content.replace('[&hellip;]', `...`);
        content = `${content} <a href=${post.link}>${text}</a>`;
        return content;
      }

      return (
        <ThePost 
          key={index}
          post={post}
          postType={postType}
          displayAuthor={displayAuthor}
          displayExcerpt={displayExcerpt}
          displayDate={displayDate}
          displayCategories={displayCategories}

          replaceSelected={replaceSelected}
          theExcerpt={theExcerpt}
        ></ThePost>
      )
    });
  }

  const loadingClass = loading ? 'loading-active' : '';
  
  let postsContent;
  let paginationContent;

  if (paginationStyle === 'more') {
    paginationContent = <LoadMore
    currentPage={currentPage}
    maxPages={maxPages}

    pageNext={pageNext}
    pagePrev={pagePrev}
    setCurrentPage={setCurrentPage}
    scrollUp={scrollUp}
    ></LoadMore>
  }

  else if (paginationStyle === 'pagination') {
    paginationContent = <Pagination
    currentPage={currentPage}
    maxPages={maxPages}

    pageNext={pageNext}
    pagePrev={pagePrev}
    setCurrentPage={setCurrentPage}
    scrollUp={scrollUp}
  ></Pagination>
  }

  if (posts && posts.length > 0) {
    postsContent = <div>
      <div className={`eight29-posts ${loadingClass}`} style={postsPerRow}>
        {postItems}
      </div>

      {paginationContent}
    </div>
  }

  else {
    if (!loading) {
      postsContent = <div className="no-results">
        Sorry, no results.

        <div className="c-btn-wrapper">
          <button className="c-btn c-btn-secondary c-btn-color-normal" onClick={() => {resetSelected()}}>Clear Filters</button>
        </div> 
      </div>
    }
  }

  return (
   <section className="eight29-posts-container">
      {postsContent}
   </section>
  );
}

export default Posts;