jQuery(function($) {
	$('#ccs-custom-nav-menus-submit').click(function(e) {
		e.preventDefault();

		var checked = $('#ccs-custom-nav-menus li :checked'),
			button = $(this),
			posts = [];

		/**
		 * Grab values of all checked checkboxes
		 * Their values are custom menu item CPT IDs
		 */
		checked.each(function() {
			posts.push($(this).val());
		});

		/**
		 * Primary functionality - ajax call to retrieve new Menu Structure HTML
		 * and insert it into Menu Structure
		 */

		// Show spinner and temporarily lock the button
		$('#ccs-custom-menu-items .spinner').show();
		button.prop('disabled', true);

		$.ajax({
			type: 'POST',
			url: NMAS.ajaxUrl,
			data: {
				action: 'ccs_custom_nav_menus',
				post_ids: posts
			},
			success: function(response) {
				$('#menu-to-edit').append(response);

				// Hide spinner and unlock the button
				$('#ccs-custom-menu-items .spinner').hide();
				button.prop('disabled', false);
			}
		});
	});
});