<?php
add_action( 'init', 'add_page_excerpts' );

function add_page_excerpts() {
  add_post_type_support( 'page', 'excerpt' );
}

add_action( 'extend_uw_object', function($UW) {
  require( 'setup/uw.brand-scripts.php' );
  require( 'setup/uw.brand-styles.php' );
});
