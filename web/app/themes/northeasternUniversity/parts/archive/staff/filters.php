<div class="posts-list">
    <?php
        if ( class_exists('eight29_filters') && !is_search() ) {
            echo do_shortcode('[eight29_filters
            post_type="staff"
            posts_per_page="18"
            posts_per_row="3"
            pagination_style="more"
            layout="staff"
            ]');
        }
    ?>
</div>