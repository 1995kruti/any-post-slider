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
	var aps_sliderarrows = any_post_slider_public.aps_sliderarrows;
	var aps_sliderdots = any_post_slider_public.aps_sliderdots;
	var aps_sliderautoplay = any_post_slider_public.aps_sliderautoplay;
	var aps_sliderspeed = any_post_slider_public.aps_sliderspeed;
	var aps_equalheight = any_post_slider_public.aps_equalheight;


	// get the layout option from different templates
	var asp_layout_option = $("#display-layout-id").val();
	var aps_owl_slider = $('.aps-slider');

	// set slide arrow navigation param
	var aps_nav = true;
	var desktoparrow = false;
	var mobilearrow = false;
	if(aps_sliderarrows == 'yes'){
		aps_nav = true;
		desktoparrow = true;
		mobilearrow = true;
	}else if(aps_sliderarrows == 'no'){
		aps_nav = false;
		desktoparrow = false;
		mobilearrow = false;
	}else if(aps_sliderarrows == 'des'){
		desktoparrow = true;
		mobilearrow = false;
	}
	
	// set autoplay param
	var aps_autoplay = false;
	if(aps_sliderautoplay == 'yes'){
		aps_autoplay = true;
	}

	// set autoplay speed param
	var aps_speed = 3000;
	if(aps_sliderspeed){
		aps_speed = aps_sliderspeed;
	}

	// set dots param
	var aps_dots = false;
	if(aps_sliderdots == "yes"){
		aps_dots = true;
	}

	// initialize the owlcarousel
	aps_owl_slider.owlCarousel({
		loop:true,
		margin:20,
		dots: aps_dots,
		nav:aps_nav,
		navClass: ['btn button owl-prev','btn button owl-next'],
		items : asp_layout_option,
		itemsDesktop : [1199,asp_layout_option],
		itemsDesktopSmall : [979,asp_layout_option],
		mouseDrag: true,
		touchDrag: true,
		autoplay: aps_autoplay,
		autoplayTimeout:aps_speed,
		navText: ["<span><img src="+image_dir_url+'/back.png'+" /></span>", "<span><img src="+image_dir_url+'/next.png'+" /></span>"],
		responsive:{
			0:{
				items:1,
				nav:mobilearrow
			},
			600:{
				items:asp_layout_option,
				nav:mobilearrow
			},
			1000:{
				items:asp_layout_option,
				nav:desktoparrow
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

	//Equal Height for the slider images
	if(aps_equalheight == 'yes'){
		(function () {
		  	aps_equalHeight(false);
		})();
		window.onresize = function(){
		  aps_equalHeight(true);
		}
		 
		function aps_equalHeight(aps_resize) {
		  	var aps_elements = jQuery(".aps-slider .item img"),
		      	aps_allHeights = [],
		      	apsi = 0;
		  	if(aps_resize === true){
		    	for(apsi = 0; apsi < aps_elements.length; apsi++){
		      		aps_elements[apsi].style.height = 'auto';
		    	}
		  	}
		  	for(apsi = 0; apsi < aps_elements.length; apsi++){
		    	var elementHeight = aps_elements[apsi].clientHeight;
		    	aps_allHeights.push(elementHeight);
		  	}
		  	for(apsi = 0; apsi < aps_elements.length; apsi++){
		    	aps_elements[apsi].style.height = Math.max.apply( Math, aps_allHeights) + 'px';
		    	if(aps_resize === false){
		      		aps_elements[apsi].className = aps_elements[apsi].className + " eq_height";
		    	}
		  	}
		}
	}

})( jQuery );
