<div class="posts-list" data-display-newsletter="false" data-newsletter-post-row="3">
    <?php
        if ( class_exists('eight29_filters') && !is_search() ) {
            echo do_shortcode('[eight29_filters
            post_type="news"
            posts_per_page="12"
            posts_per_row="3"
            mobile_style="scroll"
            display_excerpt="true"
            display_date="true"
            pagination_style="pagination"
            ]');
        }
    ?>
</div>