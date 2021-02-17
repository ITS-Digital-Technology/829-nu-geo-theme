import React from 'react';

function NewsletterPost(props) {
    const { data: {acf_blog_newsletter} } = props;
    const {button, left_content, right_content} = acf_blog_newsletter;
    return <div className="newsletter-post">
                <div className="newsletter-post__left" dangerouslySetInnerHTML={{ __html: left_content }} />

                <div className="newsletter-post__right">
                    <div className="newsletter-post__right-content" dangerouslySetInnerHTML={{ __html: right_content }}/>
                    <div className="c-btn-wrapper">
                        <a className="c-btn c-btn-primary c-btn-color-normal" href={button.url}>{button.title}</a>
                    </div>
                </div>
            </div>
}

export default NewsletterPost;