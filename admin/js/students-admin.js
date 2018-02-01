(function( $ ) {
	'use strict';
 	$(function(){
		$('.students-approve-player').on('click', function(){
	 		var studentId= $(this).attr('x-student-id');
	 		$.post({ url: ajaxurl, data: {'action': 'students_approve', 'student_id': studentId},
	 						success: function(data){ $('#students-id-'+studentId).fadeOut(800, function(){$(this).remove();});} });
	 	});
	 	$('.students-remove-player').on('click', function(){
	 		var choice= confirm('Are you sure you want to remove pending student data?\n(Students will have to register again)');
	 		if(choice){
	 			var studentId= $(this).attr('x-student-id');
	 			$.post({ url: ajaxurl, data: {'action': 'students_reject', 'student_id': studentId},
		 						success: function(data){ $('#students-id-'+studentId).fadeOut(800, function(){$(this).remove();});} });
	 		}
	 	});
	});
	 /*Table editable cell UI and ajax call on button OK click*/
	$(function(){
		$(this).on('click', '.students-update-btn', function(){
			var fieldName= $(this).attr('x-field');
			var inputVal = $(this).parent().children('.students-input').val();
			var studentId= $(this).attr('x-student-id');
			console.log('OK button clicked: studentId:'+studentId+' fieldName:'+fieldName+' new value:'+inputVal);
			$.post({ url: ajaxurl, data: {'action': 'students_update', 'student_id': studentId, 'field': fieldName, 'value': inputVal},
				success: function(data){
					//console.log(data);
					$(this).parent().prev().removeClass('students-hidden').addClass('students-updated').text(inputVal);
					$(this).parent().prev().delay(2000).queue(function(){ $(this).removeClass('students-updated').dequeue(); });
					$(this).parent().addClass('students-hidden').text('');	console.log('done!');//}
			});
		});
		//click to create input and button
		$(this).on('click', '.students-editable', function(){
			var cellValue= $(this).text();
			var fieldName= $(this).attr('x-field');
			var studentId= $(this).parents('.students-card-editable').attr('x-student-id');
			//console.log('cellValue:'+cellValue+' fieldName:'+fieldName+' studentId:'+studentId);
			var fieldRender= {
				isCurrent:'<select class="students-input"><option value="0" '+(cellValue===1? '':'selected')+'>Former</option><option value="1" '+(cellValue===0? '':'selected')+'>Current</option></select>',
				stuText:'<textarea class="students-input">'+cellValue+'</textarea>',
				stuGossip:'<textarea class="students-input">'+cellValue+'</textarea>'	};
			var fieldDefault= '<input class="students-input" value="'+cellValue+'"/>';
			var okButton= '<a href="#sid-'+studentId+'" class="students-update-btn button button-secondary" x-student-id="'+studentId+'" x-field="'+fieldName+'">OK</a>';
			var toRender= ((fieldRender[fieldName] === undefined) ? fieldDefault : fieldRender[fieldName])+okButton;
			$(this).next().html(toRender).removeClass('students-hidden');
			$(this).addClass('students-hidden');
		});
	});
})( jQuery );
