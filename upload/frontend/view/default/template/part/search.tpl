<div class="cmtx_search_block">
	<div class="cmtx_search_container">
		<input type="search" name="cmtx_search" id="cmtx_search" class="cmtx_search" value="<?php echo $search; ?>" placeholder="<?php echo $lang_placeholder_search; ?>" title="<?php echo $lang_title_search_field; ?>">

		<span class="fa fa-search" title="<?php echo $lang_title_search_icon; ?>"></span>
	</div>
</div>

<script>
// <![CDATA[
$(document).ready(function() {
	if ($('#cmtx_search').val() != '') {
		$('#cmtx_search').addClass('cmtx_search_focus');
	};
});
// ]]>
</script>

<script>
// <![CDATA[
$(document).ready(function() {
	$('#cmtx_search').focus(function() {
		$('#cmtx_search').addClass('cmtx_search_focus');
	});
});
// ]]>
</script>

<script>
// <![CDATA[
$(document).ready(function() {
	$('.cmtx_search_container .fa-search').click(function(e) {
		e.preventDefault();

		var options = {
			'commentics_url'	: '<?php echo $commentics_url; ?>',
			'page_id'			: '<?php echo $page_id; ?>',
			'page_number'	  	: '',
			'effect'			: true
		}

		cmtxRefreshComments(options);
	});
});
// ]]>
</script>

<script>
// <![CDATA[
$(document).ready(function() {
	$('#cmtx_search').on('keypress', function(e) {
		if (e.which == 13) {
			$('.cmtx_search_container .fa-search').trigger('click');
		}
	});
});
// ]]>
</script>