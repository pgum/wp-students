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
	 /*AJAX on click events to approve and remove pending players*/
	 $(function(){
	 	$('students-approve-player').on('click', function(){
	 		var studentId= $(this).attr('x-student-id');
	 		$.post({
	 			url: ajaxurl,
	 			data: {'action': 'student_approve', 'student_id': studentId},
	 			success: function(data){ console.log(data); $('#students-id-'+playerId).fadeOut(800, function(){$(this).remove();});}
	 		});
	 	});
	 	$('.students-remove-player').on('click', function(){
	 		var choice= confirm("Are you sure you want to remove pending student data?\n(Students will have to register again)");
	 		if(choice){
	 			var studentId= $(this).attr('x-student-id');
	 			$.post({
	 				url: ajaxurl,
	 				data: {'action': 'student_rejectr', 'student_id': studentId},
		 			success: function(data){ console.log(data); $('#students-id-'+playerId).fadeOut(800, function(){$(this).remove();});}
	 			});
	 		}
	 	});
	 });
})( jQuery );
