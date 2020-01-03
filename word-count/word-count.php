<?php
/*
 * Plugin Name: Word Count
 * Plugin URI: https://facebook.com/asib.ikbal
 * Description: A simple plugin that count the words from wordpress post
 * Version: 1.0
 * Author: Asib Ikbal
 * Author URI: https://facebook.com/asib.ikbal
 * License: GPLv2 or Later
 * Text Domain: word_count
 * Domain Path: /languages/
 */

/*function wc_activation_hook(){}
register_activation_hook(__FILE__,"wc_activation_hook");
function wc_deactivation_hook(){}
register_deactivation_hook(__FILE__,"wc_deactivation_hook");*/

function wc_loaded_textdomain(){
	load_plugin_textdomain("word-count",false,dirname(__FILE__)."/languages/");
}
add_action("plugin_loaded","wc_loaded_textdomain");

function wc_count_words($content){
	$striped_content = strip_tags($content);
	$word_count = str_word_count($striped_content);
	$label = __("Total Number of Words","word_count");
	$label_mod = apply_filters("wc_heading",$label);
	$tag = apply_filters("wc_tag","h2");
	$content .= sprintf("<%s>%s : %s</%s>",$tag,$label_mod,$word_count,$tag);
	return $content;
}
add_filter("the_content","wc_count_words");

function wc_reading_time($content){
	$striped_content = strip_tags($content);
	$word_count = str_word_count($striped_content);
	$reading_minutes = floor($word_count / 200 );
	$reading_seconds = floor($word_count % 200 / (200/60) );
	$is_visible = apply_filters("wc_reading_displaytime",1);
	if ($is_visible){
		$label = __("Total Reading Time","word_count");
		$label_mod = apply_filters("wc_heading",$label);
		$tag = apply_filters("wc_tag","h3");
		$content .= sprintf("<%s>%s : %s minutes and %s seconds</%s>",$tag,$label_mod,$reading_minutes,$reading_seconds,$tag);

	}
	return $content;
}
add_filter("the_content","wc_reading_time");