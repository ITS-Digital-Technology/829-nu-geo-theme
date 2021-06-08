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
    let featuredImage;
    let status;
    let type;
    let title;
    let info;
    let city;
    let country;
    let terms=[];
    let app_deadline;
    let termContent;
    let postTitle;

    //title
    postTitle = post['title']['rendered'];
    postTitle = postTitle.toLowerCase();

    //feature-image
    featuredImage = <figure className="program-card__thumbnail" dangerouslySetInnerHTML={{ __html: acfData.acf_program_card_image }}></figure>;
    
    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:featuredmedia') && !post._embedded['wp:featuredmedia'][0].data) {
        featuredImage =
          <figure className="program-card__thumbnail">
            <span className="sr-only" dangerouslySetInnerHTML={{ __html: postTitle }}></span>
            <FeaturedImage
              imageSize={'thumbnail-card'}
              image={post._embedded['wp:featuredmedia']}
              srcset={post.featured_image_srcset}
            ></FeaturedImage>
          </figure>
    }

    //status
    if(post.acf_program_card_program_status && post.acf_program_card_program_status ==='open') {
        status = <span className="program-card__status status-open">Open</span>
    } else if(post.acf_program_card_program_status && post.acf_program_card_program_status ==='pending') {
        status = <span className="program-card__status status-pending">Pending</span>
    } else if(post.acf_program_card_program_status && post.acf_program_card_program_status ==='full') {
        status = <span className="program-card__status status-full">Full</span>
    }

    //type
    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term') && post.program_type) {
        categories = post._embedded['wp:term'];
        categories.forEach((el,index) =>{
            if(el[0] && el[0].id === post.program_type[0]){
                type = el;
            }
        });

        if (type && type.length > 0) {
            type = <div className="program-card__type-wrapper">
                <a className="program-card__type" href={type[0].link} dangerouslySetInnerHTML={{__html: type[0].name}} />
            </div>
        }
    }

    title= <span className="program-card__title">
        <a href={post.acf_program_card_link['url']} target={post.acf_program_card_link['target']} dangerouslySetInnerHTML={{__html: postTitle}}/>
    </span>

    //city
    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term') && post.city) {
        categories = post._embedded['wp:term'];
        categories.forEach((el,index) =>{
            if(el[0] && el[0].id === post.city[0]){
                city = el;
            }
        });
    }

    //country
    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term') && post.country) {
        categories = post._embedded['wp:term'];
        categories.forEach((el,index) =>{
            if(el[0] && el[0].id === post.country[0]){
                country = el;
            }
        });
    }

    //term
    if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term') && post.term) {
        categories = post._embedded['wp:term'];
        categories.forEach((el,index) =>{
            el.forEach(ele =>{
                if( post.term.includes(ele.id)){
                    terms.push(ele);
                }
            })
        });
    }

    terms = terms.map((term,i)=>(
        <a key={i} className="program-card__info-term" aria-label={`${term['name']} programs.`} href={term.link}>{term['name'].replace('&amp;', '&')}
        {i < terms.length - 1 ? ", " : null}</a>
    ));


    //info
    if (terms && terms.length > 0) {
        termContent = <div className="program-card__info-terms">
            <span className="program-card__info-name program-card__info-name-terms">Term(s): </span>
            {terms}

        </div>
    }
    
    info =  <div className="program-card__info">
                <div className="program-card__info-location">
                    <span className="program-card__info-name program-card__info-name-location ">Location: </span>
                    {city ?
                    <a href={city[0].link} className="program-card__info-city" aria-label={`${city[0].name} programs.`} dangerouslySetInnerHTML={{__html:city[0].name + ", "}}/>
                    : null
                    }
                    {country ?
                    <a href={country[0].link} className="program-card__info-country" aria-label={`${country[0].name} programs.`} dangerouslySetInnerHTML={{__html:country[0].name}}/>
                    : null
                    }
                </div>
                
                {termContent}
            </div>

    //appdeadline
    if(post.acf_program_card_app_deadline){
    app_deadline = <p className="program-card__application-deadline">
        <span className="program-card__application-deadline-name">Application Deadline: </span>
        <span className="program-card__application-deadline-date">{post.acf_program_card_app_deadline}</span>
    </p>
    }

    return (
        <article id={`${postType}-${post.id}`} className="program-card">
            <div className="program-card__wrapper">
                {status}
                <a href={post.acf_program_card_link['url']} target={post.acf_program_card_link['target']}>
                    {featuredImage}
                </a>

                <div className="program-card__content">
                    {type}
                    {title}
                    {info}
                    {app_deadline}
                </div>
            </div>
        </article>
    );
}

export default post;