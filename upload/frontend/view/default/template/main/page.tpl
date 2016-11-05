<div id="cmtx_container" class="cmtx_container">
	<?php echo $header; ?>

	<?php if ($maintenance_mode) { ?>
		<h3><?php echo $lang_heading_maintenance; ?></h3>

		<div class="cmtx_maintenance_mode"><?php echo $maintenance_message; ?></div>
	<?php } else { ?>
		<?php if ($order_parts == '1,2') { ?>
			<div class="cmtx_form_section"><?php echo $form; ?></div>
		<?php } else { ?>
			<div class="cmtx_comment_section"><?php echo $comments; ?></div>
		<?php } ?>

		<?php if ($display_parsing) { ?>
			<div class="cmtx_parsing_box cmtx_clear">
				<div><?php echo $lang_text_generated_in; ?> <?php echo $generated_time; ?> <?php echo $lang_text_seconds; ?></div>
				<div><b>PHP</b>: <?php echo $php_time; ?>s | <b>SQL</b>: <?php echo $query_time; ?>s (<?php echo $query_count; ?> <?php echo $lang_text_queries; ?>)</div>
			</div>
		<?php } ?>

		<?php if ($order_parts == '1,2') { ?>
			<div class="cmtx_comment_section"><?php echo $comments; ?></div>
		<?php } else { ?>
			<div class="cmtx_form_section"><?php echo $form; ?></div>
		<?php } ?>
	<?php } ?>

	<?php echo $footer; ?>
</div>