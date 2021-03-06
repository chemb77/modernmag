<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

@ini_set('log_errors', 1);
@ini_set('display_errors', 1); /* enable or disable public display of errors (use 'On' or 'Off') */
@ini_set('error_log', dirname(__FILE__) . '/wp-content/logs/php-errors.log'); /* path to server-writable log file */
@ini_set( 'error_reporting', E_ALL ^ E_NOTICE );

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
