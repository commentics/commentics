<?php echo $header; ?>

<div class="settings_layout_form_page">

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

	<table class="table">
		<thead>
			<tr>
				<th><?php echo $lang_column_element; ?></th>
				<th><?php echo $lang_column_status; ?></th>
				<th><?php echo $lang_column_action; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($elements as $element) { ?>
				<tr>
					<td><?php echo $element['element']; ?></td>
					<td><?php echo $element['status']; ?></td>
					<td><a href="<?php echo $element['action']; ?>"><img src="<?php echo $button_edit; ?>" class="button_edit" title="<?php echo $lang_button_edit; ?>"></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

</div>

<?php echo $footer; ?>