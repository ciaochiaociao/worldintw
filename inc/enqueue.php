<?php

/*

@package worldintw
=============
ADMIN ENQUEUE SCRIPTS
=============

*/
// wp_register_script( $handle, $src, $deps = array, $ver = false, $in_footer = false )
// wp_register_style( $handle, $src, $deps = array, $ver = false, $media = 'all' )

function worldintw_enqueue_admin_scripts( $hook ) {
	// var_dump(urlencode(bloginfo( 'name' )) . '_page_worldintw_css');
	if ($hook == 'toplevel_page_worldintw') {

		wp_register_style( 'worldintw_admin_css', get_template_directory_uri() . '/css/worldintw.admin.css', array(), '1.0.0', 'all' );

		wp_enqueue_style( 'worldintw_admin_css' );

		wp_register_script( 'worldintw_admin_js', get_template_directory_uri() . '/js/worldintw.admin.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'worldintw_admin_js' );

		wp_enqueue_media();

	} else if ($hook == '%e8%ad%af%e4%b8%96%e7%95%8c%e5%a7%94%e5%93%a1%e6%9c%83_page_worldintw_css'){
		error_log('Test');
		wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array(), '1.3.3', true );
		wp_enqueue_script( 'custom_css_section_js', get_template_directory_uri() . '/js/custom_css.js', array('jquery'), '1.0.0', true );
		wp_enqueue_style( 'custom_css_section_css', get_template_directory_uri() . '/css/custom_css.css', array(), '1.0.0', 'all');
	}
}
add_action('admin_enqueue_scripts', 'worldintw_enqueue_admin_scripts');

function load_front_end_scripts(){
	wp_enqueue_style( 'worldintw', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', true );
	wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Roboto:400,500');
	// wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.1', 'all' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min-3.3.7.css', array(), '3.3.7', 'all' );

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.3.1', true );
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array(), '1.14.3', true);
	wp_enqueue_style( 'popper' );
	// wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery', 'popper'), '4.1.1', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min-3.3.7.js', array('jquery', 'popper'), '3.3.7', true );
}
add_action( 'wp_enqueue_scripts', 'load_front_end_scripts');







?>