<?php
// remove css and js wordpress version strings
function worldintw_remove_wp_version_string ($src) {
	global $wp_version;

	// parse_url(url), parse_str(query_str)
	parse_str(parse_url($src, PHP_URL_QUERY), $query);
	if ( !empty($query['ver']) && $query['ver'] === $wp_version){
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}

add_filter( 'script_loader_src', 'worldintw_remove_wp_version_string' );
add_filter( 'style_loader_src', 'worldintw_remove_wp_version_string' );

// remove the generator meta tag with wordpress version
function worldintw_remove_meta_generator_version ($src) {
	return '';
}
add_filter( 'the_generator', 'worldintw_remove_meta_generator_version' );
function remove_generator_function(){
	remove_action( 'wp_head', 'wp_generator');	
}
add_action('after_setup_theme', 'remove_generator_function');
