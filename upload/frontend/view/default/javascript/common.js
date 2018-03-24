/* Style the blank select options as placeholders */
$(document).ready(function() {
	selected = $('.cmtx_form_container select').find('option:selected');

	if (selected.val() == '') {
		$('.cmtx_form_container select').css('color', '#666');
		$('.cmtx_form_container select').children().css('color', 'black');
	}

	$('body').on('change', '.cmtx_form_container select', function () {
		if ($(this).find('option:selected').val() == '') {
			$(this).css('color', '#666');
			$(this).children().css('color', 'black');
		} else {
			$(this).css('color', 'black');
			$(this).children().css('color', 'black');
		}
	});
});

/* When the comment field gets focus, show some other fields */
$(document).ready(function() {
	$('#cmtx_comment').focus(function() {
		$(this).addClass('cmtx_comment_field_active');

		$('.cmtx_comment_container').addClass('cmtx_comment_container_active');

		$('.cmtx_wait_for_comment').fadeIn('slow');
	});
});

/* When the name or email field gets focus, show some other fields */
$(document).ready(function() {
	$('#cmtx_name, #cmtx_email').focus(function() {
		if ($('input[name="cmtx_subscribe"]').val() == '') {
			$('.cmtx_wait_for_user').fadeIn('slow');
		}
	});
});

/* Adds a BB Code tag for the simple non-dialog ones */
$(document).ready(function() {
	$('.cmtx_bb_code').click(function() {
		var bb_code = $(this).attr('data-cmtx-tag');

		if (bb_code) {
			bb_code = bb_code.split('|');

			if (bb_code[0] != 'dialog:') {
				if (typeof(bb_code[1]) === 'undefined') {
					cmtx_add_tag('', bb_code[0]);
				} else {
					cmtx_add_tag(bb_code[0], bb_code[1]);
				}
			}
		}
	});
});

/* Adds a smiley tag */
$(document).ready(function() {
	$('.cmtx_smilies_container .cmtx_smiley').click(function() {
		var smiley = $(this).attr('data-cmtx-tag');

		cmtx_add_tag('', smiley);
	});
});

/* Adds a tag (BB Code or Smiley) to the comment field */
function cmtx_add_tag(start, end) {
	var obj = document.getElementById('cmtx_comment');

	$('#cmtx_comment').focus();

	if (document.selection && document.selection.createRange) { // Internet Explorer
		selection = document.selection.createRange();

		if (selection.parentElement() == obj) {
			selection.text = start + selection.text + end;
		}
	} else if (typeof(obj) != 'undefined') { // Firefox
		var length = $('#cmtx_comment').val().length;
		var selection_start = obj.selectionStart;
		var selection_end = obj.selectionEnd;

		$('#cmtx_comment').val(obj.value.substring(0, selection_start) + start + obj.value.substring(selection_start, selection_end) + end + obj.value.substring(selection_end, length));
	} else {
		$('#cmtx_comment').val(start + end);
	}

	$('#cmtx_comment').trigger('keyup'); // update the counter

	$('#cmtx_comment').focus();
}

