<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $lang_title; ?></title>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>">
<?php if ($custom) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $custom; ?>">
<?php } ?>
<script src="<?php echo $common; ?>"></script>
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

		<div id="cmtx_js_settings_user" style="display:none" hidden><?php echo json_encode($cmtx_js_settings_user); ?></div>
	<?php } ?>
</div>

</body>
</html>