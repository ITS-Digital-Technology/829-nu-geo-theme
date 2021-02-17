<?php
// Remove Categories
add_action('init', 'category_remove_tax');
function category_remove_tax() {
    register_taxonomy('category', array());
}