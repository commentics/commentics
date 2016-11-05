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
	$('.cmtx_smiley').click(function() {
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

		$(this).fadeOut('slow');

		$(this).closest('.cmtx_comment_box').next().fadeIn('slow');
	});
});

/* Function to refresh the comments using ajax */
function cmtxRefreshComments(options) {
	if (typeof $('#cmtx_sort_by').val() != 'undefined') {
		sort_by = $('#cmtx_sort_by').val();
	} else {
		sort_by = '';
	}

	if (typeof $('#cmtx_search').val() != 'undefined') {
		search = $('#cmtx_search').val();
	} else {
		search = '';
	}

	var request = $.ajax({
		type: 'POST',
		cache: false,
		url: options.commentics_url + 'frontend/index.php?route=main/comments/getComments',
		data: 'cmtx_page_id=' + encodeURIComponent(options.page_id) + '&cmtx_sort_by=' + encodeURIComponent(sort_by) + '&cmtx_search=' + encodeURIComponent(search) + '&cmtx_page=' + encodeURIComponent(options.page_number),
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
			$('.cmtx_comment_section').html(response['result']);
		}
	});

	request.fail(function(jqXHR, textStatus, errorThrown) {
		if (console && console.log) {
			console.log(jqXHR.responseText);
		}
	});
}