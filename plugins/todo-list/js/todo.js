/* JQuery
------------------------------------- */
console.log('Scripting...');

jQuery(document).ready(function ($) {

    jQuery('.form__wrapper').on('click', function () {
        jQuery(this).addClass('active');
    });	

	/* Form Actions
	---------------------------------------------------*/

	//Prevent standard form submission
	jQuery('#form').on('submit', function(e){
		e.preventDefault();
	});
	
	var ajaxUrl = '/wp-admin/admin-ajax.php';

	//Add Task
	jQuery('.add').on('click', function(e) {
		e.preventDefault();

		var formData = new FormData(document.getElementById('form'));
		formData.append('action', 'add_task');

		jQuery.ajax({
			type:'POST',
			url: ajaxUrl,
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
		}).done(function(response) {
			location.reload(true);
		});
	});

	jQuery('.add').on('keypress', function (e) {
		if (e.key === 'Enter') {
			var formData = new FormData(document.getElementById('form'));
			formData.append('action', 'add_task');
			var ajaxUrl = '/wp-admin/admin-ajax.php';

			jQuery.ajax({
				type:'POST',
				url: ajaxUrl,
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
			}).done(function(response) {
				console.log(response);
				location.reload(true);
			});
		}
	});

	// jQuery('.addEnter').on('keypress', function (e) {
	// 	if (e.key === 'Enter') {
	// 		var formData = new FormData(document.getElementById('form'));
	// 		jQuery.ajax({
	// 			type:'POST',
	// 			url: "/wp-content/plugins/todo-list/actions/storage.php",
	// 			data:formData,
	// 			cache:false,
	// 			contentType: false,
	// 			processData: false,
	// 			}).done(function() {
	// 				location.reload(true);
	// 		});
	// 	}
	// });

	// Update tasks
	jQuery('#update').on('click', function(e) {
		e.preventDefault();

		var formData = new FormData(document.getElementById('form'));
		jQuery.ajax({
			method: "POST",
			url: "/wp-content/plugins/todo-list/actions/update.php",
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			}).done(function() {
				location.reload(true);
		});
	});

	// jQuery('#update').on('keypress', function (e) {
	// 	if (e.key === 'Enter') {
	// 		var formData = new FormData(document.getElementById('form'));
	// 		jQuery.ajax({
	// 			method: "POST",
	// 			url: "/wp-content/plugins/todo-list/actions/update.php",
	// 			data:formData,
	// 			cache:false,
	// 			contentType: false,
	// 			processData: false,
	// 			}).done(function() {
	// 				location.reload(true);
	// 		});
	// 	}
	// });

	//Uncheck all tasks
	jQuery('#clear').on('click', function(e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById('form'));
		jQuery.ajax({
			method: "POST",
			url: "/wp-content/plugins/todo-list/actions/clear.php",
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			}).done(function() {
				location.reload(true);
		});
	});

	jQuery('#clear').on('keypress', function (e) {
		if (e.key === 'Enter') {
			var formData = new FormData(document.getElementById('form'));
			jQuery.ajax({
				method: "POST",
				url: "/wp-content/plugins/todo-list/actions/clear.php",
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				}).done(function() {
					location.reload(true);
			});
		}
	});

	//Delete selected task
	jQuery('.deleteItem').on('click', function(e) {
		e.preventDefault();

		var taskId = jQuery(this).data('id');

		if(!taskId) {
            alert('Task ID missing!');
            return;
        }
		
		if(confirm('Warning! This will delete the selected task!\nAre you sure?')) {
			jQuery.ajax({
				url: ajaxUrl,
				method: 'POST',
				data: {
					action: 'delete_task',
					id: taskId
				},
				dataType: 'json'
			}).done(function(response) {
				if (response.success) {
					location.reload(true);
				} else {
					alert('Error: ' + response.data);
				}
			});
		}
	});

	jQuery('.deleteItem').on('keypress', function (e) {
		if (e.key === 'Enter') {
			e.preventDefault();
			
			if(confirm('Warning! This will delete the selected task!\nAre you sure?')) {
				jQuery.ajax({
					url: ajaxUrl,
					method: 'POST',
					data: {
						action: 'delete_task',
						id: taskId
					},
					dataType: 'json'
				}).done(function(response) {
					if (response.success) {
						location.reload(true);
					} else {
						alert('Error: ' + response.data);
					}
				});
			}
		}
	});

	//Delete all tasks
	jQuery('#delete').on('click', function(e) {
		e.preventDefault();
		if(confirm("Warning! This will delete all tasks!\nAre you sure?")) {
			jQuery.ajax({
				method: "POST",
				url: "/wp-content/plugins/todo-list/actions/deletion.php",
				}).done(function() {
					location.reload(true);
			});
		}
	});

	jQuery('#delete').on('keypress', function (e) {
		if (e.key === 'Enter') {
			var formData = new FormData(document.getElementById('form'));
			jQuery.ajax({
				method: "POST",
				url: "/wp-content/plugins/todo-list/actions/delete.php",
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				}).done(function() {
					location.reload(true);
			});
		}
	});

	/* DOM Manipulations
	------------------------------------------------------*/

	//Toggle Theme
	jQuery('#switch').on('click', function() {
		jQuery(this).find('label').toggleClass('theme');
		jQuery('.btn').toggleClass('theme');
		jQuery('#download').toggleClass('theme');
		jQuery('input[type="checkbox"]').toggleClass('theme');
	});

	jQuery('#switch').on('keypress', function(e) {
		if (e.key === 'Enter') {
			jQuery(this).find('label').toggleClass('theme');
			jQuery('.btn').toggleClass('theme');
			jQuery('#download').toggleClass('theme');
			jQuery('input[type="checkbox"]').toggleClass('theme');
		}
	});

	//Change value of checkboxes if checked or not
	jQuery('.unchecked').attr('value', '0');
	jQuery('.checked').attr('value', '1');

	//Change classes of checkboxes and task names
	jQuery('.tick').on('click', function(e) {
		e.preventDefault();
		if(jQuery(this).hasClass('checked')) {
			jQuery(this).removeClass('checked');
			jQuery(this).addClass('unchecked');
			jQuery(this).parent().siblings('.task__name').find('.update').removeClass('crossed');
		} else {
			jQuery(this).addClass('checked');
			jQuery(this).removeClass('unchecked');
			jQuery(this).parent().siblings('.task__name').find('.update').addClass('crossed');
		}
		jQuery('.unchecked').attr('value', '0');
		jQuery('.checked').attr('value', '1');
	});

	jQuery('.tick').on('keypress', function(e) {
		if (e.key === 'Enter') {
			if(jQuery(this).hasClass('checked')) {
				jQuery(this).removeClass('checked');
				jQuery(this).addClass('unchecked');
				jQuery(this).parent().siblings('.task__name').find('.update').removeClass('crossed');
			} else {
				jQuery(this).addClass('checked');
				jQuery(this).removeClass('unchecked');
				jQuery(this).parent().siblings('.task__name').find('.update').addClass('crossed');
			}
			jQuery('.unchecked').attr('value', '0');
			jQuery('.checked').attr('value', '1');
		}
	});

	//Count Number of checked boxes & change status
	var tasksTotal = jQuery('.checkbox__wrapper').length;
	var tasksCompleted = jQuery('.tick.checked').length;
	var tasksRemaining = tasksTotal - tasksCompleted;

	//Change status message based on number of tasks remaining
	if(tasksTotal == 0) {
		jQuery('.btn').hide();
		jQuery('#add').show();
		document.getElementById('tasksRemaining').innerHTML = 'You have no tasks.';
	} else if(tasksRemaining == 0) {
		document.getElementById('tasksRemaining').innerHTML = 'Good Job...' + ' You\'re done!';
	} else if(tasksRemaining == 1) {
		jQuery('.btn').show();
		document.getElementById('tasksRemaining').innerHTML = 'Almost there... ' + tasksRemaining + ' task left!';
	} else {
		jQuery('.btn').show();
		document.getElementById('tasksRemaining').innerHTML = 'Task overload... ' + tasksRemaining + ' tasks left!';
	}
});