<?php echo $header; ?>

<div class="settings_admin_detection_page">

	<div class='page_help_block'><?php echo $page_help_link; ?></div>

	<h1><?php echo $lang_heading; ?></h1>

	<hr>

	<?php if ($success) { ?>
		<div class="success"><?php echo $success; ?></div>
	<?php } ?>

	<?php if ($info) { ?>
		<div class="info"><?php echo $info; ?></div>
	<?php } ?>

	<?php if ($error) { ?>
		<div class="error"><?php echo $error; ?></div>
	<?php } ?>

	<?php if ($warning) { ?>
		<div class="warning"><?php echo $warning; ?></div>
	<?php } ?>

	<div class="description"><?php echo $lang_description; ?></div>

	<form action="index.php?route=settings/admin_detection" class="controls" method="post">
		<div class="fieldset">
			<label><?php echo $lang_entry_enabled; ?></label>
			<input type="checkbox" name="detect_admin" value="1" <?php if ($detect_admin) { echo 'checked'; } ?>>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_method; ?></label>
			<select name="detect_method">
				<option value="ip_address" <?php if ($detect_method == 'ip_address') { echo 'selected'; } ?>><?php echo $lang_select_ip_address; ?></option>
				<option value="cookie" <?php if ($detect_method == 'cookie') { echo 'selected'; } ?>><?php echo $lang_select_cookie; ?></option>
				<option value="either" <?php if ($detect_method == 'either') { echo 'selected'; } ?>><?php echo $lang_select_either; ?></option>
				<option value="both" <?php if ($detect_method == 'both') { echo 'selected'; } ?>><?php echo $lang_select_both; ?></option>
			</select>
			<?php if ($error_detect_method) { ?>
				<span class="error"><?php echo $error_detect_method; ?></span>
			<?php } ?>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_ip_address; ?></label>
			<input type="text" required name="ip_address" class="medium" value="<?php echo $ip_address; ?>" maxlength="250">
			<?php if ($error_ip_address) { ?>
				<span class="error"><?php echo $error_ip_address; ?></span>
			<?php } ?>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_cookie; ?></label>
			<input type="checkbox" name="cookie" value="<?php echo $value; ?>" <?php if ($cookie) { echo 'checked'; } ?>>
		</div>

		<input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

		<div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>
	</form>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('div.info a:last-child').click(function(e) {
			e.preventDefault();

			$.ajax({
				url: 'index.php?route=settings/admin_detection/dismiss',
			})

			$('div.info').fadeOut(2000);
		});
	});
	// ]]>
	</script>

</div>

<?php echo $footer; ?>