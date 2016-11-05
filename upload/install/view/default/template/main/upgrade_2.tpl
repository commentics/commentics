<?php echo $header; ?>

<div class="upgrade_2_page">

	<?php if ($error) { ?>

		<div class="error"><?php echo $lang_error_failure; ?></div>

		<br>

		<?php echo $error; ?>

	<?php } else { ?>

		<div class="success"><?php echo $lang_success_upgrade; ?></div>

		<div class="info"><?php echo $lang_info_backend; ?></div>

	<?php } ?>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		$('.success').delay(3000).fadeOut(2000);
	});
	// ]]>
	</script>

</div>

<?php echo $footer; ?>