/* Show a dialog for the BB Code bullet */
$(document).ready(function() {
	$('.cmtx_bb_code_bullet').click(function() {
		$('#cmtx_dialog_bullet').dialog({
			modal: true,
			height: 'auto',
			width: 'auto',
			resizable: false,
			draggable: false,
			center: true,
			buttons: {
				'Insert': function() {
					var bb_code = $('.cmtx_bb_code_bullet').attr('data-cmtx-tag');

					bb_code = bb_code.split('|');

					var tag = '';

					var item_1 = $('#cmtx_dialog_bullet_field_1').val();
					var item_2 = $('#cmtx_dialog_bullet_field_2').val();
					var item_3 = $('#cmtx_dialog_bullet_field_3').val();
					var item_4 = $('#cmtx_dialog_bullet_field_4').val();
					var item_5 = $('#cmtx_dialog_bullet_field_5').val();

					var items = new Array(item_1, item_2, item_3, item_4, item_5);

					for (var i = 0; i < 5; i++) {
						var item = items[i];

						item = $.trim(item);

						if (item != null && item != '') {
							tag += bb_code[2] + item + bb_code[3] + '\r\n';
						}
					}

					if (tag != null && tag != '') {
						tag = bb_code[1] + '\r\n' + tag + bb_code[4];

						cmtx_add_tag('', tag);
					}

					$('#cmtx_dialog_bullet_field_1, #cmtx_dialog_bullet_field_2, #cmtx_dialog_bullet_field_3, #cmtx_dialog_bullet_field_4, #cmtx_dialog_bullet_field_5').val('');

					$(this).dialog('close');
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
		});

		$('button:first-of-type .ui-button-text').addClass('fa fa-check').text('');

		$('button:last-of-type .ui-button-text').addClass('fa fa-times').text('');

		$('#cmtx_dialog_bullet').dialog('open');

		return false;
	});
});

/* Show a dialog for the BB Code numeric */
$(document).ready(function() {
	$('.cmtx_bb_code_numeric').click(function() {
		$('#cmtx_dialog_numeric').dialog({
			modal: true,
			height: 'auto',
			width: 'auto',
			resizable: false,
			draggable: false,
			center: true,
			buttons: {
				'Insert': function() {
					var bb_code = $('.cmtx_bb_code_numeric').attr('data-cmtx-tag');

					bb_code = bb_code.split('|');

					var tag = '';

					var item_1 = $('#cmtx_dialog_numeric_field_1').val();
					var item_2 = $('#cmtx_dialog_numeric_field_2').val();
					var item_3 = $('#cmtx_dialog_numeric_field_3').val();
					var item_4 = $('#cmtx_dialog_numeric_field_4').val();
					var item_5 = $('#cmtx_dialog_numeric_field_5').val();

					var items = new Array(item_1, item_2, item_3, item_4, item_5);

					for (var i = 0; i < 5; i++) {
						var item = items[i];

						item = $.trim(item);

						if (item != null && item != '') {
							tag += bb_code[2] + item + bb_code[3] + '\r\n';
						}
					}

					if (tag != null && tag != '') {
						tag = bb_code[1] + '\r\n' + tag + bb_code[4];

						cmtx_add_tag('', tag);
					}

					$('#cmtx_dialog_numeric_field_1, #cmtx_dialog_numeric_field_2, #cmtx_dialog_numeric_field_3, #cmtx_dialog_numeric_field_4, #cmtx_numeric_bullet_field_5').val('');

					$(this).dialog('close');
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
		});

		$('button:first-of-type .ui-button-text').addClass('fa fa-check').text('');

		$('button:last-of-type .ui-button-text').addClass('fa fa-times').text('');

		$('#cmtx_dialog_numeric').dialog('open');

		return false;
	});
});

/* Show a dialog for the BB Code link */
$(document).ready(function() {
	$('.cmtx_bb_code_link').click(function() {
		$('#cmtx_dialog_link').dialog({
			modal: true,
			height: 'auto',
			width: 'auto',
			resizable: false,
			draggable: false,
			center: true,
			buttons: {
				'Insert': function() {
					var bb_code = $('.cmtx_bb_code_link').attr('data-cmtx-tag');

					bb_code = bb_code.split('|');

					var link = $.trim($('#cmtx_dialog_link_field_1').val());

					if (link != null && link != '' && link != 'http://') {
						var text = $.trim($('#cmtx_dialog_link_field_2').val());

						if (text != null && text != '') {
							var tag = bb_code[2] + link + bb_code[3] + text + bb_code[4];
						} else {
							var tag = bb_code[1] + link + bb_code[4];
						}

						cmtx_add_tag('', tag);
					}

					$('#cmtx_dialog_link_field_1').val('http://');

					$('#cmtx_dialog_link_field_2').val('');

					$(this).dialog('close');
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
		});

		var value = $('#cmtx_dialog_link_field_1').val();

		$('#cmtx_dialog_link_field_1').focus().val('').val(value);

		$('button:first-of-type .ui-button-text').addClass('fa fa-check').text('');

		$('button:last-of-type .ui-button-text').addClass('fa fa-times').text('');

		$('#cmtx_dialog_link').dialog('open');

		return false;
	});
});

/* Show a dialog for the BB Code email */
$(document).ready(function() {
	$('.cmtx_bb_code_email').click(function() {
		$('#cmtx_dialog_email').dialog({
			modal: true,
			height: 'auto',
			width: 'auto',
			resizable: false,
			draggable: false,
			center: true,
			buttons: {
				'Insert': function() {
					var bb_code = $('.cmtx_bb_code_email').attr('data-cmtx-tag');

					bb_code = bb_code.split('|');

					var email = $.trim($('#cmtx_dialog_email_field_1').val());

					if (email != null && email != '') {
						var text = $.trim($('#cmtx_dialog_email_field_2').val());

						if (text != null && text != '') {
							var tag = bb_code[2] + email + bb_code[3] + text + bb_code[4];
						} else {
							var tag = bb_code[1] + email + bb_code[4];
						}

						cmtx_add_tag('', tag);
					}

					$('#cmtx_dialog_email_field_1').val('');

					$('#cmtx_dialog_email_field_2').val('');

					$(this).dialog('close');
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
		});

		$('button:first-of-type .ui-button-text').addClass('fa fa-check').text('');

		$('button:last-of-type .ui-button-text').addClass('fa fa-times').text('');

		$('#cmtx_dialog_email').dialog('open');

		return false;
	});
});

/* Show a dialog for the BB Code image */
$(document).ready(function() {
	$('.cmtx_bb_code_image').click(function() {
		$('#cmtx_dialog_image').dialog({
			modal: true,
			height: 'auto',
			width: 'auto',
			resizable: false,
			draggable: false,
			center: true,
			buttons: {
				'Insert': function() {
					var bb_code = $('.cmtx_bb_code_image').attr('data-cmtx-tag');

					bb_code = bb_code.split('|');

					var image = $.trim($('#cmtx_dialog_image_field').val());

					if (image != null && image != '' && image != 'http://') {
						var tag = bb_code[1] + image + bb_code[2];

						cmtx_add_tag('', tag);
					}

					$('#cmtx_dialog_image_field').val('http://');

					$(this).dialog('close');
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
		});

		var value = $('#cmtx_dialog_image_field').val();

		$('#cmtx_dialog_image_field').focus().val('').val(value);

		$('button:first-of-type .ui-button-text').addClass('fa fa-check').text('');

		$('button:last-of-type .ui-button-text').addClass('fa fa-times').text('');

		$('#cmtx_dialog_image').dialog('open');

		return false;
	});
});

/* Show a dialog for the BB Code YouTube */
$(document).ready(function() {
	$('.cmtx_bb_code_youtube').click(function() {
		$('#cmtx_dialog_youtube').dialog({
			modal: true,
			height: 'auto',
			width: 'auto',
			resizable: false,
			draggable: false,
			center: true,
			buttons: {
				'Insert': function() {
					var bb_code = $('.cmtx_bb_code_youtube').attr('data-cmtx-tag');

					bb_code = bb_code.split('|');

					var video = $.trim($('#cmtx_dialog_youtube_field').val());

					if (video != null && video != '' && video != 'http://') {
						var tag = bb_code[1] + video + bb_code[2];

						cmtx_add_tag('', tag);
					}

					$('#cmtx_dialog_youtube_field').val('http://');

					$(this).dialog('close');
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
		});

		var value = $('#cmtx_dialog_youtube_field').val();

		$('#cmtx_dialog_youtube_field').focus().val('').val(value);

		$('button:first-of-type .ui-button-text').addClass('fa fa-check').text('');

		$('button:last-of-type .ui-button-text').addClass('fa fa-times').text('');

		$('#cmtx_dialog_youtube').dialog('open');

		return false;
	});
});

/* Update the comment counter whenever anything is entered */
$(document).ready(function() {
	$('#cmtx_comment').keyup(function(e) {
		var length = $(this).val().length;

		var maximum = $(this).attr('maxlength');

		$('#cmtx_counter').html(maximum - length);
	});
});

/* Simulate entering a comment on page load to update the counter in case it has default text */
$(document).ready(function() {
	$('#cmtx_comment').trigger('keyup');
});

/* Show a lightbox when clicking on the privacy link */
$(document).ready(function() {
	$('#cmtx_privacy_link').click(function(e) {
		e.preventDefault();

		$.colorbox({
			inline: true,
			href: '#cmtx_privacy_content',
			maxWidth: '80%',
			maxHeight: '50%',
			onClosed: function() {
				$('#cmtx_privacy_content').hide();
			},
			onOpen: function() {
				$('#cmtx_privacy_content').show();
			}
		});
	});
});

/* Show a lightbox when clicking on the terms link */
$(document).ready(function() {
	$('#cmtx_terms_link').click(function(e) {
		e.preventDefault();

		$.colorbox({
			inline: true,
			href: '#cmtx_terms_content',
			maxWidth: '80%',
			maxHeight: '50%',
			onClosed: function() {
				$('#cmtx_terms_content').hide();
			},
			onOpen: function() {
				$('#cmtx_terms_content').show();
			}
		});
	});
});

/* Allows the user to deselect the star rating */
$(document).ready(function() {
	$('input[type="radio"][name="cmtx_rating"]').on('click', function() {
		if ($(this).is('.cmtx_rating_active')) {
			$(this).prop('checked', false).removeClass('cmtx_rating_active');
		} else {
			$('input[type="radio"][name="cmtx_rating"].cmtx_rating_active').removeClass('cmtx_rating_active');

			$(this).addClass('cmtx_rating_active');
		}
	});
});

/* Image uploads */
$(document).ready(function() {
	if (typeof(cmtx_js_settings_form) != 'undefined') {
		if (cmtx_js_settings_form.enabled_upload) {
			$('#filer_input').filer({
				limit: cmtx_js_settings_form.maximum_upload_amount,
				maxSize: cmtx_js_settings_form.maximum_upload_size,
				extensions: ['jpg', 'jpeg', 'png', 'gif'],
				changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-text" style="margin-top:-6px"><span>' + cmtx_js_settings_form.lang_text_drag_and_drop + '</span></div></div></div>',
				showThumbs: true,
				appendTo: '.cmtx_image_container',
				theme: 'dragdropbox',
				templates: {
					box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
					item: 	'<li class="jFiler-item">\
								<div class="jFiler-item-container">\
									<div class="jFiler-item-inner">\
										<div class="jFiler-item-thumb">\
											<div class="jFiler-item-status"></div>\
											<div class="jFiler-item-info">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
											{{fi-image}}\
										</div>\
										<div class="jFiler-item-assets jFiler-row">\
											<ul class="list-inline pull-left">\
												<li>{{fi-progressBar}}</li>\
											</ul>\
											<ul class="list-inline pull-right">\
												<li><a class="fa fa-trash-o jFiler-item-trash-action"></a></li>\
											</ul>\
										</div>\
									</div>\
								</div>\
							</li>',
					progressBar: '<div class="bar"></div>',
					itemAppendToEnd: false,
					removeConfirmation: false,
					_selectors: {
						list: '.jFiler-items-list',
						item: '.jFiler-item',
						progressBar: '.bar',
						remove: '.jFiler-item-trash-action'
					}
				},
				dragDrop: {
					dragEnter: null,
					dragLeave: null,
					drop: null
				},
				uploadFile: {
					url: cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/sendUpload',
					data: null,
					type: 'POST',
					enctype: 'multipart/form-data',
					beforeSend: function(){},
					success: function(data, el) {
						var parent = el.find(".jFiler-jProgressBar").parent();
						el.find(".jFiler-jProgressBar").fadeOut("slow", function() {
							$('<div class="jFiler-item-others text-success"><i class="fa fa-check"></i> ' + cmtx_js_settings_form.lang_text_drop_success + '</div>').hide().appendTo(parent).fadeIn('slow');
						});
					},
					error: function(el) {
						var parent = el.find(".jFiler-jProgressBar").parent();
						el.find(".jFiler-jProgressBar").fadeOut("slow", function() {
							$('<div class="jFiler-item-others text-error"><i class="fa fa-exclamation"></i> ' + cmtx_js_settings_form.lang_text_drop_error + '</div>').hide().appendTo(parent).fadeIn('slow');
						});
					},
					statusCode: null,
					onProgress: null,
					onComplete: null
				},
				addMore: true,
				beforeShow: function() {
					$('.cmtx_image_row').show();

					return true;
				},
				onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
					if ($('.jFiler-item').length == 1) {
						$('.cmtx_image_row').hide();
					}
				},
				captions: {
					errors: {
						filesLimit: cmtx_js_settings_form.lang_error_file_num,
						filesType: cmtx_js_settings_form.lang_error_file_type,
						filesSize: cmtx_js_settings_form.lang_error_file_size,
						filesSizeAll: cmtx_js_settings_form.lang_error_file_size_all
					}
				}
			});
		}
	}
});

/* Populate states field */
$(document).ready(function() {
	if (typeof(cmtx_js_settings_form) != 'undefined') {
		if (cmtx_js_settings_form.enabled_country && cmtx_js_settings_form.enabled_state) {
			$('#cmtx_country').bind('change', function() {
				var data = 'country_id=' + encodeURIComponent($('#cmtx_country').val());

				var request = $.ajax({
					type: 'POST',
					cache: false,
					url: cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/getStates',
					data: data,
					dataType: 'json',
					beforeSend: function() {
						$('#cmtx_state').html('<option value="">' + cmtx_js_settings_form.lang_text_loading + '</option>');
					}
				});

				request.always(function() {
				});

				request.done(function(response) {
					setTimeout(function() {
						states = response;

						html = '<option value="" hidden>' + cmtx_js_settings_form.lang_placeholder_state + '</option>';

						if (states.length) {
							for (i = 0; i < states.length; i++) {
								html += '<option value="' + states[i]['id'] + '"';

								if (states[i]['id'] == cmtx_js_settings_form.state_id) {
									html += ' selected';
								}

								html += '>' + states[i]['name'] + '</option>';
							}
						} else {
							html += '<option value="" disabled>' + cmtx_js_settings_form.lang_text_country_first + '</option>';
						}

						$('#cmtx_state').html(html);

						$('#cmtx_state').trigger('change');
					}, 500);
				});

				request.fail(function(jqXHR, textStatus, errorThrown) {
					if (console && console.log) {
						console.log(jqXHR.responseText);
					}
				});
			});

			$('#cmtx_country').trigger('change');
		}
	}
});

/* Securimage captcha */
$(document).ready(function() {
	if (typeof(cmtx_js_settings_form) != 'undefined') {
		if (cmtx_js_settings_form.securimage) {
			$('#cmtx_securimage_refresh').click(function() {
				var src = cmtx_js_settings_form.securimage_url + 'securimage_show.php?namespace=' + cmtx_js_settings_form.captcha_namespace + '&' + Math.random();

				$('#cmtx_securimage_image').attr('src', src);
			});
		}
	}
});

/* Submit or preview a comment */
$(document).ready(function() {
	$('#cmtx_submit_button, #cmtx_preview_button').click(function(e) {
		e.preventDefault();

		$('.cmtx_upload_field').remove();

		$('.jFiler-item-thumb-image').each(function() {
			var image = $(this).find('img').attr('src');

			$('#cmtx_form').append('<input type="hidden" name="cmtx_upload[]" class="cmtx_upload_field" value="' + image + '">');
		});

		// Find any disabled inputs and remove the "disabled" attribute
		var disabled = $('#cmtx_form').find(':input:disabled').removeAttr('disabled');

		// Serialize the form
		var serialized = $('#cmtx_form').serialize();

		// Re-disable the set of inputs that were originally disabled
		disabled.attr('disabled', 'disabled');

		var request = $.ajax({
			type: 'POST',
			cache: false,
			url: cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/submit',
			data: serialized + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_form.page_id) + '&cmtx_type=' + encodeURIComponent($(this).attr('data-cmtx-type')) + $('#cmtx_hidden_data').val(),
			dataType: 'json',
			beforeSend: function() {
				$('.cmtx_button').val(cmtx_js_settings_form.lang_button_processing);

				$('.cmtx_button').prop('disabled', true);
			}
		});

		request.always(function() {
			$('.cmtx_submit_button').val(cmtx_js_settings_form.lang_button_submit);

			$('.cmtx_preview_button').val(cmtx_js_settings_form.lang_button_preview);

			$('.cmtx_button').prop('disabled', false);

			$('#cmtx_comment').addClass('cmtx_comment_field_active');

			$('.cmtx_comment_container').addClass('cmtx_comment_container_active');

			$('.cmtx_wait_for_user, .cmtx_wait_for_comment').not('.cmtx_captcha_complete').fadeIn('slow');
		});

		request.done(function(response) {
			$('.cmtx_message_success, .cmtx_message_error, .cmtx_error').remove();

			$('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

			if (response['result']['preview']) {
				$('#cmtx_preview').html(response['result']['preview']);
			} else {
				$('#cmtx_preview').html('');
			}

			if (response['result']['success']) {
				$('#cmtx_comment, #cmtx_answer, #cmtx_securimage').val('');

				var filerKit = $('#filer_input').prop('jFiler');

				if (typeof filerKit != 'undefined') {
					filerKit.reset();
				}

				$('.cmtx_image_row').hide();

				if (response['hide_rating']) {
					$('.cmtx_rating_row').remove();
				}

				$('#cmtx_securimage_refresh').trigger('click');

				if (typeof grecaptcha != 'undefined') {
					grecaptcha.reset();
				}

				$('input[name="cmtx_reply_to"]').val('');

				$('.cmtx_message_reply').remove();

				$('#cmtx_form').before('<div class="cmtx_message cmtx_message_success">' + response['result']['success'] + '</div>');

				$('.cmtx_message_success').fadeIn(1500).delay(3000).fadeOut(1000);

				var options = {
					'commentics_url'	: cmtx_js_settings_form.commentics_url,
					'page_id'			: cmtx_js_settings_form.page_id,
					'page_number'		: '',
					'sort_by'			: '',
					'search'			: '',
					'effect'			: false
				}

				cmtxRefreshComments(options);
			}

			if (response['result']['error']) {
				if (response['error']['comment']) {
					$('#cmtx_comment').addClass('cmtx_field_error');

					$('#cmtx_comment').after('<span class="cmtx_error">' + response['error']['comment'] + '</span>');
				}

				if (response['error']['name']) {
					$('#cmtx_name').addClass('cmtx_field_error');

					$('#cmtx_name').after('<span class="cmtx_error">' + response['error']['name'] + '</span>');
				}

				if (response['error']['email']) {
					$('#cmtx_email').addClass('cmtx_field_error');

					$('#cmtx_email').after('<span class="cmtx_error">' + response['error']['email'] + '</span>');
				}

				if (response['error']['rating']) {
					$('#cmtx_rating').addClass('cmtx_field_error');

					$('#cmtx_rating').after('<span class="cmtx_error">' + response['error']['rating'] + '</span>');
				}

				if (response['error']['website']) {
					$('#cmtx_website').addClass('cmtx_field_error');

					$('#cmtx_website').after('<span class="cmtx_error">' + response['error']['website'] + '</span>');
				}

				if (response['error']['town']) {
					$('#cmtx_town').addClass('cmtx_field_error');

					$('#cmtx_town').after('<span class="cmtx_error">' + response['error']['town'] + '</span>');
				}

				if (response['error']['country']) {
					$('#cmtx_country').addClass('cmtx_field_error');

					$('#cmtx_country').after('<span class="cmtx_error">' + response['error']['country'] + '</span>');
				}

				if (response['error']['state']) {
					$('#cmtx_state').addClass('cmtx_field_error');

					$('#cmtx_state').after('<span class="cmtx_error">' + response['error']['state'] + '</span>');
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

		request.fail(function(jqXHR, textStatus, errorThrown) {
			if (console && console.log) {
				console.log(jqXHR.responseText);
			}
		});
	});
});

/* Show a bio popup when hovering over the Gravatar image */
$(document).ready(function() {
	$('body').on('mouseenter', '.cmtx_gravatar_area', function() {
		$(this).find('.cmtx_bio').stop(true, true).fadeIn(750);
	});

	$('body').on('mouseleave', '.cmtx_gravatar_area', function() {
		$(this).find('.cmtx_bio').stop(true, true).fadeOut(500);
	});

	if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
		$('body').on('mouseenter', '.cmtx_bio', function() {
			$(this).stop(true, true).fadeOut(500);
		});
	}
});

/* Show replies when view replies link is clicked */
$(document).ready(function() {
	$('body').on('click', '.cmtx_view_replies_link', function(e) {
		e.preventDefault();

		$(this).parent().hide();

		$(this).closest('.cmtx_comment_box').next().fadeIn('slow');
	});
});

/* Apply colorbox to image uploads */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_upload_area a', function(e) {
		if (typeof colorbox != 'undefined') {
			$('.cmtx_upload_area a').colorbox({
				maxWidth: '80%',
				maxHeight: '50%',
				rel: function() { return $(this).data('cmtx-rel'); }
			})
		}
	});
});

/* Sort by */
$(document).ready(function() {
	$('#cmtx_container').on('change', '.cmtx_sort_by_field', function(e) {
		e.preventDefault();

		var search = $('input[name="cmtx_search"]').val();

		if (typeof search == 'undefined') {
			search = '';
		}

		var options = {
			'commentics_url'	: cmtx_js_settings_comments.commentics_url,
			'page_id'			: cmtx_js_settings_comments.page_id,
			'page_number'		: '',
			'sort_by'			: $(this).val(),
			'search'			: search,
			'effect'			: true
		}

		cmtxRefreshComments(options);
	});
});

/* Search */
$(document).ready(function() {
	$('#cmtx_container').on('focus', '.cmtx_search', function(e) {
		$(this).addClass('cmtx_search_focus');
	});

	$('#cmtx_container').on('click', '.cmtx_search_container .fa-search', function(e) {
		e.preventDefault();

		var sort_by = $('select[name="cmtx_sort_by"]').val();

		if (typeof sort_by == 'undefined') {
			sort_by = '';
		}

		var options = {
			'commentics_url'	: cmtx_js_settings_comments.commentics_url,
			'page_id'			: cmtx_js_settings_comments.page_id,
			'page_number'	  	: '',
			'sort_by'	  		: sort_by,
			'search'	  		: $(this).prev().val(),
			'effect'			: true
		}

		cmtxRefreshComments(options);
	});

	$('#cmtx_container').on('keypress', '.cmtx_search', function(e) {
		if (e.which == 13) {
			$(this).next().trigger('click');
		}
	});
});

/* Average rating */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_average_rating label', function(e) {
		e.preventDefault();

		var element = $(this);

		var rating = $(this).prev().val();

		var request = $.ajax({
			type: 'POST',
			cache: false,
			url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=part/average_rating/rate',
			data: 'cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id) + '&cmtx_rating=' + encodeURIComponent(rating),
			dataType: 'json',
			beforeSend: function() {
			}
		});

		request.always(function() {
		});

		request.done(function(response) {
			if (response['success']) {
				$('.cmtx_average_rating input').prop('checked', false);

				$(".cmtx_average_rating input[value=" + response['average_rating'] + "]").prop('checked', true);

				$('.cmtx_average_rating_stat_rating, .cmtx_average_rating_stat_number').fadeOut(250, function() {
					$('.cmtx_average_rating_stat_rating').text(response['average_rating']).fadeIn(2000);

					$('.cmtx_average_rating_stat_number').text(response['num_of_ratings']).fadeIn(2000);
				});

				$('.cmtx_action_message_success').clearQueue();
				$('.cmtx_action_message_success').html(response['success']);
				$('.cmtx_action_message_success').fadeIn(500).delay(2000).fadeOut(500);

				$('.cmtx_action_message_success').position({
					my: 'left',
					at: 'right top',
					of: element,
					collision: 'fit'
				});
			}

			if (response['error']) {
				$('.cmtx_action_message_error').clearQueue();
				$('.cmtx_action_message_error').html(response['error']);
				$('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);

				$('.cmtx_action_message_error').position({
					my: 'left',
					at: 'right top',
					of: element,
					collision: 'fit'
				});
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			if (console && console.log) {
				console.log(jqXHR.responseText);
			}
		});
	});
});

/* Pagination */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_pagination_url', function(e) {
		e.preventDefault();

		// This is to stop multiple calls to this event.
		// Occurs when pagination links shown twice (e.g. above and below comments).
		e.stopImmediatePropagation();

		var options = {
			'commentics_url'	: cmtx_js_settings_comments.commentics_url,
			'page_id'			: cmtx_js_settings_comments.page_id,
			'page_number'		: $(this).find('span').attr('data-cmtx-page'),
			'sort_by'	  		: $('select[name="cmtx_sort_by"]').val(),
			'search'			: $('input[name="cmtx_search"]').val(),
			'effect'			: true
		}

		cmtxRefreshComments(options);
	});
});

/* Notify */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_notify_block a', function(e) {
		e.preventDefault();

		$('.cmtx_message, .cmtx_error, .cmtx_subscribe_row').remove();

		$('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

		$('.cmtx_wait_for_user').show();

		$('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_upload_row, .cmtx_image_row, .cmtx_rating_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_checkbox_container, .cmtx_button_row').hide();

		if ($('input[name="cmtx_subscribe"]').val() == '') {
			cmtx_heading_text = $('.cmtx_form_heading').text();
		}

		$('.cmtx_form_heading').fadeOut(500, function() {
			$('.cmtx_form_heading').text(cmtx_js_settings_notify.lang_heading_notify).fadeIn(3000);
		});

		var notify_button = '';

		notify_button += '<div class="cmtx_row cmtx_button_row cmtx_subscribe_row cmtx_clear">';

			notify_button += '<div class="cmtx_col_2">';

				notify_button += '<div class="cmtx_container cmtx_submit_button_container">';

					notify_button += '<input type="button" id="cmtx_notify_button" class="cmtx_button cmtx_submit_button" value="' + cmtx_js_settings_notify.lang_button_notify + '" title="' + cmtx_js_settings_notify.lang_button_notify + '">';

				notify_button += '</div>';

			notify_button += '</div>';

			notify_button += '<div class="cmtx_col_10"></div>';

		notify_button += '</div>';

		$('.cmtx_button_row').after(notify_button);

		$('input[name="cmtx_subscribe"]').val('1');

		$('#cmtx_form').before('<div class="cmtx_message cmtx_message_info cmtx_message_notify">' + cmtx_js_settings_notify.lang_text_notify_info + ' ' + '<a href="#" title="' + cmtx_js_settings_notify.lang_title_cancel_notify + '">' + cmtx_js_settings_notify.lang_link_cancel + '</a></div>');

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
			url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=part/notify/notify',
			data: serialized + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id) + $('#cmtx_hidden_data').val(),
			dataType: 'json',
			beforeSend: function() {
				$('#cmtx_notify_button').val(cmtx_js_settings_notify.lang_button_processing);

				$('#cmtx_notify_button').prop('disabled', true);
			}
		});

		request.always(function() {
			$('#cmtx_notify_button').val(cmtx_js_settings_notify.lang_button_notify);

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

/* Like or dislike a comment */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_vote_link', function(e) {
		e.preventDefault();

		var vote_link = $(this);

		if ($(this).hasClass('cmtx_like_link')) {
			var type = 'like';
		} else {
			var type = 'dislike';
		}

		var request = $.ajax({
			type: 'POST',
			cache: false,
			url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/vote',
			data: 'cmtx_comment_id=' + encodeURIComponent($(this).closest('.cmtx_comment_box').attr('data-cmtx-comment-id')) + '&cmtx_type=' + encodeURIComponent(type),
			dataType: 'json',
			beforeSend: function() {
			}
		});

		request.always(function() {
		});

		request.done(function(response) {
			if (response['success']) {
				vote_link.find('.cmtx_vote_count').text(parseInt(vote_link.find('.cmtx_vote_count').text(), 10) + 1);

				if (type == 'like') {
					vote_link.find('.cmtx_vote_count').effect('highlight', {color: '#529214'}, 2000);
				} else {
					vote_link.find('.cmtx_vote_count').effect('highlight', {color: '#D12F19'}, 2000);
				}
			}

			if (response['error']) {
				$('.cmtx_action_message_error').clearQueue();
				$('.cmtx_action_message_error').html(response['error']);
				$('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);

				$('.cmtx_action_message_error').position({
					my: 'left',
					at: 'right top',
					of: vote_link,
					collision: 'fit'
				});
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			if (console && console.log) {
				console.log(jqXHR.responseText);
			}
		});
	});
});

/* Share a comment */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_share_link', function(e) {
		e.preventDefault();

		$('.cmtx_share_box').hide();

		var share_link = $(this);

		var permalink = $(this).attr('data-cmtx-sharelink');

		$('.cmtx_share_digg').parent().attr('href', 'http://digg.com/submit?url=' + encodeURIComponent(permalink));
		$('.cmtx_share_facebook').parent().attr('href', 'https://www.facebook.com/sharer.php?u=' + encodeURIComponent(permalink));
		$('.cmtx_share_google').parent().attr('href', 'https://plus.google.com/share?url=' + encodeURIComponent(permalink));
		$('.cmtx_share_linkedin').parent().attr('href', 'https://www.linkedin.com/shareArticle?url=' + encodeURIComponent(permalink));
		$('.cmtx_share_reddit').parent().attr('href', 'http://reddit.com/submit?url=' + encodeURIComponent(permalink));
		$('.cmtx_share_stumbleupon').parent().attr('href', 'http://www.stumbleupon.com/submit?url=' + encodeURIComponent(permalink));
		$('.cmtx_share_twitter').parent().attr('href', 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(permalink));

		$('.cmtx_share_box').clearQueue();
		$('.cmtx_share_box').fadeIn(1000);

		$('.cmtx_share_box').position({
			my: 'left',
			at: 'right top',
			of: share_link,
			collision: 'fit'
		});
	});

	$(document).mouseup(function(e) {
		var container = $('.cmtx_share_box');

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			container.fadeOut(1000);
		}
	});
});

