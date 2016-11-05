<?php echo $header; ?>

<div class="layout_comments_rss_page">

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

	<form action="index.php?route=layout_comments/rss" class="controls" method="post">
		<div class="fieldset">
			<label><?php echo $lang_entry_enabled; ?></label>
			<input type="checkbox" name="show_rss" value="1" <?php if ($show_rss) { echo 'checked'; } ?>>
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_window; ?></label>
			<input type="checkbox" name="rss_new_window" value="1" <?php if ($rss_new_window) { echo 'checked'; } ?>>
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_window; ?>', this, event, '')">[?]</a>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_title; ?></label>
			<input type="text" required name="rss_title" class="large" value="<?php echo $rss_title; ?>" maxlength="250">
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_title; ?>', this, event, '')">[?]</a>
			<?php if ($error_rss_title) { ?>
				<span class="error"><?php echo $error_rss_title; ?></span>
			<?php } ?>
		</div>

		<div class="fieldset divide_after">
			<label><?php echo $lang_entry_link; ?></label>
			<input type="text" required name="rss_link" class="large" value="<?php echo $rss_link; ?>" maxlength="250">
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_link; ?>', this, event, '')">[?]</a>
			<?php if ($error_rss_link) { ?>
				<span class="error"><?php echo $error_rss_link; ?></span>
			<?php } ?>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_image; ?></label>
			<input type="checkbox" name="rss_image_enabled" value="1" <?php if ($rss_image_enabled) { echo 'checked'; } ?>>
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_image; ?>', this, event, '')">[?]</a>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_image_url; ?></label>
			<input type="text" required name="rss_image_url" class="large" value="<?php echo $rss_image_url; ?>" maxlength="250">
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_image_url; ?>', this, event, '')">[?]</a>
			<?php if ($error_rss_image_url) { ?>
				<span class="error"><?php echo $error_rss_image_url; ?></span>
			<?php } ?>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_image_width; ?></label>
			<input type="text" required name="rss_image_width" class="small" value="<?php echo $rss_image_width; ?>" maxlength="3">
			<span class="note"><?php echo $lang_note_pixels; ?></span>
			<?php if ($error_rss_image_width) { ?>
				<span class="error"><?php echo $error_rss_image_width; ?></span>
			<?php } ?>
		</div>

		<div class="fieldset divide_after">
			<label><?php echo $lang_entry_image_height; ?></label>
			<input type="text" required name="rss_image_height" class="small" value="<?php echo $rss_image_height; ?>" maxlength="3">
			<span class="note"><?php echo $lang_note_pixels; ?></span>
			<?php if ($error_rss_image_height) { ?>
				<span class="error"><?php echo $error_rss_image_height; ?></span>
			<?php } ?>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_limit_items; ?></label>
			<input type="checkbox" name="rss_limit_enabled" value="1" <?php if ($rss_limit_enabled) { echo 'checked'; } ?>>
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_limit_items; ?>', this, event, '')">[?]</a>
		</div>

		<div class="fieldset">
			<label><?php echo $lang_entry_limit_amount; ?></label>
			<input type="text" required name="rss_limit_amount" class="small" value="<?php echo $rss_limit_amount; ?>" maxlength="3">
			<a class="hint" onmouseover="showhint('<?php echo $lang_hint_limit_amount; ?>', this, event, '')">[?]</a>
			<?php if ($error_rss_limit_amount) { ?>
				<span class="error"><?php echo $error_rss_limit_amount; ?></span>
			<?php } ?>
		</div>

		<input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

		<div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

		<div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
	</form>

</div>

<?php echo $footer; ?>