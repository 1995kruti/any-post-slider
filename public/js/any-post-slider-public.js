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
	var image_dir_url = any_post_slider_public.aps_image_dir;
	var aps_scroll_to_slide = any_post_slider_public.aps_scroll_to_slide;
	var asp_layout_option = $("#display-layout-id").val();
	var aps_owl_slider = $('#aps_slider');

	aps_owl_slider.owlCarousel({
		loop:true,
		margin:5,
		nav:true,
		navClass: ['btn button owl-prev','btn button owl-next'],
		items : asp_layout_option,
		itemsDesktop : [1199,asp_layout_option],
		itemsDesktopSmall : [979,asp_layout_option],
		mouseDrag: true,
		touchDrag: true,
		navText: ["<span><img src="+image_dir_url+'/back.png;'+" /></span>", "<span><img src="+image_dir_url+'/next.png;'+" /></span>"],
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:asp_layout_option,
				nav:false
			},
			1000:{
				items:asp_layout_option,
				nav:true,
				loop:false
			}
		}
	});
	
	// add slide effect on scroll if aps_scroll_to_slide enabled from settings
	if(aps_scroll_to_slide == 1){
		aps_owl_slider.on('mousewheel', '.owl-stage', function (e) {
				
				
				if (e.originalEvent.deltaY>0) {
					aps_owl_slider.trigger('next.owl');
				} else {
					aps_owl_slider.trigger('prev.owl');
				}
				e.preventDefault();
			
		});
	}

})( jQuery );
