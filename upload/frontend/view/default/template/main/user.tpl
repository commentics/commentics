<!DOCTYPE html>
<html>
<head>
<title><?php echo $lang_title; ?></title>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../3rdparty/font_awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>">
<script src="<?php echo $jquery; ?>"></script>
<script src="<?php echo $timeago; ?>"></script>
</head>
<body>

<div id="cmtx_user_container" class="cmtx_user_container cmtx_clear">
	<?php if ($lang_heading) { ?>
		<h1 class="cmtx_user_heading"><?php echo $lang_heading; ?></h1>
	<?php } ?>

	<?php if ($success) { ?>
		<div class="cmtx_message cmtx_message_success"><?php echo $success; ?></div>
	<?php } ?>

	<?php if ($info) { ?>
		<div class="cmtx_message cmtx_message_info"><?php echo $info; ?></div>
	<?php } ?>

	<?php if ($error) { ?>
		<div class="cmtx_message cmtx_message_error"><?php echo $error; ?></div>
	<?php } ?>

	<?php if ($warning) { ?>
		<div class="cmtx_message cmtx_message_warning"><?php echo $warning; ?></div>
	<?php } ?>

	<?php if ($user) { ?>
		<form>
			<div class="cmtx_user_options_area">
				<div class="cmtx_user_section_title"><?php echo $lang_text_options_section; ?></div>

				<div class="cmtx_user_section_body">
					<div><input type="radio" id="everything" name="to_all" value="1" <?php if ($user['to_all']) { echo 'checked'; } ?>> <label for="everything"><?php echo $lang_text_everything; ?></label></div>
					<div><input type="radio" id="custom" name="to_all" value="0" <?php if (!$user['to_all']) { echo 'checked'; } ?>> <label for="custom"><?php echo $lang_text_custom; ?></label></div>
				</div>

				<div class="cmtx_user_section_body cmtx_user_section_custom">
					<div class="cmtx_user_custom_text"><?php echo $lang_text_custom_section; ?></div>

					<div><input type="checkbox" id="to_admin" name="to_admin" value="1" <?php if ($user['to_admin']) { echo 'checked'; } ?>> <label for="to_admin"><?php echo $lang_text_admin_comments; ?></label></div>
					<div><input type="checkbox" id="to_reply" name="to_reply" value="1" <?php if ($user['to_reply']) { echo 'checked'; } ?>> <label for="to_reply"><?php echo $lang_text_reply_comments; ?></label></div>
					<div><input type="checkbox" id="to_approve" name="to_approve" value="1" <?php if ($user['to_approve']) { echo 'checked'; } ?>> <label for="to_approve"><?php echo $lang_text_approved_comments; ?></label></div>
				</div>
			</div>

			<div class="cmtx_user_format_area">
				<div class="cmtx_user_section_title"><?php echo $lang_text_format_section; ?></div>

				<div class="cmtx_user_section_body">
					<div><input type="radio" id="html" name="format" value="html" <?php if ($user['format'] == 'html') { echo 'checked'; } ?>> <label for="html"><?php echo $lang_text_html; ?></label></div>
					<div><input type="radio" id="text" name="format" value="text" <?php if ($user['format'] == 'text') { echo 'checked'; } ?>> <label for="text"><?php echo $lang_text_text; ?></label></div>
				</div>
			</div>
		</form>

		<div id="subscriptions" class="cmtx_user_subscriptions_area">
			<div class="cmtx_user_section_title"><?php echo $lang_text_subscriptions_section; ?></div>

			<div class="cmtx_user_section_body">
				<table class="cmtx_table">
					<thead>
						<tr>
							<th><?php echo $lang_column_number; ?></th>
							<th><?php echo $lang_column_page; ?></th>
							<th><?php echo $lang_column_date; ?></th>
							<th><?php echo $lang_column_action; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if ($subscriptions) { ?>
							<?php $i = 1; ?>

							<?php foreach ($subscriptions as $subscription) { ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><a href="<?php echo $subscription['url']; ?>" target="_blank"><?php echo $subscription['reference']; ?></a></td>
									<td><time class="timeago" datetime="<?php echo $subscription['date_added']; ?>" title="<?php echo $subscription['date_added_title']; ?>"></time></td>
									<td><span class="cmtx_trash_icon" title="<?php echo $lang_title_delete; ?>" data-sub-token="<?php echo $subscription['token']; ?>"></span></td>
								</tr>

								<?php $i++; ?>
							<?php } ?>
						<?php } else { ?>
							<tr>
								<td class="cmtx_no_results" colspan="4"><?php echo $lang_text_no_results; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="cmtx_user_delete_area">
			<div class="cmtx_user_section_title"><?php echo $lang_text_delete_section; ?></div>

			<div class="cmtx_user_section_body">
				<a href="#" class="cmtx_delete_all" title="<?php echo $lang_title_delete_all; ?>"><?php echo $lang_link_delete; ?></a>
			</div>
		</div>
	<?php } ?>
</div>

<?php if ($user) { ?>
	<script>
	// <![CDATA[
	$(document).ready(function() {
		<?php if ($user['to_all']) { ?>
			$('.cmtx_user_section_custom').hide();
		<?php } else { ?>
			$('.cmtx_user_section_custom').show();
		<?php } ?>
	});
	// ]]>
	</script>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('input[name="to_all"]').on('change', function() {
			if ($(this).val() == '1') {
				$('.cmtx_user_section_custom').fadeOut(500);
			} else {
				$('.cmtx_user_section_custom').fadeIn(1000);
			}
		});
	});
	// ]]>
	</script>

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

		$('.timeago').timeago();
	});
	// ]]>
	</script>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('input').change(function(e) {
			var request = $.ajax({
				type: 'POST',
				cache: false,
				url: '<?php echo $commentics_url; ?>frontend/index.php?route=main/user/save',
				data: $('form').serialize() + '&u-t=' + encodeURIComponent('<?php echo $user["token"]; ?>'),
				dataType: 'json',
				beforeSend: function() {
					$('.cmtx_message').remove();

					$('form').before('<div class="cmtx_message cmtx_message_info">' + '<?php echo $lang_text_saving; ?>' + '</div>');

					$('.cmtx_message').show();
				}
			});

			request.always(function() {
			});

			request.done(function(response) {
				$('html, body').animate({
					scrollTop: $('.cmtx_user_container').offset().top
				}, 1000);

				setTimeout(function() {
					$('.cmtx_message').remove();

					if (response['success']) {
						$('form').before('<div class="cmtx_message cmtx_message_success">' + response['success'] + '</div>');

						$('.cmtx_message').show();
					}

					if (response['error']) {
						$('form').before('<div class="cmtx_message cmtx_message_error">' + response['error'] + '</div>');

						$('.cmtx_message').show();
					}
				}, 1000);
			});
		});
	});
	// ]]>
	</script>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('.cmtx_trash_icon').click(function(e) {
			var $this = $(this);

			var request = $.ajax({
				type: 'POST',
				cache: false,
				url: '<?php echo $commentics_url; ?>frontend/index.php?route=main/user/deleteSubscription',
				data: '&u-t=' + encodeURIComponent('<?php echo $user["token"]; ?>') + '&s-t=' + encodeURIComponent($(this).attr('data-sub-token')),
				dataType: 'json',
				beforeSend: function() {
				}
			});

			request.always(function() {
			});

			request.done(function(response) {
				$('.cmtx_message').remove();

				if (response['success']) {
					$this.parent().parent().remove();

					$('.count').text(response['count']);

					if (response['count'] == '0') {
						$('tbody').append('<tr><td class="cmtx_no_results" colspan="4"><?php echo $lang_text_no_results; ?></td></tr>');
					} else {
						var i = 1;

						$('tbody tr td:first-child').each(function() {
							$(this).text(i);

							i++;
						});
					}
				}

				if (response['error']) {
					$('html, body').animate({
						scrollTop: $('.cmtx_user_container').offset().top
					}, 1000);

					$('form').before('<div class="cmtx_message cmtx_message_error">' + response['error'] + '</div>');

					$('.cmtx_message').show();
				}
			});
		});
	});
	// ]]>
	</script>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('.cmtx_delete_all').click(function(e) {
			e.preventDefault();

			var request = $.ajax({
				type: 'POST',
				cache: false,
				url: '<?php echo $commentics_url; ?>frontend/index.php?route=main/user/deleteAllSubscriptions',
				data: '&u-t=' + encodeURIComponent('<?php echo $user["token"]; ?>'),
				dataType: 'json',
				beforeSend: function() {
				}
			});

			request.always(function() {
			});

			request.done(function(response) {
				$('.cmtx_message').remove();

				if (response['success']) {
					$('.count').text('0');

					$('tbody').html('<tr><td class="cmtx_no_results" colspan="4"><?php echo $lang_text_no_results; ?></td></tr>');
				}

				if (response['error']) {
					$('html, body').animate({
						scrollTop: $('.cmtx_user_container').offset().top
					}, 1000);

					$('form').before('<div class="cmtx_message cmtx_message_error">' + response['error'] + '</div>');

					$('.cmtx_message').show();
				}
			});
		});
	});
	// ]]>
	</script>
<?php } ?>

</body>
</html>