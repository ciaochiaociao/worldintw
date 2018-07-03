<?php

/*

This is the template for the header

@package worldintw

*/

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
		<title><?php bloginfo( 'name' ); wp_title(); ?></title> <!-- wp_title() to be deprecated -->
		<meta name="description" content="<?php bloginfo( 'description' ) ?>">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- shrink-to-fit=no -->
		<link rel="profile" href="https://gmpg.org/xfn/11"> <!-- xfn as XHTML friends Network and for SEO -->
		<?php if(is_singular() && pings_open( get_queried_object() ) ): ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"> <!-- show pingback in single post or page for reference from other blogger and SEO -->
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>