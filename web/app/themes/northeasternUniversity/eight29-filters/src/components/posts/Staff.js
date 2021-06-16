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
                <a href={post.link}>
                    <FeaturedImage
                        imageSize={'staff-card'}
                        image={post._embedded['wp:featuredmedia']}
                        srcset={post.featured_image_srcset}
                    ></FeaturedImage>
                </a>
            </figure>
    }


    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term')) {
        categories = post._embedded['wp:term'][0];
    }

    if (categories) {
        categoryItems = categories.map((category, index) => {
        const seperator = index === categories.length - 1 ? '' : ', ';

            return (
                <>
                <a
                    href={category.link}
                    className="staff-card__category"
                    key={index}
                    data-cat={category.id}
                >{category.name}</a>
                {seperator}
                </>
            );
        });

        theCategory = categoryItems[0];
    }

    if (post.acf_single_staff_position) {
        position = <p className="staff-card__position" dangerouslySetInnerHTML={{ __html: post.acf_single_staff_position }} />
    }

    return (
        <article id={`${postType}-${post.id}`} className="staff-card">
            {featuredImage}

            <div className="staff-card__content">
                <div className="staff-card__category">
                    {categoryItems}
                </div>
                
                <span className="staff-card__title">
                    <a className="staff-link" href={post.link} dangerouslySetInnerHTML={{ __html: post.title.rendered }}></a>
                </span>
                
                {position}
            </div>
        </article>
    );
}

export default staff;