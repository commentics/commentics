<div class="cmtx_sort_by_block">
	<div class="cmtx_sort_by_container">
		<span class="cmtx_sort_by_text"><?php echo $lang_text_sort_by; ?></span>

		<select name="cmtx_sort_by" id="cmtx_sort_by" class="cmtx_sort_by_field" title="<?php echo $lang_title_sort_by; ?>">
			<?php if ($show_sort_by_1) { ?>
				<option value="1" <?php if ($comments_order == '1') { echo 'selected'; } ?>><?php echo $lang_entry_sort_by_1; ?></option>
			<?php } ?>

			<?php if ($show_sort_by_2) { ?>
				<option value="2" <?php if ($comments_order == '2') { echo 'selected'; } ?>><?php echo $lang_entry_sort_by_2; ?></option>
			<?php } ?>

			<?php if ($show_sort_by_3) { ?>
				<option value="3" <?php if ($comments_order == '3') { echo 'selected'; } ?>><?php echo $lang_entry_sort_by_3; ?></option>
			<?php } ?>

			<?php if ($show_sort_by_4) { ?>
				<option value="4" <?php if ($comments_order == '4') { echo 'selected'; } ?>><?php echo $lang_entry_sort_by_4; ?></option>
			<?php } ?>

			<?php if ($show_sort_by_5) { ?>
				<option value="5" <?php if ($comments_order == '5') { echo 'selected'; } ?>><?php echo $lang_entry_sort_by_5; ?></option>
			<?php } ?>

			<?php if ($show_sort_by_6) { ?>
				<option value="6" <?php if ($comments_order == '6') { echo 'selected'; } ?>><?php echo $lang_entry_sort_by_6; ?></option>
			<?php } ?>
		</select>
	</div>
</div>

<script>
// <![CDATA[
$(document).ready(function() {
	$('#cmtx_sort_by').change(function(e) {
		e.preventDefault();

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