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
	 $( document ).ready(function() {
		 jQuery('#aps_copy_to_clip_id').on('click',function(){
			var sampleTextarea = document.createElement("textarea");
			document.body.appendChild(sampleTextarea);
			sampleTextarea.value = jQuery('#aps_shortcode_id').val(); //save main text in it
			sampleTextarea.select(); //select textarea contenrs
			document.execCommand("copy");
			document.body.removeChild(sampleTextarea);
			$('.aps-text-copied-msg').fadeIn(1000);
			$('.aps-text-copied-msg').fadeOut(1000);
		 });
		 $(".aps-layout-opt").on("click", function () {
			 var current_id = $(this).attr('id');
			 $(".aps-layout-opt-img").each(function () {
				 $(this).removeClass('active');
				 if ($(this).data('layout') === current_id) {
					 $(this).addClass('active');
				 }
			 });
		 });
	 });

})( jQuery );
