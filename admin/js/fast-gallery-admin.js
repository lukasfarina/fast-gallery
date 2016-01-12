(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


	// On document ready
	$(function () {
		var gallery = wp.media.frames.file_frame = wp.media({
			title: 'Selecione uma Imagem',
			button: {
				text: 'Inserir'
			},
			multiple: false
		});

		var fastGalleryContainer = $('.fast-gallery-container');

		// Gallery: On Select
		gallery.on('select', function() {
			var attchGalllery = gallery.state().get('selection').first().toJSON(),
					url = attchGalllery.url,
					id = attchGalllery.id;

			// Get Current Item
			var current = fastGalleryContainer.find('.current-item');

			// Change Image
			current.find('.fast-gallery-image-container').css('background-image', 'url(' + url + ')');

			// Change Image Id
			current.find('.fast-gallery-image-id').val(id);

			// Remove Class Current Item
			current.removeClass('current-item');
		});

        // Gallery: On Cancel
        gallery.on('escape', function (e) {
            var _current = fastGalleryContainer.find('.current-item');

            if(_current.find('.fast-gallery-image-id').val() == '') {
                fastGalleryContainer.find('.current-item').remove();
            }

            _current.removeClass('current-item');
        });

		// Gallery: On Change Item Image
		fastGalleryContainer.on('click', '.fast-gallery_change_image', function (e) {
			e.preventDefault();
			$(this).closest('li').addClass('current-item');
			gallery.open();
		});

		// Gallery: On Add New Item
		fastGalleryContainer.on('click', '.fast-gallery_add_image', function (e) {
			e.preventDefault();

			var html = $('#item-template').html();

			$('.fast-gallery-container > li:last-child').before(html);

            // Open Gallery
            gallery.open();
        });

		// Remove campos para galeria dinamica
		fastGalleryContainer.on('click', '.fast-gallery_remove_image', function(e) {
			e.preventDefault();
			$(this).closest('li').remove();
		});
	});

})( jQuery );
