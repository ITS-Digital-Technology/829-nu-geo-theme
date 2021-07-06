<?php
//Conditionally display the_content
function defaultContent() {
  if ( !empty(get_the_content()) ) {
    get_theme_part('page/default-content');
  }
}
