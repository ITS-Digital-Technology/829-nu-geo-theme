<?php
function addtoany_custom_hide() {

if ( is_404() || is_singular() ){
    return true;
}
}
add_filter( 'addtoany_sharing_disabled', 'addtoany_custom_hide' );