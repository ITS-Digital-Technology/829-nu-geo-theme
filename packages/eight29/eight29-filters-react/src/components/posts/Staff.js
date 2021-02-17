import React from 'react';
import FeaturedImage from '../FeaturedImage';

function staff(props) {
  const {
    post,
    postType,

    replaceSelected
  } = props;

  let categories;
  let categoryItems;
  let featuredImage;

  if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:featuredmedia')) {
    featuredImage = <a href={post.link} className="eight29-featured-image">
      <figure>
        <FeaturedImage
          imageSize={'eight29_staff'} 
          image={post._embedded['wp:featuredmedia']}
          srcset={post.featured_image_srcset}
        ></FeaturedImage>
      </figure>
    </a>
  }

  if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term')) {
    categories = post._embedded['wp:term'][0];
  }

  if (categories) {
    categoryItems = categories.map((category, index) => {
      return (
        <a 
          key={category.id}
          onClick={() => {replaceSelected(category.id, category.taxonomy)}}
        >{category.name}</a>
      );
    });
  }

  return (
    <article id={`${postType}-${post.id}`} className="eight29-post eight29-post-card eight29-post-staff">
      {featuredImage}

      <div className="eight29-post-body">
        <h4 className="eight29-post-title"><a href={post.link} dangerouslySetInnerHTML={{__html: post.title.rendered}}></a></h4>

        <div className="eight29-post-categories">
         {categoryItems}
        </div>

        <div className="eight29-post-detail">
        </div>
      </div>
    </article>
  );
}

export default staff; 