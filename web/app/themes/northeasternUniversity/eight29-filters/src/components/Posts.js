import React from 'react';
import Post from './posts/Post';
import Staff from './posts/Staff';
import Program from './posts/Program';
import News from './posts/News';
import Pagination from './Pagination';
import LoadMore from './LoadMore';
import NewsletterPost from './posts/NewsletterPost';
import NewsletterNews from './posts/NewsletterNews';

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
    displayNewsletter,
    pageNext,
    pagePrev,
    setCurrentPage,
    resetSelected,
    replaceSelected,
    orderChange,
    acfData,
    scrollUp
  } = props;

  //Post Type Components - Add post types and component names to this object
  const components = {
    'post': Post,
    'post_b': Post,
    'post_c': Post,
    'post_d': Post,
    'staff': Staff,
    'program': Program,
    'news': News
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

      function theExcerpt(content) {
        content = content.replace('[&hellip;]', `...`);
        content = `${content}`;
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
          acfData={acfData}
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
        {( displayNewsletter && postType==="post" ) && <NewsletterPost data={acfData}/>}
        {( displayNewsletter && postType==="news" ) && <NewsletterNews data={acfData}/>}
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
       <div className="container">
        {postsContent}
      </div>
   </section>
  );
}

export default Posts;