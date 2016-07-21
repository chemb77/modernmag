<?php?><?php 
@ini_set('log_errors', 1);
@ini_set('display_errors', 1); /* enable or disable public display of errors (use 'On' or 'Off') */
@ini_set('error_log', dirname(__FILE__) . '/wp-content/logs/php-errors.log'); /* path to server-writable log file */
@ini_set( 'error_reporting', E_ALL ^ E_NOTICE );
get_header();

require(WEBTREATS_INCLUDES . "/var.php");

$show_on_front = get_option('show_on_front');
$page_on_front = get_option('page_on_front');

if( ($show_on_front == 'page') && ($page_on_front == $blog_page) ) {
	require(WEBTREATS_INCLUDES . "/template-blog.php");
}else{
	require(WEBTREATS_INCLUDES . "/featured-" .$homepage_slider. ".php");
	
get_footer();
}

?>
