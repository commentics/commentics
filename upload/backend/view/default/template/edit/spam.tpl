<?php echo $header; ?>

<div class="edit_spam_page">

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

	<form action="index.php?route=edit/spam&amp;id=<?php echo $id; ?>" class="controls" method="post">
		<div class="section">
			<div>
				<input type="radio" name="delete" value="delete_this" <?php if ($delete == 'delete_this') { echo 'checked'; } ?>> <?php echo $lang_text_delete_this; ?><br>
				<input type="radio" name="delete" value="delete_all" <?php if ($delete == 'delete_all') { echo 'checked'; } ?>> <?php echo $lang_text_delete_all; ?>
				<?php if ($error_delete) { ?>
					<span class="error"><?php echo $error_delete; ?></span>
				<?php } ?>
			</div>

			<div>
				<input type="radio" name="ban" value="ban" <?php if ($ban == 'ban') { echo 'checked'; } ?>> <?php echo $lang_text_ban; ?><br>
				<input type="radio" name="ban" value="no_ban" <?php if ($ban == 'no_ban') { echo 'checked'; } ?>> <?php echo $lang_text_no_ban; ?>
				<?php if ($error_ban) { ?>
					<span class="error"><?php echo $error_ban; ?></span>
				<?php } ?>
			</div>

			<div>
				<input type="checkbox" name="add_name" value="1" <?php if ($add_name) { echo 'checked'; } ?>> <?php echo $lang_text_add_name; ?><br>
				<input type="checkbox" name="add_email" value="1" <?php if ($add_email) { echo 'checked'; } ?>> <?php echo $lang_text_add_email; ?><br>
				<?php if ($has_website) { ?>
					<input type="checkbox" name="add_website" value="1" <?php if ($add_website) { echo 'checked'; } ?>> <?php echo $lang_text_add_website; ?>
				<?php } ?>
			</div>
		</div>

		<input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

		<div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_confirm; ?>" title="<?php echo $lang_button_confirm; ?>"></div>

		<div class="links"><a id="back"><?php echo $lang_link_back; ?></a></div>
	</form>

	<div id="spam_dialog" title="<?php echo $lang_dialog_spam_title; ?>" style="display:none">
		<span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_spam_content; ?>
	</div>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('div.info a:last-child').click(function(e) {
			e.preventDefault();

			$.ajax({
				url: 'index.php?route=edit/spam/dismiss',
			})

			$('div.info').fadeOut(2000);
		});
	});
	// ]]>
	</script>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('.button').click(function(e) {
			e.preventDefault();

			$('#spam_dialog').dialog({
				modal: true,
				height: 'auto',
				width: 'auto',
				resizable: false,
				draggable: false,
				center: true,
				buttons: {
					'<?php echo $lang_dialog_yes; ?>': function() {
						$('form').submit();

						$(this).dialog('close');
					},
					'<?php echo $lang_dialog_no; ?>': function() {
						$(this).dialog('close');
					}
				}
			});

			$('#spam_dialog').dialog('open');
		});
	});
	// ]]>
	</script>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('#back').click(function(e) {
			e.preventDefault();

			window.history.back();
		});
	});
	// ]]>
	</script>

</div>

<?php echo $footer; ?>