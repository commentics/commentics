<div class="cmtx_pagination_block">
	<div class="cmtx_pagination_container">
		<?php if ($current_page > 1) { ?>
			<a href="<?php echo $pagination_url . 1; ?>" class="cmtx_pagination_url"><span class="cmtx_pagination_box" title="<?php echo $lang_title_first; ?>" data-cmtx-page="1"><?php echo $lang_link_first; ?></span></a>

			<a href="<?php echo $pagination_url . ($current_page - 1); ?>" class="cmtx_pagination_url"><span class="cmtx_pagination_box" title="<?php echo $lang_title_previous; ?>" data-cmtx-page="<?php echo $current_page - 1; ?>"><?php echo $lang_link_previous; ?></span></a>
		<?php } ?>

		<?php if ($total_pages > 1) { ?>
			<?php for ($i = $start; $i <= $end; $i++) { ?>
				<a href="<?php echo $pagination_url . $i; ?>" class="cmtx_pagination_url"><span class="cmtx_pagination_box <?php if ($current_page == $i) { echo 'cmtx_pagination_box_active'; } ?>" title="<?php echo $i; ?>" data-cmtx-page="<?php echo $i; ?>"><?php echo $i; ?></span></a>
			<?php } ?>
		<?php } else { ?>
			&nbsp;
		<?php } ?>

		<?php if ($current_page < $total_pages) { ?>
			<a href="<?php echo $pagination_url . ($current_page + 1); ?>" class="cmtx_pagination_url"><span class="cmtx_pagination_box" title="<?php echo $lang_title_next; ?>" data-cmtx-page="<?php echo $current_page + 1; ?>"><?php echo $lang_link_next; ?></span></a>

			<a href="<?php echo $pagination_url . $total_pages; ?>" class="cmtx_pagination_url"><span class="cmtx_pagination_box" title="<?php echo $lang_title_last; ?>" data-cmtx-page="<?php echo $total_pages; ?>"><?php echo $lang_link_last; ?></span></a>
		<?php } ?>
	</div>
</div>