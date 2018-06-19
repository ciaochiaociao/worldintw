jQuery(document).ready( function($) {

	var frame;

	// Media Uploader for profile picture uploading
	$('#upload-button').on('click', function(e) {
		e.preventDefault();
		if (frame) {
			frame.open();
			return;
		}

		// Create a media uploader window object
		frame = wp.media.frames.file_frame = wp.media({
			title: 'Select Your Profile Picture',
			button: {
				text: 'Choose This Picture'
			},
			mutiple: false
		});

		// Once selected
		frame.on('select', function(){
			// Store the selected file to attachment
			attachment = frame.state().get('selection').first().toJSON();

			// Change value of input tag of name profile_picture for the storing of data
			$('#profile-picture').val(attachment.url);
			
			// Dynamically change preview once selected
			$('#profile-picture-preview').attr('src', attachment.url);
			$('#sidebar-profile-picture-preview').css('background-image', 'url(' + attachment.url + ')');

		});

		frame.open();
	});
});