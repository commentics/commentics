/* Initialise the FlexNav menu */
$(document).ready(function() {
	$(".flexnav").flexNav({
		"animationSpeed": 300,
		"transitionOpacity": false,
		"calcItemWidths": true
	});
});

/* When pressing Enter inside filter fields, submit the form */
$(document).ready(function() {
	$('.filter').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#filter').trigger('click');
		}
	});
});

/* When top checkbox is selected, select all checkboxes */
$(document).ready(function() {
	$('table thead input:checkbox').change(function() {
		if ($('table thead input:checkbox').is(':checked')) {
			$('table tbody input:checkbox').prop('checked', true);
		} else {
			$('table tbody input:checkbox').prop('checked', false);
		}
	});
});

/* When all checkboxes are selected, select top checkbox */
$(document).ready(function() {
	$('table tbody input:checkbox').change(function() {
		var all_checked = true;

		$('table tbody input:checkbox').each(function() {
			if (!$(this).is(':checked')) {
				all_checked = false;
			}
		});

		if (all_checked) {
			$('table thead input:checkbox').prop('checked', true);
		} else {
			$('table thead input:checkbox').prop('checked', false);
		}
	});
});

/* Show a password strength indicator for better security */
$(document).ready(function() {
	$('input[name="password_1"]').keyup(function() {
		var password = $('input[name="password_1"]').val();

		password = $.trim(password);

		var description = [];

		description[0] = '';
		description[1] = 'Very Weak';
		description[2] = 'Weak';
		description[3] = 'Fair';
		description[4] = 'Good';
		description[5] = 'Strong';
		description[6] = 'Strongest';

		var score = 0;

		// if password is bigger than 0 give 1 point
		if (password.length > 0) {
			score++;
		}

		// if password bigger than 6 give 1 point
		if (password.length > 6) {
			score++;
		}

		// if password has both lowercase and uppercase characters give 1 point
		if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
			score++;
		}

		// if password has at least one number give 1 point
		if (password.match(/\d+/)) {
			score++;
		}

		// if password has at least one special character give 1 point
		if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
			score++;
		}

		// if password bigger than 12 give 1 point
		if (password.length > 12) {
			score++;
		}

		$('#password_description').html(description[score]);

		$('#password_strength').removeClass();

		$('#password_strength').addClass('strength_' + score);
	});
});

/* Convert certain inputs to jQuery UI datepicker */
$(document).ready(function() {
	$('.datepicker').datepicker({
		dateFormat: 'yy-mm-dd'
	});
});

/* Convert certain inputs to jQuery UI tabs */
$(document).ready(function() {
	$('#tabs').tabs();
});

/* Add a divider after certain fields */
$(document).ready(function() {
	$('.divide_after').after('<div class="fieldset"><label></label></div>');
});