import React from 'react';
import FeaturedImage from '../FeaturedImage';
function searchResult(props) {
    const { post, postType } = props;
    let featuredImage;
    let cat = '';
    let excerpt = '';

    if(post.excerpt.rendered){
        excerpt = post.excerpt.rendered;
    } else {
        excerpt = post.content.rendered;
    }

    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term') ) {
        if(post._embedded['wp:term'][0] ){
            if( post._embedded['wp:term'][0][0] && post._embedded['wp:term'][0][0]['name']) {
                cat = <p class="search-result-card__cat">{post._embedded['wp:term'][0][0]['name']}</p>
            }
        }
    }

    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:featuredmedia') && !post._embedded['wp:featuredmedia'][0].data) {
        featuredImage =
          <figure className="search-result-card__thumbnail">
            <FeaturedImage
              imageSize={'search-thumbnail'}
              image={post._embedded['wp:featuredmedia']}
              srcset={post.featured_image_srcset}
            ></FeaturedImage>
          </figure>
    }

    function theExcerpt(content) {
        content = content.replace('[&hellip;]', ``);
        content = content.split(' ');
        if (content.length > 25) {
            content = content.splice(0, 25).join(' ');
            content += '...';
        } else {
            content = content.join(' ');
        }
        return content;
    }

    if (excerpt) {
        excerpt = (
            <div
                className="search-result-card__excerpt"
                dangerouslySetInnerHTML={{
                    __html: theExcerpt(excerpt),
                }}
            ></div>
        );
    }

    return (
        <article className="search-result-card">
            <a className="search-result-card__link" href={post.link} data-id={post.id} />
            <div className="search-result-card__wrapper">
                <div className="search-result-card__content">
                    {cat}
                    <h5
                        className="search-result-card__title"
                        dangerouslySetInnerHTML={{ __html: post.title.rendered }}
                    />
                    {excerpt}
                </div>
                {featuredImage && featuredImage}
            </div>
        </article>
    );
}

export default searchResult;
