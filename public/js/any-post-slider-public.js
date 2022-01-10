(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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
	var asp_layout_option = $("#display-layout-id").val();
	var additional_param = " ";
	if(asp_layout_option == 1){
		additional_param = {
			singleItem:true
		}
	}

	if(asp_layout_option == 2){
		additional_param = {
			items :3,
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [979,2]
		}
	}

	if(asp_layout_option == 3){
		additional_param = {
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3]
		}
	}


	
	$('#aps_slider').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		dots: true,
		additional_param,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:3,
				nav:true,
				loop:false
			}
		}
	})
	

})( jQuery );
