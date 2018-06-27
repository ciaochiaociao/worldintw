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
	add_submenu_page( 'worldintw', 'Sidebar Options', 'Sidebar', 'manage_options', 'worldintw', 'worldintw_theme_create_page' ); // Assign the submenu slug/function to the menu slug/function for making default submenu page
	add_submenu_page( 'worldintw', 'Custom Contact Form', 'Contact Form', 'manage_options', 'worldintw_contact_form', 'worldintw_contact_form_page' );
	add_submenu_page( 'worldintw', 'Theme Support Options', 'Theme Support', 'manage_options', 'worldintw_theme_support', 'worldintw_theme_support_page' );
	add_submenu_page( 'worldintw', 'World In TW CSS', 'Custom CSS', 'manage_options', 'worldintw_css', 'worldintw_theme_css_page' );
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )

	// Only load custom settings after the loading of the worldintw_add_admin_page() is successful
	add_action( 'admin_init', 'worldintw_custom_settings' );
}
add_action('admin_menu', 'worldintw_add_admin_page');

function worldintw_custom_settings() {

	// [ Sidebar Setting]
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

	// [ Theme Support Setting ]
	register_setting( 'worldintw-theme-support-options-group', 'post_formats' );
	register_setting( 'worldintw-theme-support-options-group', 'custom_header' );
	register_setting( 'worldintw-theme-support-options-group', 'custom_background' );
	add_settings_section( 'worldintw-theme-options', 'Theme Options', 'worldintw_theme_options', 'worldintw_theme_support' );
	add_settings_field( 'post-formats', 'Post Formats', 'worldintw_post_formats', 'worldintw_theme_support', 'worldintw-theme-options' );
	add_settings_field( 'custom-header', 'Custom Header', 'worldintw_custom_header', 'worldintw_theme_support', 'worldintw-theme-options' );
	add_settings_field( 'custom-background', 'Custom Background', 'worldintw_custom_background', 'worldintw_theme_support', 'worldintw-theme-options' );

	// [ Contact Form Setting ]
	register_setting( 'worldintw-contact-form-options-group', 'activate_contact_form' );
	add_settings_section( 'worldintw-contact-form-section', 'Contact Form Options', 'worldintw_contact_form_options', 'worldintw_contact_form' );
	add_settings_field( 'activate-contact-form', 'Activate Contact Form', 'worldintw_activate_contact_form', 'worldintw_contact_form', 'worldintw-contact-form-section');

	// [ Custom CSS ]
	register_setting( 'worldintw-theme-css-options-group', 'custom_css' );
	add_settings_section( 'worldintw-theme-css-section', 'Custom CSS', 'worldintw_theme_css_section_callback', 'worldintw_css' );
	add_settings_field( 'custom-css-field', 'Custom CSS', 'worldintw_custom_css_callback', 'worldintw_css', 'worldintw-theme-css-section');

}

function worldintw_theme_css_section_callback(){
	_e('Customize your theme with CSS', 'worldintw');
}

function worldintw_custom_css_callback(){
	$css = get_option('custom_css');
	$default = '/*' . __('Input Your CSS Here', 'worldintw') . '*/';
	$css = ( empty($css) ) ? $default : $css;
	echo '<div id="editor">'. $css .'</div>';

	// Use a hidden tag with jQuery to submit the css code in the above div.
	echo '<textarea name="custom_css" id="submit-for-custom-css" style="visibility: hidden; display:none;" ></textarea>';
}

function worldintw_contact_form_options() {
	_e('Custom your contact form', 'worldintw');
}

function worldintw_activate_contact_form() {
	$option = get_option( 'activate_contact_form' );
	$checked = ( @$option == 1? 'checked':'' );
	echo '<input type="checkbox" name="activate_contact_form" '. $checked .' value=1 /><br>';
}

function worldintw_theme_options() {
	_e('Activate and deactivate post format options', 'worldintw');
}

function worldintw_post_formats() {
	$postFormats = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach($formats as $format){
		$checked = ( @$postFormats[$format] == 1? 'checked':'' );
		$output .= '<label><input type="checkbox" name="post_formats['. $format .']" '. $checked .' value=1 />' . $format . '</label><br>';
	}
	echo $output;
}

function worldintw_custom_header() {
	$option = get_option( 'custom_header' );
	$checked = ( @$option == 1? 'checked':'' );
	echo '<input type="checkbox" name="custom_header" '. $checked .' value=1 /><br>';
}

function worldintw_custom_background() {
	$option = get_option( 'custom_background' );
	$checked = ( @$option == 1? 'checked':'' );
	echo '<input type="checkbox" name="custom_background" '. $checked .' value=1 /><br>';
}

function worldintw_sidebar_options() {
	_e('Customize your theme!', 'worldintw');
}

function worldintw_profile_picture() {
	$profilePicture = esc_attr( get_option( 'profile_picture' ) );
	if (empty($profilePicture)){
		echo '<input type="button" class="button button-secondary" id="upload-button" value="Choose Your Picture"/>
		<input id="profile-picture" type="hidden" name="profile_picture" value=""/><br>';
	} else {
		echo '<input type="button" class="button button-secondary" id="upload-button" value="Replace Your Picture"/>
		<input id="profile-picture" type="hidden" name="profile_picture" value="'. $profilePicture .'"/>
		<input type="button" class="button button-secondary" id="remove-button" value="Remove"/><br>';
	}
	echo '<img id="profile-picture-preview" width="200px" style="padding-top:10px;" src='. $profilePicture .'></img>';
	
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

function worldintw_theme_support_page() {
	require_once( get_template_directory() . '/inc/templates/template-theme-support.php' );
}

function worldintw_contact_form_page() {
	require_once( get_template_directory() . '/inc/templates/template-contact-form.php' );
}

function worldintw_theme_css_page() {
	require_once( get_template_directory() . '/inc/templates/template-theme-css.php' );
}

?>