/* Flag a comment */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_flag_link', function(e) {
		e.preventDefault();

		var flag_link = $(this);

		$('#cmtx_flag_dialog').dialog({
			modal: true,
			height: 'auto',
			width: 'auto',
			resizable: false,
			draggable: false,
			center: true,
			buttons: [
				{
					id: 'cmtx_flag_button_yes',
					text: cmtx_js_settings_comments.lang_dialog_yes,
					click: function() {
						var request = $.ajax({
							type: 'POST',
							cache: false,
							url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/flag',
							data: 'cmtx_comment_id=' + encodeURIComponent(flag_link.closest('.cmtx_comment_box').attr('data-cmtx-comment-id')),
							dataType: 'json',
							beforeSend: function() {
							}
						});

						request.always(function() {
						});

						request.done(function(response) {
							if (response['success']) {
								$('.cmtx_action_message_success').clearQueue();
								$('.cmtx_action_message_success').html(response['success']);
								$('.cmtx_action_message_success').fadeIn(500).delay(2000).fadeOut(500);

								$('.cmtx_action_message_success').position({
									my: 'left',
									at: 'right top',
									of: flag_link,
									collision: 'fit'
								});
							}

							if (response['error']) {
								$('.cmtx_action_message_error').clearQueue();
								$('.cmtx_action_message_error').html(response['error']);
								$('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);

								$('.cmtx_action_message_error').position({
									my: 'left',
									at: 'right top',
									of: flag_link,
									collision: 'fit'
								});
							}
						});

						request.fail(function(jqXHR, textStatus, errorThrown) {
							if (console && console.log) {
								console.log(jqXHR.responseText);
							}
						});

						$(this).dialog('close');
					}
				}, {
					id: 'cmtx_flag_button_no',
					text: cmtx_js_settings_comments.lang_dialog_no,
					click: function() {
						$(this).dialog('close');
					}
				}
			]
		});

		$('#cmtx_flag_dialog').dialog('open');
	});
});

