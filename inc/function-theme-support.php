<?php

/*

@package worldintw
=============
THEME SUPPORT PAGE
=============

*/

function worldintw_add_theme_support(){
	$postFormats = get_option( 'post_formats' );
	$output = array();
	foreach ($postFormats as $format => $value) {
		if ($value) {
			$output[] = $format; //array push/append
		}
	}
	if( !empty($postFormats)){
		add_theme_support( 'post-formats', $output );
	}
}
add_action( 'after_setup_theme', 'worldintw_add_theme_support');

?>