<?php

/*

@package worldintw
=============
THEME SUPPORT PAGE
=============

*/
$activate = esc_attr(get_option( 'activate_contact_form' ));
if ($activate == 1){
	
	// Create a custom post type
	add_action( 'init', 'worldintw_custom_post_type');

	// Custom post column names shown in posts list
	add_filter( 'manage_contact-post-type_posts_columns', 'worldintw_custom_contact_columns');
	// Custom post column content shown in posts list 
	add_action( 'manage_contact-post-type_posts_custom_column', 'worldintw_custom_contact_columns_content', 10, 2);
	// add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 )

	// Show custom meta box: email
	add_action( 'admin_init', 'worldintw_add_meta_box' );
	add_action( 'save_post', 'worldintw_save_contact_form_email');
}

// Contact form meta box: email
function worldintw_add_meta_box() {
	add_meta_box( 'contact-form-email', 'Email Address', 'worldintw_contact_form_email_callback', 'contact-post-type', 'side', 'default');
	// add_meta_box( $id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null )
}

function worldintw_contact_form_email_callback($post) {
	wp_nonce_field( 'worldintw_save_contact_form_email', 'worldintw_save_contact_form_email_nonce');
	// wp_nonce_field( $action = -1, $name = '_wpnonce', $referer = true, $echo = true )
	$value = get_post_meta( $post->ID, '_worldintw_contact_email_key', true );
	// get_post_meta( $post_id, $key = '', $single = false )
	echo '<label for="worldintw_contact_email_field">' . __('User Email Address:', 'worldintw') . '</label>';
	echo '<input type="email" name="worldintw_contact_email_field" id="worldintw_contact_email_field" value="'.esc_attr( $value ).'"/>';
}

// Save Email Meta Box
function worldintw_save_contact_form_email($post_id) {
	// Verify nonce
	if ( !isset($_POST['worldintw_save_contact_form_email_nonce']) ){
		return;
	}
	if ( !wp_verify_nonce( $_POST['worldintw_save_contact_form_email_nonce'], 'worldintw_save_contact_form_email' ) ){
		// wp_verify_nonce( $nonce, $action = -1 )
		return;
	}

	// Check authority
	if ( !current_user_can( 'edit_post', $post_id )){
		// current_user_can( $capability )
		return;
	}

	// Don't update when wordpress auto-saves changes in post
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return;
	}

	if ( !isset($_POST['worldintw_contact_email_field']) ){
		return;
	}

	update_post_meta( $post_id, '_worldintw_contact_email_key', sanitize_text_field( $_POST['worldintw_contact_email_field'] ) );
	// update_post_meta( $post_id, $meta_key, $meta_value, $prev_value = '' )
}

// Custom post column content
function worldintw_custom_contact_columns_content($column, $post_id) {
	switch ($column) {
		case 'message':
			echo get_the_excerpt();
			break;
		case 'email':
			$email = get_post_meta( $post_id, '_worldintw_contact_email_key', true);
			echo '<a href="mailto:'. $email . '">' . $email . '</a>';
			break;
		default:
			break;
	}
}

// Custom post column field names
function worldintw_custom_contact_columns($column) {
	$newcolumn = array(
		'title' 	=> __('Full Name', 'worldintw'),
		'message' 	=> __('Message', 'worldintw'),
		'email'		=> __('Email', 'worldintw')
	);
	return $newcolumn;
}

// Custom post type
function worldintw_custom_post_type(){
	/**
	 * Registers a new post type
	 * @uses $wp_post_types Inserts new post type object into the list
	 */
	
	$labels = array(
		'name'               => __( 'New Messages', 'worldintw' ),
		'singular_name'      => __( 'New Message', 'worldintw' ),
		'add_new'            => _x( 'Add New Message', 'Add some new messages', 'worldintw' ),
		'add_new_item'       => __( 'Add New Message item', 'worldintw' ),
		'edit_item'          => __( 'Edit Message', 'worldintw' ),
		'new_item'           => __( 'New Message', 'worldintw' ),
		'view_item'          => __( 'View Message', 'worldintw' ),
		'search_items'       => __( 'Search Messages', 'worldintw' ),
		'not_found'          => __( 'No Messages found', 'worldintw' ),
		'not_found_in_trash' => __( 'No Messages found in Trash', 'worldintw' ),
		'menu_name'          => __( 'Messages', 'worldintw' ),
		'admin_bar'			 => __( 'Messages_admin', 'worldintw'), //can't find it in guide
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		// 'description'         => 'This is a custom contact form ',
		// 'taxonomies'          => array(),
		// 'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		// 'show_in_admin_bar'   => true,
		'menu_position'       => 26,
		'menu_icon'           => 'dashicons-email-alt',
		// 'show_in_nav_menus'   => true,
		// 'publicly_queryable'  => true,
		// 'exclude_from_search' => false,
		// 'has_archive'         => true,
		// 'query_var'           => true,
		// 'can_export'          => true,
		// 'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'author',
			// 'thumbnail',
			// 'excerpt',
			// 'custom-fields',
			// 'trackbacks',
			// 'comments',
			// 'revisions',
			// 'page-attributes',
			// 'post-formats',
		)
	);
	register_post_type( 'contact-post-type', $args );
	// register_post_type( $post_type, $args = array )
}




?>