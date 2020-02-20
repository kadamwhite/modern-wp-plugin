<?php
require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// Now call the bootstrap method of WP Mock
WP_Mock::setUsePatchwork( true );
WP_Mock::bootstrap();

// Load in our custom files.
// require_once dirname( __DIR__ ) . '/inc/helpers.php';

// Load the base class for endpoint tests.
require_once __DIR__ . '/inc/api/class-endpoint-test.php';
