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
	if (post.hasOwnProperty('_embedded') && post._embedded.hasOwnProperty('wp:term') && post.post_topic) {
		categories = post._embedded['wp:term'];
		categories.forEach((el, index) => {
			if (el[0] && el[0].id === post.post_topic[0]) {
				type = el;
			}
		});

		if (type && type.length > 0) {
			type = <div className="blog-post__card-cat">
				<a className="blog-post__card-cat-link" aria-label={`${type[0].name} blog posts.`} href={type[0].link} dangerouslySetInnerHTML={{ __html: type[0].name }} />
			</div>
		}
	}

	if (post.author && post.author !== 'Northeastern University' && displayAuthor) {
		author = <div className="blog-post__card-author">
			<a href={post._embedded['author'][0]['link']} className="block-post__card__author-link" aria-label={`${post.author} blog posts.`} dangerouslySetInnerHTML={{ __html: "By " + post.author }} />

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
		<article id={`${postType}-${post.id}`} className="blog-post__card">
			<div className="blog-post__card-wrapper">
				<a className="blog-link" href={post.link}>{featuredImage}</a>
				
				<div className="blog-post__card-content">
					{type}
					<h3 className="blog-post__card-title">
						<a className="blog-link" href={post.link} dangerouslySetInnerHTML={{ __html: post.title.rendered }}></a>
					</h3>
					{author}
				</div>
			</div>
		</article>
	);
}

export default post;