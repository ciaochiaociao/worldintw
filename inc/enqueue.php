<?php

/*

@package worldintw
=============
ADMIN ENQUEUE SCRIPTS
=============

*/
function worldintw_enqueue_admin_scripts( $hook ) {

	if ($hook != 'toplevel_page_worldintw') return;

	wp_register_style( 'worldintw_admin_css', get_template_directory_uri() . '/css/worldintw.admin.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'worldintw_admin_css' );

	wp_register_script( 'worldintw_admin_js', get_template_directory_uri() . '/js/worldintw.admin.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'worldintw_admin_js' );

	wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'worldintw_enqueue_admin_scripts');

?>