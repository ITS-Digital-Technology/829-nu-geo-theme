<div class="posts-list" data-display-newsletter="true" data-newsletter-post-row="3">
    <?php
        if ( class_exists('eight29_filters') && !is_search() ) {
            echo do_shortcode('[eight29_filters
            post_type="post"
            posts_per_page="12"
            posts_per_row="3"
            display_search="true"
            pagination_style="pagination"
            display_reset="true"
            mobile_style="modal"
            ]');
        }
    ?>
</div>