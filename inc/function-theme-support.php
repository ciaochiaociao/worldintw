<?php

/*

@package worldintw
=============
THEME SUPPORT PAGE
=============

*/

function worldintw_add_theme_support(){
	// Add Post Formats Theme Support
	$postFormats = get_option( 'post_formats' );
	$output = array();
	if( !empty($postFormats)){
		foreach ($postFormats as $format => $value) {
			if ($value) {
				$output[] = $format; //array push/append
			}
		}
		add_theme_support( 'post-formats', $output );
	}
	
	// Add Custom Header Theme Support
	$customHeader = esc_attr(get_option( 'custom_header' ));
	if ($customHeader == 1){
		add_theme_support( 'custom-header' );
	}

	// Add Custom Background Theme Support
	$customBackground = esc_attr(get_option( 'custom_background' ));
	if ($customBackground == 1){
		add_theme_support( 'custom-background' );
	}

}
add_action( 'after_setup_theme', 'worldintw_add_theme_support');

function worldintw_custom_nav_menu () {
	add_theme_support( 'menus' );
	register_nav_menu( 'primary', 'Primay Navigation Menu' );
}
add_action( 'init', 'worldintw_custom_nav_menu' );














?>