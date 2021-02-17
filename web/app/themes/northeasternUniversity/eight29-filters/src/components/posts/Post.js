import React from 'react';
import FeaturedImage from '../FeaturedImage';

function post(props) {
    const {
        post,
        postType,
        displayAuthor,
        displayExcerpt,
        displayDate,
        displayCategories,
        acfData,
        replaceSelected,
        theExcerpt
    } = props;

    let categories;
    let categoryItems;
    let featuredImage;
    let author;
    let excerpt;
    let date;
    let type;


    //featured-image

    featuredImage = <figure className="blog-post__card-thumbnail" dangerouslySetInnerHTML={{ __html: acfData.acf_post_card_image }}></figure>;

    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:featuredmedia') && !post._embedded['wp:featuredmedia'][0].data) {
        featuredImage =
          <figure className="blog-post__card-thumbnail">
            <FeaturedImage
              imageSize={'thumbnail-card'}
              image={post._embedded['wp:featuredmedia']}
              srcset={post.featured_image_srcset}
            ></FeaturedImage>
          </figure>
    }

    // if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term')) {
    //     categories = post._embedded['wp:term'][0];
    // }

     //content-type
    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term') && post.post_content_type) {
        categories = post._embedded['wp:term'];
        categories.forEach((el,index) =>{
            if(el[0] && el[0].id === post.post_content_type[0]){
                type = el;
            }
        });
        type = <div className="blog-post__card-cat">
            <a className="blog-post__card-cat-link" href={type[0].link} dangerouslySetInnerHTML={{__html: type[0].name}} />
        </div>
    }

    if (post.author && displayAuthor) {
        author = <div className="blog-post__card-author">
            <a href={post._embedded['author'][0]['link']} className="block-post__card__author-link" dangerouslySetInnerHTML={{__html: "By " + post.author}} />

        </div>
    }

    if (post.excerpt && displayExcerpt) {
        excerpt = <div className="eight29-post-excerpt" dangerouslySetInnerHTML={{ __html: theExcerpt(post.excerpt.rendered) }}>
        </div>
    }

    if (displayDate) {
        date = <time>{post.formatted_date}</time>
    }

    return (
        <article id={`${postType}-${post.id}`} className="blog-post__card" >
            <a className="blog-post__card-link" href={post.link} aria-label="Post Link"></a>
            <div className="blog-post__card-wrapper">
                {featuredImage}
                <div className="blog-post__card-content">
                    {type}
                    <h3 className="blog-post__card-title" dangerouslySetInnerHTML={{ __html: post.title.rendered }} />
                    {author}
                </div>
            </div>
        </article>
    );
}

export default post;