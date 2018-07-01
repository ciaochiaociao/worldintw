jQuery(document).ready(function($){

	$('#custom-css-submit-form').submit(function() {
		$('#submit-for-custom-css').val( editor.session.getValue());
	});

});


var editor = ace.edit("editor"); //Hoisting
editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/css");