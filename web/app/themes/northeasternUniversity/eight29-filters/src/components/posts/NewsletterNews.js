import React from 'react';

function NewsletterNews(props) {
    const { data: {acf_news_newsletter} } = props;
    const {news_newsletter_title, news_newsletter_description, news_newsletter_form} = acf_news_newsletter;
    return <div className="newsletter-news">
                <div className="newsletter-news__left">
                    <h3 className="newsletter-news__title" dangerouslySetInnerHTML={{ __html: news_newsletter_title }} />
                    <p className="newsletter-news__desc" dangerouslySetInnerHTML={{ __html: news_newsletter_description }} />
                </div>
                <div className="newsletter-news__right">
                    <div className="newsletter-news__right-content" dangerouslySetInnerHTML={{ __html: news_newsletter_form }}/>
                </div>
            </div>
}

export default NewsletterNews;