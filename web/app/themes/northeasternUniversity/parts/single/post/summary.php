<?php
$authorID = get_the_author_meta('ID');
$authorName = get_the_author_meta( 'display_name', $authorID );
$image = get_field('author_image', 'user_'. $authorID);
$description = get_the_author_meta( 'description', $authorID );
$share_buttons = get_field('share_buttons', 'option');
?>
<section class="single-post-summary">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="single-post-summary__top">
                <?php if (has_tag()) : ?>
                    <div class="single-post-summary__tags-wrapper">
                        <p class="single-post-summary__tags-headline">
                            <?php _e('Tags', 'northeasternUniversity'); ?>
                        </p>
                        <?php show_post_tags(get_the_ID()); ?>
                    </div>
                <?php endif; ?>
                    <div class="single-post-summary__share-wrapper">
                        <p class="single-post-summary__tags-headline">
                            <?php _e('Share Post', 'northeasternUniversity'); ?>
                        </p>
                        
                        <div class="share-buttons">
                            <?php echo $share_buttons; ?>
                        </div>
                    </div>
                </div>

            <?php if (!empty($authorID) && !empty($description)) : ?>
                <div class="single-post-summary__bottom">
                    <div class="single-post-summary__author single-post-author">
                    <?php if (!empty($image)) : ?>
                        <figure class="single-post-author__photo">
                            <?php echo f_img($image); ?>
                        </figure>
                    <?php endif; ?>
                        <p class="single-post-author__subheading">
                            <?php _e('Written By', 'northeasternUniversity'); ?>
                        </p>
                    <?php if (!empty($authorName)) : ?>
                        <h3 class="single-post-author__name">
                            <?php echo $authorName; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if (!empty($description)) : ?>
                        <p class="single-post-author__description">
                            <?php echo $description; ?>
                        </p>
                    <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>