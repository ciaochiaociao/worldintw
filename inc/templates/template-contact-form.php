<?php settings_errors(); ?>

<form action="options.php" method="post">
<?php
	// inject hidden input tags of option_group
	settings_fields( 'worldintw-contact-form-options-group' ); //settings_fields( $option_group )

	// show setting sections of page 
	do_settings_sections( 'worldintw_contact_form' ); //do_settings_sections( $page )

	submit_button();
?>
</form>

