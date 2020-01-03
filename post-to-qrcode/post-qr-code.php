<?php
/*
 * Plugin Name: Post To QR-Code
 * Plugin URI: https://facebook.com/asib.ikbal
 * Description: generate QR code for every post link
 * Version: 1.0
 * Author: Asib Ikbal
 * Author URI: https://facebook.com/asib.ikbal
 * License: GPLv2 or Later
 * Text Domain: post-to-qrcode
 * Domain Path: /languages/
 */

function ptqrc_loaded_textdomain() {
	load_plugin_textdomain( "post-qr-code", false, dirname( __FILE__ ) . "/languages/" );
}
add_action( "plugin_loaded", "ptqrc_loaded_textdomain" );

function ptqrc_display_qr_code($content){
	$current_post_id = get_the_ID();
	$current_post_title = get_the_title($current_post_id);
	$current_post_url = urlencode(get_the_permalink($current_post_id));
	$image_src = sprintf("https://api.qrserver.com/v1/create-qr-code/?size=185x185&ecc=L&qzone=1&data=%s",$current_post_url);
	$content .= sprintf("<div class='qr-code'><img src='%s' alt='%s'></div>",$image_src,$current_post_title);
	return $content;
}
add_filter("the_content","ptqrc_display_qr_code");

