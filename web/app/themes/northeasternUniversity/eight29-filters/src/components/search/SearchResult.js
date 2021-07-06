import React from 'react';
function searchResult(props) {
	const { post, postType } = props;
	let featuredImage;
	let cat = '';
	let excerpt = '';
	let link = '';

	if (post.excerpt) {
		excerpt = post.excerpt;
	} else {
		excerpt = post.content;
	}

	if (post.cat) {
		cat = <p className="search-result-card__cat" dangerouslySetInnerHTML={{ __html: post.cat }} />
	}

	if (post.featured_image) {
		featuredImage = <figure className="search-result-card__thumbnail" dangerouslySetInnerHTML={{ __html: post.featured_image }} />
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

	if (post.post_type === 'program') {
		link = post.link;
	} else {
		link = post.permalink;
	}

	return (
		<article className="search-result-card">
			<a className="search-result-card__link" href={link} data-id={post.id} />
			<div className="search-result-card__wrapper">
				<div className="search-result-card__content">
					{cat}
					<h5
						className="search-result-card__title"
						dangerouslySetInnerHTML={{ __html: post.title }}
					/>
					{excerpt}
				</div>
				{featuredImage && featuredImage}
			</div>
		</article>
	);
}

export default searchResult;
