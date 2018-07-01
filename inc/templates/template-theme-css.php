<?php settings_errors(); ?>

<form id="custom-css-submit-form" action="options.php" method="post">
<?php
	// inject hidden input tags of option_group
	settings_fields( 'worldintw-theme-css-options-group' ); //settings_fields( $option_group )

	// show setting sections of page 
	do_settings_sections( 'worldintw_css' ); //do_settings_sections( $page )

	submit_button();
?>
</form>

