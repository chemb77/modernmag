<?php
/*
Plugin Name: WP-Protect
Plugin URI: http://www.jejani.com/wp-protect/
Description: Protect your WordPress site against right clicks, text selection, and image dragging.
Version: 1.1
Author: Jejani Media
Author URI: http://www.jejani.com/
*/

function WPP_OPT() {
if(!isset($_POST['wpprotect_update'])){
$_POST['wpprotect_update'] = "";
}
if(!isset($_POST['wpp_rightclick'])){
$_POST['wpp_rightclick'] = "";
}
if(!isset($_POST['wpp_textselect'])){
$_POST['wpp_textselect'] = "";
}
if(!isset($_POST['wpp_dragging'])){
$_POST['wpp_dragging'] = "";
}
if($_POST['wpprotect_update']){
update_option('wpp_rightclick',$_POST['wpp_rightclick']);
update_option('wpp_textselect',$_POST['wpp_textselect']);
update_option('wpp_dragging',$_POST['wpp_dragging']);
}
$wp_wpp_rightclick = get_option('wpp_rightclick');
$wp_wpp_textselect = get_option('wpp_textselect');
$wp_wpp_dragging = get_option('wpp_dragging');
?>
<div class="wrap">
<h2>WP-Protect (Configuration)</h2>
<form method="post" id="WPP_OPT">
<fieldset class="options">
<p><input type="checkbox" id="wpp_rightclick" name="wpp_rightclick" value="wpp_rightclick" <?php if($wp_wpp_rightclick == true) { echo('checked="checked"'); } ?> /> Disable right clicking</p>
<p><input type="checkbox" id="wpp_textselect" name="wpp_textselect" value="wpp_textselect" <?php if($wp_wpp_textselect == true) { echo('checked="checked"'); } ?> /> Disable text selection</p>
<p><input type="checkbox" id="wpp_dragging" name="wpp_dragging" value="wpp_dragging" <?php if($wp_wpp_dragging == true) { echo('checked="checked"'); } ?> /> Disable image dragging</p>
<p><em>Notice: disabling image dragging may conflict with search/input fields, or with other WordPress plugins.</em></p>
<p><em>If you have a minute, please <a href="http://wordpress.org/extend/plugins/wp-protect/" target="_blank">rate this plugin</a> on WordPress.org... thanks!</em></p>
<p><input type="submit" name="wpprotect_update" value="Update" /></p>
</fieldset>
</form>
<br>
<p>Check out some of these great resources:</p>
<p><ul><li>&bull; <a href="http://wordpress-tube-theme.com/" target="_blank">WordPress Tube Theme</a> (PG-13 ... build your own video tube)</li>
<li>&bull; <a href="http://filepig.org/" target="_blank">FilePig</a> (best online collection of free Windows software)</li>
<li>&bull; <a href="http://www.ratebin.com/" target="_blank">RateBin</a> (ratings for webmasters - hosts, registrars, and more)</li>
<li>&bull; <a href="http://www.jejani.com/" target="_blank">Jejani Media</a> (free WordPress plugins and themes, etc)</li></ul></p>
</div>
<?php
}

function finish_footer()
{
?>
<script type="text/javascript">
disableSelection(document.body)
</script>
<?php
}

function wpprotect_rightclick()
{
?>
<script language=JavaScript>
var message="";
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
</script>
<?php
}

function wpprotect_textselect()
{
?>
<script type="text/javascript">
function disableSelection(target){
if (typeof target.onselectstart!="undefined")
target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined")
target.style.MozUserSelect="none"
else
target.onmousedown=function(){return false}
target.style.cursor = "default"
}
</script>
<?php
}

function wpprotect_dragging()
{
?>
<script type="text/javascript">
window.onload = function (e) {
var evt = e || window.event,
imgs,
i;
if (evt.preventDefault) {
imgs = document.getElementsByTagName('img');
for (i = 0; i < imgs.length; i++) {
imgs[i].onmousedown = disableDragging;
}
}
};
function disableDragging(e) {
e.preventDefault();
}
</script>
<?php
}

function wpprotect_footer() {
$wp_wpp_textselect = get_option('wpp_textselect');
if($wp_wpp_textselect == true) { finish_footer(); }
}

function wpprotect_header() {
$wp_wpp_textselect = get_option('wpp_textselect');
$wp_wpp_rightclick = get_option('wpp_rightclick');
$wp_wpp_dragging = get_option('wpp_dragging');
$pos = strpos(strtoupper(getenv("REQUEST_URI")), '?preview=true');
if ($pos === false) {
if($wp_wpp_rightclick == true) { wpprotect_rightclick(); }
if($wp_wpp_textselect == true) { wpprotect_textselect(); }
if($wp_wpp_dragging == true) { wpprotect_dragging(); }
}
}

function wpprotect_admin() {
if (function_exists('add_options_page')) {
add_options_page('WP-Protect', 'WP-Protect', 'manage_options', basename(__FILE__), 'WPP_OPT');
}
}

function wpprotect_actions( $links, $file ) {
if( $file == 'wp-protect/wp-protect.php' && function_exists( "admin_url" ) ) {
$settings_link = '<a href="' . admin_url( 'options-general.php?page=wp-protect.php' ) . '">' .'Settings' . '</a>';
array_unshift( $links, $settings_link );
}
return $links;
}

add_action('wp_footer','wpprotect_footer');
add_action('admin_menu','wpprotect_admin');
add_action('wp_head','wpprotect_header');
add_filter('plugin_action_links', 'wpprotect_actions', 10, 2);
?>
