<h1>Sidebar Options</h1>

<?php settings_errors(); ?>

<form action="options.php" method="post">
<?php
	// inject hidden input tags of option_group
	settings_fields( 'worldintw-theme-support-options-group' ); //settings_fields( $option_group )

	// show setting sections of page 
	do_settings_sections( 'worldintw_theme_support' ); //do_settings_sections( $page )

	submit_button();
?>
</form>

