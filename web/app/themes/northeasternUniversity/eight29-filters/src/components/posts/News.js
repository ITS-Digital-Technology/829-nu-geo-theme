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


    //featured-image

    featuredImage = <figure className="news-post-card__thumbnail" dangerouslySetInnerHTML={{ __html: acfData.acf_news_card_image }}></figure>;

    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:featuredmedia') && !post._embedded['wp:featuredmedia'][0].data) {
        featuredImage =
            <figure className="news-post-card__thumbnail">
                <FeaturedImage
                    imageSize={'thumbnail-card'}
                    image={post._embedded['wp:featuredmedia']}
                    srcset={post.featured_image_srcset}
                ></FeaturedImage>
            </figure>
    }

    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term')) {
        categories = post._embedded['wp:term'][0];
    }

    if (categories) {
        categoryItems = categories.map((category, index) => {
            return (
                <div key={category.id} className="news-post-card__cat">
                <a
                    href={category.link}
                    className="news-post-card__cat-link"
                    key={category.id}
                >{category.name}</a>
                </div>
            );
        });
    }

    if (post.author && displayAuthor) {
        author = <span className="author">By {post.author}</span>
    }

    if (post.excerpt && displayExcerpt) {
        excerpt = <div className="news-post-card__excerpt" dangerouslySetInnerHTML={{ __html: theExcerpt(post.excerpt.rendered) }}>
        </div>
    }

    if (displayDate) {
        date = <p className="news-post-card__date">{post.formatted_date}</p>
    }

    return (
        <article id={`${postType}-${post.id}`} className="news-post-card">
            <div className="news-post-card__wrapper">
                {categoryItems}

                <a href={post.link}>{featuredImage}</a>

                <div className="news-post-card__content">
                    <h3 className="news-post-card__title">
                        <a className="news-link main-post-link" href={post.link} dangerouslySetInnerHTML={{ __html: post.title.rendered }}></a>
                    </h3>

                    {excerpt}
                    {date}
                </div>
            </div>
        </article>
    );
}

export default post;