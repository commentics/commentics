<div id="cmtx_perm_<?php echo $comment['id']; ?>" class="cmtx_comment_box cmtx_clear" data-cmtx-comment-id="<?php echo $comment['id']; ?>">
	<div class="cmtx_content_area" style="margin-left:<?php echo $reply_depth * $reply_indent; ?>px">
		<?php if ($show_gravatar) { ?>
			<div class="cmtx_gravatar_area">
				<div>
					<img src="<?php echo $comment['gravatar']; ?>" class="cmtx_gravatar" alt="Gravatar">

					<?php if ($show_level && $comment['level']) { ?>
						<div class="cmtx_level"><?php echo $comment['level']; ?></div>
					<?php } ?>
				</div>

				<?php if ($show_bio) { ?>
					<div class="cmtx_bio">
						<div class="cmtx_bio_name <?php if ($comment['is_admin']) { echo 'cmtx_name_admin'; } ?>"><?php echo $comment['name']; ?></div>

						<img src="<?php echo $comment['gravatar_bio']; ?>" class="cmtx_gravatar_bio" alt="Gravatar">

						<div class="cmtx_bio_info">
							<div class="cmtx_bio_info_comments"><label><?php echo $lang_text_bio_info_comments; ?></label> <span><?php echo $comment['bio_info_comments']; ?></span></div>

							<?php if ($show_like) { ?>
								<div class="cmtx_bio_info_likes"><label><?php echo $lang_text_bio_info_likes; ?></label> <span><?php echo $comment['bio_info_likes']; ?></span></div>
							<?php } ?>

							<?php if ($show_dislike) { ?>
								<div class="cmtx_bio_info_dislikes"><label><?php echo $lang_text_bio_info_dislikes; ?></label> <span><?php echo $comment['bio_info_dislikes']; ?></span></div>
							<?php } ?>

							<div class="cmtx_bio_info_since"><label><?php echo $lang_text_bio_info_since; ?></label> <span><?php echo $comment['bio_info_since']; ?></span></div>
						</div>

					<?php if ($comment['top_poster']) { ?>
						<div class="cmtx_badge">
							<div class="fa fa-star cmtx_badge_star_left" aria-hidden="true"></div>
							<div>Top Poster</div>
							<div class="fa fa-star cmtx_badge_star_right" aria-hidden="true"></div>
						</div>
					<?php } ?>

					<?php if ($show_like && $comment['most_likes']) { ?>
						<div class="cmtx_badge">
							<div class="fa fa-star cmtx_badge_star_left" aria-hidden="true"></div>
							<div>Most Likes</div>
							<div class="fa fa-star cmtx_badge_star_right" aria-hidden="true"></div>
						</div>
					<?php } ?>

					<?php if ($comment['first_poster']) { ?>
						<div class="cmtx_badge">
							<div class="fa fa-star cmtx_badge_star_left" aria-hidden="true"></div>
							<div>First Poster</div>
							<div class="fa fa-star cmtx_badge_star_right" aria-hidden="true"></div>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="cmtx_main_area">
			<?php if ($comment['is_sticky']) { ?>
				<div class="cmtx_sticky" title="<?php echo $lang_title_sticky; ?>"><div class="cmtx_sticky_icon"></div></div>
			<?php } ?>

			<div class="cmtx_user_and_rating_area">
				<?php if ($show_rating && $comment['rating']) { ?>
					<div class="cmtx_rating_area">
						<?php for ($i = 0; $i < 5; $i++) { ?>
							<?php if ($i < $comment['rating']) { ?>
								<span class="cmtx_star cmtx_star_full"></span>
							<?php } else { ?>
								<span class="cmtx_star cmtx_star_empty"></span>
							<?php } ?>
						<?php } ?>
					</div>
				<?php } ?>

				<div class="cmtx_user_area">
					<span class="cmtx_name <?php if ($comment['is_admin']) { echo 'cmtx_name_admin'; } ?>">
						<?php if ($show_website && $comment['website']) { ?>
							<a href="<?php echo $comment['website']; ?>" <?php if ($website_new_window) { echo 'target="_blank"'; } ?> <?php if ($website_no_follow) { echo 'rel="nofollow"'; } ?>><span class="cmtx_name_text"><?php echo $comment['name']; ?></span></a>
						<?php } else { ?>
							<span class="cmtx_name_text"><?php echo $comment['name']; ?></span>
						<?php } ?>
					</span>

					<?php if ($comment['location']) { ?>
						<span class="cmtx_geo">
							(<?php echo $comment['location']; ?>)
						</span>
					<?php } ?>

					<?php if ($show_says) { ?>
						<span class="cmtx_says">
							<?php echo $lang_text_says; ?>
						</span>
					<?php } ?>
				</div>
			</div>

			<div class="cmtx_comment_area">
				<?php echo $comment['comment']; ?>
			</div>

			<?php if ($comment['reply']) { ?>
				<div class="cmtx_reply_area">
					<span class="cmtx_admin_reply"><?php echo $lang_text_admin; ?>:</span> <?php echo $comment['reply']; ?>
				</div>
			<?php } ?>

			<?php if ($comment['uploads']) { ?>
				<div class="cmtx_upload_area">
					<?php foreach ($comment['uploads'] as $upload) { ?>
						<a href="<?php echo $upload['image']; ?>" data-cmtx-rel="cmtx_rel_<?php echo $comment['id']; ?>"><img src="<?php echo $upload['image']; ?>" class="cmtx_upload" alt="Upload"></a>
					<?php } ?>
				</div>
			<?php } ?>

			<div class="cmtx_date_and_action_area">
				<?php if ($show_date) { ?>
					<div class="cmtx_date_area">
						<?php if ($date_auto) { ?>
							<time class="cmtx_date timeago" datetime="<?php echo $comment['date_added']; ?>" title="<?php echo $comment['date_added_title']; ?>"><?php echo $comment['date_added_title']; ?></time>
						<?php } else { ?>
							<time class="cmtx_date"><?php echo $comment['date_added']; ?></time>
						<?php } ?>
					</div>
				<?php } ?>

				<div class="cmtx_action_area">
					<?php if ($is_preview) { ?>
						<span class="cmtx_preview_text"><?php echo $lang_text_preview_only; ?></span>
					<?php } else { ?>
						<?php if ($show_like) { ?>
							<div class="cmtx_like_area">
								<a href="#" class="cmtx_vote_link cmtx_like_link" title="<?php echo $lang_title_like; ?>">
									<span class="cmtx_icon cmtx_like_icon"></span>
									<span class="cmtx_vote_count cmtx_like_count"><?php echo $comment['likes']; ?></span>
								</a>
							</div>
						<?php } ?>

						<?php if ($show_dislike) { ?>
							<div class="cmtx_dislike_area">
								<a href="#" class="cmtx_vote_link cmtx_dislike_link" title="<?php echo $lang_title_dislike; ?>">
									<span class="cmtx_icon cmtx_dislike_icon"></span>
									<span class="cmtx_vote_count cmtx_dislike_count"><?php echo $comment['dislikes']; ?></span>
								</a>
							</div>
						<?php } ?>

						<?php if ($show_share) { ?>
							<div class="cmtx_share_area" title="<?php echo $lang_title_share; ?>">
								<a href="#" class="cmtx_share_link" data-cmtx-sharelink="<?php echo $comment['permalink']; ?>">
									<span class="cmtx_icon cmtx_share_icon"></span>
								</a>
							</div>
						<?php } ?>

						<?php if ($show_flag) { ?>
							<div class="cmtx_flag_area">
								<a href="#" class="cmtx_flag_link" title="<?php echo $lang_title_report; ?>">
									<span class="cmtx_icon cmtx_flag_icon"></span>
								</a>
							</div>
						<?php } ?>

						<?php if ($show_permalink) { ?>
							<div class="cmtx_permalink_area">
								<a href="#" class="cmtx_permalink_link" title="<?php echo $lang_title_permalink; ?>" data-cmtx-permalink="<?php echo $comment['permalink']; ?>">
									<span class="cmtx_icon cmtx_permalink_icon"></span>
								</a>
							</div>
						<?php } ?>

						<?php if ($show_reply && !$comment['is_locked'] && $reply_depth < $reply_max_depth) { ?>
							<div class="cmtx_reply_area">
								<a href="#" class="cmtx_reply_link" title="<?php echo $lang_title_reply; ?>">
									<span class="cmtx_icon cmtx_reply_icon"></span>
								</a>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php if ($has_replies && !$reply_depth && $hide_replies) { ?>
			<div class="cmtx_view_replies_area">
				<a href="#" class="cmtx_view_replies_link" title="View replies"></a>
			</div>
		<?php } ?>
	</div>

	<script>
	// <![CDATA[
	$(document).ready(function() {
		<?php
		if ($reply_num == 1) {
			$reply_text = $lang_text_view . ' <span class="cmtx_reply_num">1</span> ' . $lang_text_reply;
		} else {
			$reply_text = $lang_text_view . ' <span class="cmtx_reply_num">' . $reply_num . '</span> ' . $lang_text_replies;
		}
		?>

	   	$('#cmtx_perm_<?php echo $comment["id"]; ?>').closest('.cmtx_replies_group').prev().find('.cmtx_view_replies_link').html('<?php echo $reply_text; ?>');
	});
	// ]]>
	</script>
</div>