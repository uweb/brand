<?php

add_action( 'extend_uw_object', function($UW) {
  require( 'setup/uw.brand-scripts.php' );
  require( 'setup/uw.brand-styles.php' );
});
