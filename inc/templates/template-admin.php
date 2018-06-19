<h1>Sidebar Options</h1>

<?php settings_errors(); ?>
<?php
	$profilePicture = esc_attr( get_option( 'profile_picture' ) );
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	$description = esc_attr( get_option( 'description' ) );
	$fullName = $firstName . ' ' . $lastName;
?>
<div class="worldintw-sidebar-preview">
	<div class="worldintw-sidebar">
		<div class="img-container">
			<div id="sidebar-profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $profilePicture ?>);">
			</div>
		</div>
		<h1 class="worldintw-sidebar-username"><?php print $fullName; ?></h1>
		<h2 class="worldintw-sidebar-description"><?php print $description; ?></h2>
		<div class="icons-wrapper"></div>
	</div>
</div>

<form action="options.php" method="post" class="worldintw-general-form">
<?php
	// inject hidden input tags of option_group of worldintw-options-group for updating
	settings_fields( 'worldintw-options-group' ); //settings_fields( $option_group )

	// show setting sections of page 'worldintw'
	do_settings_sections( 'worldintw' ); //do_settings_sections( $page )

	submit_button();
?>
</form>

