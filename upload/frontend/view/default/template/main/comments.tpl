<div id="cmtx_comments_container" class="cmtx_comments_container cmtx_clear">
	<h3 class="cmtx_comments_heading"><?php echo $lang_heading_comments; ?></h3>

	<?php if ($comments) { ?>
		<?php if ($rich_snippets_enabled) { ?>
			<div itemscope itemtype="http://schema.org/<?php echo $rich_snippets_type; ?>">
		<?php } ?>

		<?php if ($row_one) { ?>
			<div class="cmtx_comments_row_one cmtx_clear">
				<div class="cmtx_row_left <?php if ($comments_position_1 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_1; ?></div>
				<div class="cmtx_row_middle <?php if ($comments_position_2 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_2; ?></div>
				<div class="cmtx_row_right <?php if ($comments_position_3 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_3; ?></div>
			</div>
		<?php } ?>

		<?php if ($row_two) { ?>
			<div class="cmtx_comments_row_two cmtx_clear">
				<div class="cmtx_row_left <?php if ($comments_position_4 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_4; ?></div>
				<div class="cmtx_row_middle <?php if ($comments_position_5 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_5; ?></div>
				<div class="cmtx_row_right <?php if ($comments_position_6 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_6; ?></div>
			</div>
		<?php } ?>

		<div class="cmtx_comment_boxes">
			<?php foreach ($comments as $comment) { ?>
				<?php $has_replies = false; ?>
				<?php $reply_depth = 0; ?>
				<?php $reply_num = 0; ?>

				<?php if ($comment['reply_id']) { ?>
					<?php $has_replies = true; ?>
				<?php } ?>

				<?php require($this->loadTemplate('main/comment')); ?>

				<?php if ($has_replies) { ?>
					<div class="cmtx_replies_group <?php if ($hide_replies) { echo 'cmtx_hide'; } ?>">
				<?php } ?>

				<?php foreach ($comment['reply_id'] as $reply) { ?>
					<?php $reply_depth = 1; ?>
					<?php $reply_num++; ?>
					<?php $comment = $reply; ?>
					<?php require($this->loadTemplate('main/comment')); ?>

					<?php foreach ($comment['reply_id'] as $reply) { ?>
						<?php $reply_depth = 2; ?>
						<?php $reply_num++; ?>
						<?php $comment = $reply; ?>
						<?php require($this->loadTemplate('main/comment')); ?>

						<?php foreach ($comment['reply_id'] as $reply) { ?>
							<?php $reply_depth = 3; ?>
							<?php $reply_num++; ?>
							<?php $comment = $reply; ?>
							<?php require($this->loadTemplate('main/comment')); ?>

							<?php foreach ($comment['reply_id'] as $reply) { ?>
								<?php $reply_depth = 4; ?>
								<?php $reply_num++; ?>
								<?php $comment = $reply; ?>
								<?php require($this->loadTemplate('main/comment')); ?>

								<?php foreach ($comment['reply_id'] as $reply) { ?>
									<?php $reply_depth = 5; ?>
									<?php $reply_num++; ?>
									<?php $comment = $reply; ?>
									<?php require($this->loadTemplate('main/comment')); ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>

				<?php if ($has_replies) { ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>

		<?php if ($is_permalink || $is_search) { ?>
			<div class="cmtx_return"><?php echo $lang_text_return; ?></div>
		<?php } ?>

		<?php if ($row_three) { ?>
			<div class="cmtx_comments_row_three cmtx_clear">
				<div class="cmtx_row_left <?php if ($comments_position_7 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_7; ?></div>
				<div class="cmtx_row_middle <?php if ($comments_position_8 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_8; ?></div>
				<div class="cmtx_row_right <?php if ($comments_position_9 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_9; ?></div>
			</div>
		<?php } ?>

		<?php if ($row_four) { ?>
			<div class="cmtx_comments_row_four cmtx_clear">
				<div class="cmtx_row_left <?php if ($comments_position_10 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_10; ?></div>
				<div class="cmtx_row_middle <?php if ($comments_position_11 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_11; ?></div>
				<div class="cmtx_row_right <?php if ($comments_position_12 == '&nbsp;') { echo 'cmtx_empty_position'; } ?>"><?php echo $comments_position_12; ?></div>
			</div>
		<?php } ?>

		<div id="cmtx_flag_dialog" title="<?php echo $lang_dialog_flag_title; ?>" style="display:none">
			<span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_flag_content; ?>
		</div>

		<div class="cmtx_action_message cmtx_action_message_success"></div>
		<div class="cmtx_action_message cmtx_action_message_error"></div>

		<div class="cmtx_share_box">
			<?php if ($show_share_digg) { ?>
				<a href="#" <?php if ($share_new_window) { echo 'target="_blank"'; } ?> title="<?php echo $lang_title_digg; ?>"><span class="cmtx_share cmtx_share_digg"></span></a>
			<?php } ?>

			<?php if ($show_share_facebook) { ?>
				<a href="#" <?php if ($share_new_window) { echo 'target="_blank"'; } ?> title="<?php echo $lang_title_facebook; ?>"><span class="cmtx_share cmtx_share_facebook"></span></a>
			<?php } ?>

			<?php if ($show_share_google) { ?>
				<a href="#" <?php if ($share_new_window) { echo 'target="_blank"'; } ?> title="<?php echo $lang_title_google; ?>"><span class="cmtx_share cmtx_share_google"></span></a>
			<?php } ?>

			<?php if ($show_share_linkedin) { ?>
				<a href="#" <?php if ($share_new_window) { echo 'target="_blank"'; } ?> title="<?php echo $lang_title_linkedin; ?>"><span class="cmtx_share cmtx_share_linkedin"></span></a>
			<?php } ?>

			<?php if ($show_share_reddit) { ?>
				<a href="#" <?php if ($share_new_window) { echo 'target="_blank"'; } ?> title="<?php echo $lang_title_reddit; ?>"><span class="cmtx_share cmtx_share_reddit"></span></a>
			<?php } ?>

			<?php if ($show_share_stumbleupon) { ?>
				<a href="#" <?php if ($share_new_window) { echo 'target="_blank"'; } ?> title="<?php echo $lang_title_stumbleupon; ?>"><span class="cmtx_share cmtx_share_stumbleupon"></span></a>
			<?php } ?>

			<?php if ($show_share_twitter) { ?>
				<a href="#" <?php if ($share_new_window) { echo 'target="_blank"'; } ?> title="<?php echo $lang_title_twitter; ?>"><span class="cmtx_share cmtx_share_twitter"></span></a>
			<?php } ?>
		</div>

		<div class="cmtx_permalink_box">
			<div><?php echo $lang_text_permalink; ?></div>

			<input type="text" name="cmtx_permalink" id="cmtx_permalink" class="cmtx_permalink" value="">

			<div><a href="#"><?php echo $lang_link_close; ?></a></div>
		</div>

		<div class="cmtx_loading_icon"></div>

		<?php if ($show_like || $show_dislike) { ?>
			<script>
			// <![CDATA[
			$(document).ready(function() {
				$('.cmtx_vote_link').click(function(e) {
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
						url: '<?php echo $commentics_url; ?>frontend/index.php?route=main/comments/vote',
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
							$('.cmtx_action_message_error').css('top', e.pageY);
							$('.cmtx_action_message_error').css('left', e.pageX - 75);
							$('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);
						}
					});

					request.fail(function(jqXHR, textStatus, errorThrown) {
						if (console && console.log) {
							console.log(jqXHR.responseText);
						}
					});
				});
			});
			// ]]>
			</script>
		<?php } ?>

		<?php if ($show_share) { ?>
			<script>
			// <![CDATA[
			$(document).ready(function() {
				$('.cmtx_share_link').click(function(e) {
					e.preventDefault();

					$('.cmtx_share_box').hide();

					var sharelink = $(this).attr('data-cmtx-sharelink');

					$('.cmtx_share_digg').parent().attr('href', '<?php echo $comment["share_digg"]; ?>' + encodeURIComponent(sharelink));
					$('.cmtx_share_facebook').parent().attr('href', '<?php echo $comment["share_facebook"]; ?>' + encodeURIComponent(sharelink));
					$('.cmtx_share_google').parent().attr('href', '<?php echo $comment["share_google"]; ?>' + encodeURIComponent(sharelink));
					$('.cmtx_share_linkedin').parent().attr('href', '<?php echo $comment["share_linkedin"]; ?>' + encodeURIComponent(sharelink));
					$('.cmtx_share_reddit').parent().attr('href', '<?php echo $comment["share_reddit"]; ?>' + encodeURIComponent(sharelink));
					$('.cmtx_share_stumbleupon').parent().attr('href', '<?php echo $comment["share_stumbleupon"]; ?>' + encodeURIComponent(sharelink));
					$('.cmtx_share_twitter').parent().attr('href', '<?php echo $comment["share_twitter"]; ?>' + encodeURIComponent(sharelink));

					$('.cmtx_share_box').clearQueue();
					$('.cmtx_share_box').css('top', e.pageY);
					$('.cmtx_share_box').css('left', e.pageX - 50);
					$('.cmtx_share_box').fadeIn(1000);
				});

				$(document).mouseup(function(e) {
					var container = $('.cmtx_share_box');

					if (!container.is(e.target) && container.has(e.target).length === 0) {
						container.fadeOut(1000);
					}
				});
			});
			// ]]>
			</script>
		<?php } ?>

		<?php if ($show_flag) { ?>
			<script>
			// <![CDATA[
			$(document).ready(function() {
				$('.cmtx_flag_link').click(function(e) {
					e.preventDefault();

					var flag_link = $(this);

					$('#cmtx_flag_dialog').dialog({
						modal: true,
						height: 'auto',
						width: 'auto',
						resizable: false,
						draggable: false,
						center: true,
						buttons: {
							'<?php echo $lang_dialog_yes; ?>': function() {
								var request = $.ajax({
									type: 'POST',
									cache: false,
									url: '<?php echo $commentics_url; ?>frontend/index.php?route=main/comments/flag',
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
										$('.cmtx_action_message_success').css('top', e.pageY);
										$('.cmtx_action_message_success').css('left', e.pageX - 150);
										$('.cmtx_action_message_success').fadeIn(500).delay(2000).fadeOut(500);
									}

									if (response['error']) {
										$('.cmtx_action_message_error').clearQueue();
										$('.cmtx_action_message_error').html(response['error']);
										$('.cmtx_action_message_error').css('top', e.pageY);
										$('.cmtx_action_message_error').css('left', e.pageX - 150);
										$('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);
									}
								});

								request.fail(function(jqXHR, textStatus, errorThrown) {
									if (console && console.log) {
										console.log(jqXHR.responseText);
									}
								});

								$(this).dialog('close');
							},
							'<?php echo $lang_dialog_no; ?>': function() {
								$(this).dialog('close');
							}
						}
					});

					$('#cmtx_flag_dialog').dialog('open');
				});
			});
			// ]]>
			</script>
		<?php } ?>

		<?php if ($show_permalink) { ?>
			<script>
			// <![CDATA[
			$(document).ready(function() {
				$('.cmtx_permalink_link').click(function(e) {
					e.preventDefault();

					$('.cmtx_permalink_box').hide();

					var permalink = $(this).attr('data-cmtx-permalink');

					$('#cmtx_permalink').val(permalink);

					$('.cmtx_permalink_box').clearQueue();
					$('.cmtx_permalink_box').css('top', e.pageY);
					$('.cmtx_permalink_box').css('left', e.pageX - 225);
					$('.cmtx_permalink_box').fadeIn(1000);

					$('#cmtx_permalink').select();
				});

				$('.cmtx_permalink_box a').click(function(e) {
					e.preventDefault();

					$('.cmtx_permalink_box').fadeOut(1000);
				});

				$(document).mouseup(function(e) {
					var container = $('.cmtx_permalink_box');

					if (!container.is(e.target) && container.has(e.target).length === 0) {
						container.fadeOut(1000);
					}
				});

				<?php if ($flash_id) { ?>
					$('div[data-cmtx-comment-id="<?php echo $flash_id; ?>"]').effect('highlight', {color: '#FFFF99'}, 2000);
				<?php } ?>
			});
			// ]]>
			</script>
		<?php } ?>

		<?php if ($show_reply) { ?>
			<script>
			// <![CDATA[
			$(document).ready(function() {
				$('.cmtx_reply_link').click(function(e) {
					e.preventDefault();

					if ($('input[name="cmtx_subscribe"]').val() == '1') {
						$('.cmtx_message_notify a').trigger('click');
					}

					$('.cmtx_message_info').remove();

					var comment_id = $(this).closest('.cmtx_comment_box').attr('data-cmtx-comment-id');

					var name = $(this).closest('.cmtx_comment_box').find('.cmtx_name_text').text();

					$('input[name="cmtx_reply_to"]').val(comment_id);

					$('#cmtx_form').before('<div class="cmtx_message cmtx_message_info cmtx_message_reply">' + '<?php echo $lang_text_replying_to; ?>' + ' ' + name + '. <a href="#" title="<?php echo $lang_title_cancel_reply; ?>"><?php echo $lang_link_cancel; ?></a></div>');

					<?php if ($scroll_reply) { ?>
						$('html, body').animate({
							scrollTop: $('#cmtx_form_container').offset().top
						}, <?php echo $scroll_speed; ?>);
					<?php } ?>

					$('.cmtx_message_reply').fadeIn(2000);
				});

				$('body').on('click', '.cmtx_message_reply a', function(e) {
					e.preventDefault();

					$('input[name="cmtx_reply_to"]').val('');

					$('.cmtx_message_reply').text('<?php echo $lang_text_not_replying; ?>');
				});
			});
			// ]]>
			</script>
		<?php } ?>

		<?php if ($highlight) { ?>
			<script>
			// <![CDATA[
			$(document).ready(function() {
				$('.cmtx_code_box, .cmtx_php_box').each(function(i, block) {
					hljs.highlightBlock(block);
				});
			});
			// ]]>
			</script>
		<?php } ?>

		<?php if ($show_read_more) { ?>
			<script>
			// <![CDATA[
			$(window).load(function() { // Important to use $(window).load() here
				$('.cmtx_comment_area').readmore({
					collapsedHeight: <?php echo $read_more_limit; ?>,
					speed: 750,
					moreLink: '<a class="cmtx_read_more"><span class="cmtx_down_icon"></span></a>',
					lessLink: '<a class="cmtx_read_less"><span class="cmtx_up_icon"></span></a>'
				});
			});
			// ]]>
			</script>
		<?php } ?>

		<script>
		// <![CDATA[
		$(document).ready(function() {
			if (typeof colorbox != 'undefined') {
				$('.cmtx_upload_area a').colorbox({
					maxWidth: '80%',
					maxHeight: '50%',
					rel: function() { return $(this).data('cmtx-rel'); }
				})
			}
		});
		// ]]>
		</script>

		<?php if ($date_auto) { ?>
			<script>
			// <![CDATA[
			$(document).ready(function() {
				$.timeago.settings.strings = {
					suffixAgo: '<?php echo $lang_text_timeago_ago; ?>',
					inPast   : '<?php echo $lang_text_timeago_second; ?>',
					seconds  : '<?php echo $lang_text_timeago_seconds; ?>',
					minute   : '<?php echo $lang_text_timeago_minute; ?>',
					minutes  : '<?php echo $lang_text_timeago_minutes; ?>',
					hour     : '<?php echo $lang_text_timeago_hour; ?>',
					hours    : '<?php echo $lang_text_timeago_hours; ?>',
					day      : '<?php echo $lang_text_timeago_day; ?>',
					days     : '<?php echo $lang_text_timeago_days; ?>',
					month    : '<?php echo $lang_text_timeago_month; ?>',
					months   : '<?php echo $lang_text_timeago_months; ?>',
					year     : '<?php echo $lang_text_timeago_year; ?>',
					years    : '<?php echo $lang_text_timeago_years; ?>'
				};

				$('.cmtx_date_area .timeago').timeago();
			});
			// ]]>
			</script>
		<?php } ?>

		<?php if ($rich_snippets_enabled) { ?>
			</div>
		<?php } ?>
	<?php } else if ($permalink_no_results) { ?>
		<div class="cmtx_no_permalink"><?php echo $lang_text_no_permalink; ?></div>
	<?php } else if ($search_no_results) { ?>
		<div class="cmtx_no_results"><?php echo $lang_text_no_results; ?></div>
	<?php } else { ?>
		<div class="cmtx_no_comments"><?php echo $lang_text_no_comments; ?></div>
	<?php } ?>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('body').on('click', '.cmtx_no_permalink a, .cmtx_no_results a, .cmtx_return a', function(e) {
			e.preventDefault();

			$('#cmtx_search').val('');

			var options = {
				'commentics_url'	: '<?php echo $commentics_url; ?>',
				'page_id'			: '<?php echo $page_id; ?>',
				'page_number'		: '',
				'effect'			: true
			}

			cmtxRefreshComments(options);
		});
	});
	// ]]>
	</script>
</div>