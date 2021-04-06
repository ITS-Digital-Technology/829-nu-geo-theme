import React from 'react';
import FeaturedImage from '../FeaturedImage';

function staff(props) {
    const {
        post,
        postType,
        acfData,
        replaceSelected
    } = props;

    let categories;
    let categoryItems;
    let featuredImage;
    let position;
    let theCategory = '';


    featuredImage = <figure className="staff-card__thumbnail" dangerouslySetInnerHTML={{ __html: acfData.acf_staff_card_image }}></figure>;

    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:featuredmedia') && !post._embedded['wp:featuredmedia'][0].data) {
        featuredImage =
            <figure className="staff-card__thumbnail">
                <FeaturedImage
                    imageSize={'staff-card'}
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
                <a
                    href={category.link}
                    className="staff-card__category"
                    key={category.id}
                >{category.name}</a>
            );
        });

        theCategory = categoryItems[0];
    }

    if (post.acf_single_staff_position) {
        position = <p className="staff-card__position" dangerouslySetInnerHTML={{ __html: post.acf_single_staff_position }} />
    }

    return (
        <article id={`${postType}-${post.id}`} className="staff-card">
            <a className="staff-card__link" href={post.link} aria-label="Staff Link"></a>
            {featuredImage}
            <div className="staff-card__content">
                <div className="staff-card__category">
                    {theCategory}
                </div>
                <h4 className="staff-card__title" dangerouslySetInnerHTML={{ __html: post.title.rendered }} />
                {position}
            </div>
        </article>
    );
}

export default staff;