/* Permalink for a comment */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_permalink_link', function(e) {
		e.preventDefault();

		$('.cmtx_permalink_box').hide();

		var permalink_link = $(this);

		var permalink = $(this).attr('data-cmtx-permalink');

		$('#cmtx_permalink').val(permalink);

		$('.cmtx_permalink_box').clearQueue();
		$('.cmtx_permalink_box').fadeIn(1000);

		$('.cmtx_permalink_box').position({
			my: 'left',
			at: 'right top',
			of: permalink_link,
			collision: 'fit'
		});

		$('#cmtx_permalink').select();
	});

	$('#cmtx_container').on('click', '.cmtx_permalink_box a', function(e) {
		e.preventDefault();

		$('.cmtx_permalink_box').fadeOut(1000);
	});

	$(document).mouseup(function(e) {
		var container = $('.cmtx_permalink_box');

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			container.fadeOut(1000);
		}
	});

	if (typeof(cmtx_js_settings_comments) != 'undefined') {
		if (cmtx_js_settings_comments.flash_id > 0) {
			$('div[data-cmtx-comment-id="' + cmtx_js_settings_comments.flash_id + '"]').effect('highlight', {color: '#FFFF99'}, 2000);
		}
	}
});

/* Reply to a comment */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_reply_link', function(e) {
		e.preventDefault();

		if ($('input[name="cmtx_subscribe"]').val() == '1') {
			$('.cmtx_message_notify a').trigger('click');
		}

		$('.cmtx_message_info').remove();

		var comment_id = $(this).closest('.cmtx_comment_box').attr('data-cmtx-comment-id');

		var name = $(this).closest('.cmtx_comment_box').find('.cmtx_name_text').text();

		$('input[name="cmtx_reply_to"]').val(comment_id);

		$('#cmtx_form').before('<div class="cmtx_message cmtx_message_info cmtx_message_reply">' + cmtx_js_settings_comments.lang_text_replying_to + ' ' + name + '. <a href="#" title="' + cmtx_js_settings_comments.lang_title_cancel_reply + '">' + cmtx_js_settings_comments.lang_link_cancel + '</a></div>');

		if (cmtx_js_settings_comments.scroll_reply) {
			$('html, body').animate({
				scrollTop: $('#cmtx_form_container').offset().top
			}, cmtx_js_settings_comments.scroll_speed);
		}

		$('.cmtx_message_reply').fadeIn(2000);
	});

	$('body').on('click', '.cmtx_message_reply a', function(e) {
		e.preventDefault();

		$('input[name="cmtx_reply_to"]').val('');

		$('.cmtx_message_reply').text(cmtx_js_settings_comments.lang_text_not_replying);
	});
});

