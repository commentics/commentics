<div class="cmtx_notify_block">
	<a href="#" title="<?php echo $lang_title_notify; ?>"><span class="cmtx_icon cmtx_notify_icon"></span> <span class="cmtx_notify_text"><?php echo $lang_text_notify; ?></span></a>
</div>

<script>
// <![CDATA[
$(document).ready(function() {
	$('.cmtx_notify_block a').click(function(e) {
		e.preventDefault();

		$('.cmtx_message, .cmtx_error, .cmtx_subscribe_row').remove();

		$('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

		$('.cmtx_wait_for_user').show();

		$('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_upload_row, .cmtx_image_row, .cmtx_rating_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_checkbox_container, .cmtx_button_row').hide();

		if ($('input[name="cmtx_subscribe"]').val() == '') {
			cmtx_heading_text = $('.cmtx_form_heading').text();
		}

		$('.cmtx_form_heading').fadeOut(500, function() {
			$('.cmtx_form_heading').text('<?php echo $lang_heading_notify; ?>').fadeIn(3000);
		});

		var notify_button = '';

		notify_button += '<div class="cmtx_row cmtx_button_row cmtx_subscribe_row cmtx_clear">';

			notify_button += '<div class="cmtx_col_2">';

				notify_button += '<div class="cmtx_container cmtx_submit_button_container">';

					notify_button += '<input type="button" id="cmtx_notify_button" class="cmtx_button cmtx_submit_button" value="<?php echo $lang_button_notify; ?>" title="<?php echo $lang_button_notify; ?>">';

				notify_button += '</div>';

			notify_button += '</div>';

			notify_button += '<div class="cmtx_col_10"></div>';

		notify_button += '</div>';

		$('.cmtx_button_row').after(notify_button);

		$('input[name="cmtx_subscribe"]').val('1');

		$('#cmtx_form').before('<div class="cmtx_message cmtx_message_info cmtx_message_notify">' + '<?php echo $lang_text_notify_info; ?>' + ' ' + '<a href="#" title="<?php echo $lang_title_cancel_notify; ?>"><?php echo $lang_link_cancel; ?></a></div>');

		$('html, body').animate({
			scrollTop: $('#cmtx_form_container').offset().top
		}, 1000);

		$('.cmtx_message_notify').fadeIn(2000);
	});

	$('html, body').on('click', '.cmtx_message_notify a', function(e) {
		e.preventDefault();

		cmtx_cancel_notify();
	});

	$('html, body').on('click', '#cmtx_notify_button', function(e) {
		e.preventDefault();

		// Find any disabled inputs and remove the "disabled" attribute
		var disabled = $('#cmtx_form').find(':input:disabled').removeAttr('disabled');

		// Serialize the form
		var serialized = $('#cmtx_form').serialize();

		// Re-disable the set of inputs that were originally disabled
		disabled.attr('disabled', 'disabled');

		var request = $.ajax({
			type: 'POST',
			cache: false,
			url: '<?php echo $commentics_url; ?>frontend/index.php?route=part/notify/notify',
			data: serialized + '&cmtx_page_id=' + encodeURIComponent('<?php echo $page_id; ?>') + $('#cmtx_hidden_data').val(),
			dataType: 'json',
			beforeSend: function() {
				$('#cmtx_notify_button').val('<?php echo $lang_button_processing; ?>');

				$('#cmtx_notify_button').prop('disabled', true);
			}
		});

		request.always(function() {
			$('#cmtx_notify_button').val('<?php echo $lang_button_notify; ?>');

			$('#cmtx_notify_button').prop('disabled', false);
		});

		request.done(function(response) {
			$('.cmtx_message:not(.cmtx_message_notify), .cmtx_error').remove();

			$('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

			if (response['result']['success']) {
				$('#cmtx_answer, #cmtx_securimage').val('');

				$('#cmtx_securimage_refresh').trigger('click');

				if (typeof grecaptcha != 'undefined') {
					grecaptcha.reset();
				}

				cmtx_cancel_notify();

				$('#cmtx_form').before('<div class="cmtx_message cmtx_message_success">' + response['result']['success'] + '</div>');

				$('.cmtx_message_success').fadeIn(1500).delay(3000).fadeOut(1000);
			}

			if (response['result']['error']) {
				if (response['error']['name']) {
					$('#cmtx_name').addClass('cmtx_field_error');

					$('#cmtx_name').after('<span class="cmtx_error">' + response['error']['name'] + '</span>');
				}

				if (response['error']['email']) {
					$('#cmtx_email').addClass('cmtx_field_error');

					$('#cmtx_email').after('<span class="cmtx_error">' + response['error']['email'] + '</span>');
				}

				if (response['error']['answer']) {
					$('#cmtx_answer').addClass('cmtx_field_error');

					$('#cmtx_answer').after('<span class="cmtx_error">' + response['error']['answer'] + '</span>');
				}

				if (response['error']['recaptcha']) {
					$('#g-recaptcha').after('<span class="cmtx_error">' + response['error']['recaptcha'] + '</span>');

					grecaptcha.reset();
				}

				if (response['error']['securimage']) {
					$('#cmtx_securimage').addClass('cmtx_field_error');

					$('#cmtx_securimage').after('<span class="cmtx_error">' + response['error']['securimage'] + '</span>');

					$('#cmtx_securimage_refresh').trigger('click');

					$('#cmtx_securimage').val('');
				}

				$('#cmtx_form').before('<div class="cmtx_message cmtx_message_error">' + response['result']['error'] + '</div>');

				$('.cmtx_message_error, .cmtx_container_error, .cmtx_error').fadeIn(2000);
			}

			if (response['question']) {
				$('#cmtx_question').text(response['question']);
			}

			$('html, body').animate({
				scrollTop: $('#cmtx_form_container').offset().top
			}, 1000);
		});
	});

	function cmtx_cancel_notify() {
		$('.cmtx_message:not(.cmtx_message_notify), .cmtx_error, .cmtx_subscribe_row').remove();

		$('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

		$('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_upload_row, .cmtx_rating_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_checkbox_container, .cmtx_button_row').show();

		$('#cmtx_comment').addClass('cmtx_comment_field_active');

		$('.cmtx_form_heading').fadeOut(250, function() {
			$('.cmtx_form_heading').text(cmtx_heading_text).fadeIn(3000);
		});

		$('input[name="cmtx_subscribe"]').val('');

		$('.cmtx_message_notify').fadeOut(1500);
	}
});
// ]]>
</script>