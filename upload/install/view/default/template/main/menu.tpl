<?php echo $header; ?>

<div class="menu_page">

	<p><?php echo $lang_text_action; ?></p>

	<form action="index.php?route=menu" method="post">
		<div class="choice"><input type="radio" name="action" value="install" checked> <?php echo $lang_entry_install; ?></div>
		<div class="choice"><input type="radio" name="action" value="upgrade"> <?php echo $lang_entry_upgrade; ?></div>

		<input type="submit" class="button" value="<?php echo $lang_button_continue; ?>" title="<?php echo $lang_button_continue; ?>">
	</form>

</div>

<?php echo $footer; ?>