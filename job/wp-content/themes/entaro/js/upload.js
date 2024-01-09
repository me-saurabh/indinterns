jQuery(document).ready(function($){

	var entaro_upload;
	var entaro_selector;

	function entaro_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		entaro_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( entaro_upload ) {
			entaro_upload.open();
			return;
		} else {
			// Create the media frame.
			entaro_upload = wp.media.frames.entaro_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			entaro_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = entaro_upload.state().get('selection').first();

				entaro_upload.close();
				entaro_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					entaro_selector.find('.entaro_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		entaro_upload.open();
	}

	function entaro_remove_file(selector) {
		selector.find('.entaro_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.entaro_upload_image_action .remove-image', function(event) {
		entaro_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.entaro_upload_image_action .add-image', function(event) {
		entaro_add_file(event, $(this).parent().parent());
	});

});