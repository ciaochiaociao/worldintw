<?php

/*

@package worldintw
=============
ADMIN PAGE
=============

*/

function worldintw_add_admin_page() {

	// Add 譯世界委員會 page
	add_menu_page('World In TW Options', '譯世界委員會', 'manage_options', 'worldintw', 'worldintw_theme_create_page', get_template_directory_uri() . '/img/logo.svg', 110 );
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
	// Add 譯世界委員會 subpage
	add_submenu_page( 'worldintw', 'Sidebar Options', 'Sidebar', 'manage_options', 'worldintw', 'worldintw_theme_create_page' );
	add_submenu_page( 'worldintw', 'World In TW CSS', 'Custom CSS', 'manage_options', 'worldintw_css', 'worldintw_theme_css_page' );
	add_submenu_page( 'worldintw', 'Theme Support Options', 'Theme Support', 'manage_options', 'worldintw_theme_support', 'worldintw_theme_support_page' );
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )

	// Only load custom settings after the loading of the worldintw_add_admin_page() is successful
	add_action( 'admin_init', 'worldintw_custom_settings' );
}
add_action('admin_menu', 'worldintw_add_admin_page');

function worldintw_custom_settings() {

	// Add multiple settings with option name to option group 'worldintw-settings-group'
	register_setting( 'worldintw-options-group', 'profile_picture' );
	register_setting( 'worldintw-options-group', 'first_name' );
	register_setting( 'worldintw-options-group', 'last_name' );
	register_setting( 'worldintw-options-group', 'description' );
	register_setting( 'worldintw-options-group', 'twitter_handler', 'worldintw_sanitize_twitter_handler' );
	register_setting( 'worldintw-options-group', 'facebook_handler' );
	register_setting( 'worldintw-options-group', 'gplus_handler' );
		// register_setting( $option_group, $option_name, $args = array )
	
	// Add section 'worldintw-sidebar-options' 
	add_settings_section( 'worldintw-sidebar-options', 'Sidebar Options', 'worldintw_sidebar_options',  'worldintw');
		// add_settings_section( $id, $title, $callback, $page )

	// Add field names to section 'worldintw-sidebar-options' 
	add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'worldintw_profile_picture', 'worldintw', 'worldintw-sidebar-options' );
	add_settings_field( 'sidebar-name', 'Full Name', 'worldintw_name', 'worldintw', 'worldintw-sidebar-options' );
	add_settings_field( 'sidebar-description', 'Description', 'worldintw_description', 'worldintw', 'worldintw-sidebar-options' );
	add_settings_field( 'siderbar-twitter', 'Twitter Account', 'worldintw_sidebar_twitter', 'worldintw', 'worldintw-sidebar-options' );
	add_settings_field( 'siderbar-facebook', 'Facebook Account', 'worldintw_sidebar_facebook', 'worldintw', 'worldintw-sidebar-options' );
	add_settings_field( 'siderbar-gplus', 'Google+ Account', 'worldintw_sidebar_gplus', 'worldintw', 'worldintw-sidebar-options' );
		// add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array )

	// Theme Support Setting
	register_setting( 'worldintw-theme-support-options-group', 'post_formats', 'worldintw_post_formats_callback' );

}

// Post Formats Callback Function
function worldintw_post_formats_callback() {

}


function worldintw_sidebar_options() {
	echo 'Customize your theme!';
}

function worldintw_profile_picture() {
	$profilePicture = esc_attr( get_option( 'profile_picture' ) );
	echo '<img id="profile-picture-preview" width="200px" src='. $profilePicture .'></img><br>';
	echo '<input type="button" class="button button-secondary" id="upload-button" value="Choose Your Picture"/>';
	echo '<input id="profile-picture" type="hidden" name="profile_picture" value="'. $profilePicture .'"/>';
}

function worldintw_name() {
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	echo '<input type="text" name="first_name" value="'. $firstName .'" placeholder="Your First Name"/><input type="text" name="last_name" value="'. $lastName .'" placeholder="Your Last Name"/>';
}

function worldintw_description() {
	$description = esc_attr( get_option( 'description' ) );
	echo '<input type="text" name="description" value="'. $description .'" placeholder="Description"/><p class="description">Say something smart!</p>';
}

function worldintw_sidebar_twitter(){
	$twitter_handler = esc_attr( get_option( 'twitter_handler' ) );
	echo '<input type="text" name="twitter_handler" value="'. $twitter_handler .'" placeholder="Twitter Handler"/><p class="description">Input your twitter account without @ character.</p>';
}

function worldintw_sanitize_twitter_handler($input) {
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}

function worldintw_sidebar_facebook(){
	$facebook_handler = esc_attr( get_option( 'facebook_handler' ) );
	echo '<input type="text" name="facebook_handler" value="'. $facebook_handler .'" placeholder="Facebook Handler"/>';
}

function worldintw_sidebar_gplus(){
	$gplus_handler = esc_attr( get_option( 'gplus_handler' ) );
	echo '<input type="text" name="gplus_handler" value="'. $gplus_handler .'" placeholder="Google+ Handler"/>';
}

function worldintw_theme_create_page() {
	require_once( get_template_directory() . '/inc/templates/template-admin.php');
}

function worldintw_theme_css_page() {
	echo '<h1>Custom CSS</h1>';
}

function worldintw_theme_support_page() {
	require_once( get_template_directory() . '/inc/templates/template-theme-support.php' );
}


?>