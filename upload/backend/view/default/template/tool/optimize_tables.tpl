<?php echo $header; ?>

<div class="tool_optimize_tables_page">

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

	<form action="index.php?route=tool/optimize_tables" class="controls" method="post">
		<input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

		<p><input type="submit" class="button" value="<?php echo $lang_button_optimize; ?>" title="<?php echo $lang_button_optimize; ?>"></p>
	</form>

</div>

<?php echo $footer; ?>