/* Return to comments link */
$(document).ready(function() {
	$('#cmtx_container').on('click', '.cmtx_no_permalink a, .cmtx_no_results a, .cmtx_return a', function(e) {
		e.preventDefault();

		$('#cmtx_search').val('');

		var options = {
			'commentics_url' : cmtx_js_settings_comments.commentics_url,
			'page_id'		 : cmtx_js_settings_comments.page_id,
			'page_number'	 : '',
			'sort_by'	  	 : '',
			'search'		 : '',
			'effect'		 : true
		}

		cmtxRefreshComments(options);
	});
});

/* Highlight any user-entered code */
function cmtxHighlightCode() {
	if (typeof(cmtx_js_settings_comments) != 'undefined') {
		if (cmtx_js_settings_comments.highlight) {
			$('.cmtx_code_box, .cmtx_php_box').each(function(i, block) {
				hljs.highlightBlock(block);
			});
		}
	}
}
$(document).ready(function() {
	cmtxHighlightCode();
});

/* Hide the last part of long comments */
function cmtxReadMore() {
	if (typeof(cmtx_js_settings_comments) != 'undefined') {
		if (cmtx_js_settings_comments.show_read_more) {
			$('.cmtx_comment_area').readmore({
				collapsedHeight: cmtx_js_settings_comments.read_more_limit,
				speed: 750,
				moreLink: '<a class="cmtx_read_more"><span class="cmtx_down_icon"></span></a>',
				lessLink: '<a class="cmtx_read_less"><span class="cmtx_up_icon"></span></a>'
			});
		}
	}
}
$(window).load(function() { // Important to use $(window).load() here
	cmtxReadMore();
});

