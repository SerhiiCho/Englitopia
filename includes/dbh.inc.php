<?php session_start();

// Define base params
define( 'BASE_DIR', dirname(dirname(__FILE__)) );

require BASE_DIR.'/libs/rb.php';
require BASE_DIR.'/config.php';

ini_set( 'display_errors', $config['display_errors'] );

// Disable the website
if ( $config['disabled'] === true ) {
    die('<h2>Sorry, the site is temporarily unavailable</h2>');
}

// Database connection
R::setup(
    $config['database']['connect'],
    $config['database']['username'],
    $config['database']['password']
);

R::freeze( true );