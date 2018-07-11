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
		<div class="container">	
			<div class="row">
				<div class="col-xs-12">
					
					<header class="header-container background-image text-center" style="background-image: url(<?php header_image(); ?>);">
						
						<div class="header-content table">
							<div class="table-cell">
								<h1 class="site-title worldintw">
									<span class="worldintw-logo"></span>
									<span class="hide"><?php bloginfo( 'name' ); ?></span>
								</h1>
								<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
							</div><!-- .table-cell -->
						</div><!-- .header-content -->
						
						<div class="nav-container">
							<nav class="navbar navbar-header navbar-worldintw">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => false,
									'menu_class' => 'nav navbar-nav'
								));
							?>
							</nav>
						</div><!-- .nav-container -->
						
					</header><!-- .header-container -->
					
				</div><!-- .col-xs-12 -->
			</div><!-- .row -->
			
		</div><!-- .container-fluid -->