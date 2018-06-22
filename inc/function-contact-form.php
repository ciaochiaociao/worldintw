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

}



function worldintw_custom_contact_columns_content($column, $post_id) {
	switch ($column) {
		case 'message':
			echo get_the_excerpt();
			break;
		case 'email':
			break;
		default:
			break;
	}
}

function worldintw_custom_contact_columns($column) {
	$newcolumn = array(
		'title' 	=> __('Full Name', 'worldintw'),
		'message' 	=> __('Message', 'worldintw'),
		'email'		=> __('Email', 'worldintw')
	);
	return $newcolumn;
}

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
}

?>