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
	 	$('.students-approve-player').on('click', function(){
	 		var studentId= $(this).attr('x-student-id');
			console.log('kurwa1');
	 		$.post({
	 			url: ajaxurl,
	 			data: {'action': 'students_approve', 'student_id': studentId},
	 			success: function(data){ console.log(data); $('#students-id-'+studentId).fadeOut(800, function(){$(this).remove();});}
	 		});
	 	});
	 	$('.students-remove-player').on('click', function(){
			console.log('kurwa2');
	 		var choice= confirm("Are you sure you want to remove pending student data?\n(Students will have to register again)");
	 		if(choice){
	 			var studentId= $(this).attr('x-student-id');
	 			$.post({
	 				url: ajaxurl,
	 				data: {'action': 'students_reject', 'student_id': studentId},
		 			success: function(data){ console.log(data); $('#students-id-'+studentId).fadeOut(800, function(){$(this).remove();});}
	 			});
	 		}
	 	});
	 });
	 /*Table editable cell UI and ajax call on button OK click*/

	$(function(){
		$('.students-editable-f').each(function(){
			var editedCell= $(this);
			//dynamic update button
			$(this).on('click', '.students-update-btn', function(){
				//var inputVal = $(this).prev('input').val();
				var fieldName= $(this).attr('x-field');
				var inputVal;
				if(fieldName != 'stuText'){
					var inputVal = $(this).parent().children('input').val();
				}else{
					var inputVal = $(this).parent().children('textarea').val();
				}
				var studentId= $(this).attr('x-student-id');
			$.post({
				url: ajaxurl,
				data: {'action': 'students_update', 'student_id': studentId, 'field': fieldName, 'value': inputVal},
				success: function(data){
					console.log(data);
					editedCell.addClass('students-cell-updated').delay(2000).queue(function(){ $(this).removeClass('students-cell-updated').dequeue(); });}
			});
				$(this).parent()
				.removeClass('students-editable-e')
				.addClass('students-editable')
				.html(inputVal);
			});
			//click to create input and button
			$(this).on('click', '.students-editable', function(){
				var cellValue= $(this).text();
				var fieldName= $(this).attr('x-field');
				var studentId= $(this).attr('x-student-id');
				if(fieldName != 'stuText'){
	$(this).removeClass('students-editable').addClass('students-editable-e')
.html('<input class="students-input" value="'+cellValue+'"/><a href="#sid-'+studentId+'" class="students-update-btn button button-secondary" x-student-id="'+studentId+'" x-field="'+fieldName+'">OK</a>');
}else{
	$(this).removeClass('students-editable').addClass('students-editable-e')
.html('<textarea class="students-input">'+cellValue+'</textarea><a href="#sid-'+studentId+'" class="students-update-btn button button-secondary" x-student-id="'+studentId+'" x-field="'+fieldName+'">OK</a>');
}
			});
		});
	});
})( jQuery );
