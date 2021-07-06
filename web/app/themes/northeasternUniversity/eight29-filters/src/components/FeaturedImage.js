import React from 'react';

function featuredImage(props) {
  const {
    image,
    imageSize
  } = props;

  let imgTag = '';
  let srcset = props.srcset && props.srcset[imageSize] ? props.srcset[imageSize] : '';


  if (image && image[0].media_details) {
    const altText = image[0].hasOwnProperty('alt_text') ? image[0].alt_text : '';

    if (image[0].media_details.sizes[imageSize]) {
        imgTag = <img src={image[0].media_details.sizes[imageSize].source_url} srcSet={srcset} alt={altText}></img>;
    } else if(image[0].media_details.sizes['full'] ) {
        imgTag = <img src={image[0].media_details.sizes['full'].source_url} srcSet={srcset} alt={altText}></img>;
    } else {
        imgTag = <img src={image[0].source_url} srcSet={srcset} alt={altText}></img>;
    }
}
return imgTag;
}

export default featuredImage;