/* Auto update the time with e.g. '2 minutes ago' */
function cmtxTimeago() {
	if (typeof(cmtx_js_settings_comments) != 'undefined') {
		if (cmtx_js_settings_comments.date_auto) {
			$.timeago.settings.strings = {
				suffixAgo : cmtx_js_settings_comments.timeago_suffixAgo,
				inPast    : cmtx_js_settings_comments.timeago_inPast,
				seconds   : cmtx_js_settings_comments.timeago_seconds,
				minute    : cmtx_js_settings_comments.timeago_minute,
				minutes   : cmtx_js_settings_comments.timeago_minutes,
				hour      : cmtx_js_settings_comments.timeago_hour,
				hours     : cmtx_js_settings_comments.timeago_hours,
				day       : cmtx_js_settings_comments.timeago_day,
				days      : cmtx_js_settings_comments.timeago_days,
				month     : cmtx_js_settings_comments.timeago_month,
				months    : cmtx_js_settings_comments.timeago_months,
				year      : cmtx_js_settings_comments.timeago_year,
				years     : cmtx_js_settings_comments.timeago_years
			};

			$('.cmtx_date_area .timeago').timeago();
		}
	}
}
$(document).ready(function() {
	cmtxTimeago();
});

/* Function to refresh the comments using ajax */
function cmtxRefreshComments(options) {
	var request = $.ajax({
		type: 'POST',
		cache: false,
		url: options.commentics_url + 'frontend/index.php?route=main/comments/getComments',
		data: 'cmtx_page_id=' + encodeURIComponent(options.page_id) + '&cmtx_sort_by=' + encodeURIComponent(options.sort_by) + '&cmtx_search=' + encodeURIComponent(options.search) + '&cmtx_page=' + encodeURIComponent(options.page_number),
		dataType: 'json',
		beforeSend: function() {
			if (options.effect) {
				$('.cmtx_loading_icon').show();

				$('body').addClass('cmtx_loading_body');
			}
		}
	});

	request.always(function() {
		if (options.effect) {
			$('.cmtx_loading_icon').hide();

			$('body').removeClass('cmtx_loading_body');
		}
	});

	request.done(function(response) {
		if (response['result']) {
			$('.cmtx_comments_section').html(response['result']);

			if ($('#cmtx_search').val() != '') {
				$('#cmtx_search').addClass('cmtx_search_focus');
			};

			cmtxHighlightCode();
			cmtxReadMore();
			cmtxTimeago();
		}
	});

	request.fail(function(jqXHR, textStatus, errorThrown) {
		if (console && console.log) {
			console.log(jqXHR.responseText);
		}
	});
}