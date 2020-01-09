<?php
/**
 * Universal block loader
 */

$universal_block = get_sub_field('universal_block');
foreach ($universal_block as $universal_block) {
    ContentBlock::display_theme_blocks('page_blocks', $universal_block); 
}
?>