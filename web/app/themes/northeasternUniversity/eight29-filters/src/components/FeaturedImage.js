import React from 'react';

function featuredImage(props) {
  const {
    image,
    imageSize
  } = props;

  let imgTag = '';
  let srcset = props.srcset && props.srcset[imageSize] ? props.srcset[imageSize] : '';


  if (image && image[0].media_details) {
    if (image[0].media_details.sizes[imageSize]) {
        imgTag = <img src={image[0].media_details.sizes[imageSize].source_url} srcSet={srcset} alt={image[0].title.rendered}></img>;
    } else if(image[0].media_details.sizes['full'] ) {
        imgTag = <img src={image[0].media_details.sizes['full'].source_url} srcSet={srcset} alt={image[0].title.rendered}></img>;
    } else {
        imgTag = <img src={image[0].source_url} srcSet={srcset} alt={image[0].title.rendered}></img>;
    }
}
return imgTag;
}

export default featuredImage;
