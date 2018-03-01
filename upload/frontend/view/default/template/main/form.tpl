<div id="cmtx_form_container" class="cmtx_form_container cmtx_clear">
	<h3 class="cmtx_form_heading"><?php echo $lang_heading_form; ?></h3>

	<div id="cmtx_preview"></div>

	<?php if ($display_form) { ?>
		<?php if ($maintenance_mode_admin) { ?>
			<div class="cmtx_maintenance_mode_admin"><?php echo $lang_text_maintenance_admin; ?></div>
		<?php } ?>

		<form id="cmtx_form" class="cmtx_form">
			<?php if ($display_javascript_disabled) { ?>
				<noscript>
					<div class="cmtx_javascript_disabled"><?php echo $lang_text_javascript_disabled; ?></div>
				</noscript>
			<?php } ?>

			<?php if ($display_required_text && $display_required_symbol) { ?>
				<div class="cmtx_required_text"><?php echo $lang_text_required; ?></div>
			<?php } ?>

			<?php if ($enabled_bb_code || $enabled_smilies) { ?>
				<div class="cmtx_row cmtx_icons_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_comment'; } ?>">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_icons_container cmtx_clear">
							<?php if ($enabled_bb_code) { ?>
								<div class="cmtx_bb_code_container">
									<?php if ($enabled_bb_code_bold) { ?><span class="cmtx_bb_code cmtx_bb_code_bold" data-cmtx-tag="<?php echo $lang_tag_bb_code_bold_start; ?>|<?php echo $lang_tag_bb_code_bold_end; ?>" title="<?php echo $lang_title_bb_code_bold; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_italic) { ?><span class="cmtx_bb_code cmtx_bb_code_italic" data-cmtx-tag="<?php echo $lang_tag_bb_code_italic_start; ?>|<?php echo $lang_tag_bb_code_italic_end; ?>" title="<?php echo $lang_title_bb_code_italic; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_underline) { ?><span class="cmtx_bb_code cmtx_bb_code_underline" data-cmtx-tag="<?php echo $lang_tag_bb_code_underline_start; ?>|<?php echo $lang_tag_bb_code_underline_end; ?>" title="<?php echo $lang_title_bb_code_underline; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_strike) { ?><span class="cmtx_bb_code cmtx_bb_code_strike" data-cmtx-tag="<?php echo $lang_tag_bb_code_strike_start; ?>|<?php echo $lang_tag_bb_code_strike_end; ?>" title="<?php echo $lang_title_bb_code_strike; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_superscript) { ?><span class="cmtx_bb_code cmtx_bb_code_superscript" data-cmtx-tag="<?php echo $lang_tag_bb_code_superscript_start; ?>|<?php echo $lang_tag_bb_code_superscript_end; ?>" title="<?php echo $lang_title_bb_code_superscript; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_subscript) { ?><span class="cmtx_bb_code cmtx_bb_code_subscript" data-cmtx-tag="<?php echo $lang_tag_bb_code_subscript_start; ?>|<?php echo $lang_tag_bb_code_subscript_end; ?>" title="<?php echo $lang_title_bb_code_subscript; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_code) { ?><span class="cmtx_bb_code cmtx_bb_code_code" data-cmtx-tag="<?php echo $lang_tag_bb_code_code_start; ?>|<?php echo $lang_tag_bb_code_code_end; ?>" title="<?php echo $lang_title_bb_code_code; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_php) { ?><span class="cmtx_bb_code cmtx_bb_code_php" data-cmtx-tag="<?php echo $lang_tag_bb_code_php_start; ?>|<?php echo $lang_tag_bb_code_php_end; ?>" title="<?php echo $lang_title_bb_code_php; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_quote) { ?><span class="cmtx_bb_code cmtx_bb_code_quote" data-cmtx-tag="<?php echo $lang_tag_bb_code_quote_start; ?>|<?php echo $lang_tag_bb_code_quote_end; ?>" title="<?php echo $lang_title_bb_code_quote; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_line) { ?><span class="cmtx_bb_code cmtx_bb_code_line" data-cmtx-tag="<?php echo $lang_tag_bb_code_line; ?>" title="<?php echo $lang_title_bb_code_line; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_bullet) { ?><span class="cmtx_bb_code cmtx_bb_code_bullet" data-cmtx-tag="dialog:|<?php echo $lang_tag_bb_code_bullet_1; ?>|<?php echo $lang_tag_bb_code_bullet_2; ?>|<?php echo $lang_tag_bb_code_bullet_3; ?>|<?php echo $lang_tag_bb_code_bullet_4; ?>" title="<?php echo $lang_title_bb_code_bullet; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_numeric) { ?><span class="cmtx_bb_code cmtx_bb_code_numeric" data-cmtx-tag="dialog:|<?php echo $lang_tag_bb_code_numeric_1; ?>|<?php echo $lang_tag_bb_code_numeric_2; ?>|<?php echo $lang_tag_bb_code_numeric_3; ?>|<?php echo $lang_tag_bb_code_numeric_4; ?>" title="<?php echo $lang_title_bb_code_numeric; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_link) { ?><span class="cmtx_bb_code cmtx_bb_code_link" data-cmtx-tag="dialog:|<?php echo $lang_tag_bb_code_link_1; ?>|<?php echo $lang_tag_bb_code_link_2; ?>|<?php echo $lang_tag_bb_code_link_3; ?>|<?php echo $lang_tag_bb_code_link_4; ?>" title="<?php echo $lang_title_bb_code_link; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_email) { ?><span class="cmtx_bb_code cmtx_bb_code_email" data-cmtx-tag="dialog:|<?php echo $lang_tag_bb_code_email_1; ?>|<?php echo $lang_tag_bb_code_email_2; ?>|<?php echo $lang_tag_bb_code_email_3; ?>|<?php echo $lang_tag_bb_code_email_4; ?>" title="<?php echo $lang_title_bb_code_email; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_image) { ?><span class="cmtx_bb_code cmtx_bb_code_image" data-cmtx-tag="dialog:|<?php echo $lang_tag_bb_code_image_1; ?>|<?php echo $lang_tag_bb_code_image_2; ?>" title="<?php echo $lang_title_bb_code_image; ?>"></span><?php } ?>
									<?php if ($enabled_bb_code_youtube) { ?><span class="cmtx_bb_code cmtx_bb_code_youtube" data-cmtx-tag="dialog:|<?php echo $lang_tag_bb_code_youtube_1; ?>|<?php echo $lang_tag_bb_code_youtube_2; ?>" title="<?php echo $lang_title_bb_code_youtube; ?>"></span><?php } ?>
								</div>
							<?php } ?>

							<?php if ($enabled_bb_code && $enabled_smilies) { ?>
								<div class="cmtx_icons_separator"></div>
							<?php } ?>

							<?php if ($enabled_smilies) { ?>
								<div class="cmtx_smilies_container">
									<?php if ($enabled_smilies_smile) { ?><span class="cmtx_smiley cmtx_smiley_smile" data-cmtx-tag="<?php echo $lang_tag_smiley_smile; ?>" title="<?php echo $lang_title_smiley_smile; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_sad) { ?><span class="cmtx_smiley cmtx_smiley_sad" data-cmtx-tag="<?php echo $lang_tag_smiley_sad; ?>" title="<?php echo $lang_title_smiley_sad; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_huh) { ?><span class="cmtx_smiley cmtx_smiley_huh" data-cmtx-tag="<?php echo $lang_tag_smiley_huh; ?>" title="<?php echo $lang_title_smiley_huh; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_laugh) { ?><span class="cmtx_smiley cmtx_smiley_laugh" data-cmtx-tag="<?php echo $lang_tag_smiley_laugh; ?>" title="<?php echo $lang_title_smiley_laugh; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_mad) { ?><span class="cmtx_smiley cmtx_smiley_mad" data-cmtx-tag="<?php echo $lang_tag_smiley_mad; ?>" title="<?php echo $lang_title_smiley_mad; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_tongue) { ?><span class="cmtx_smiley cmtx_smiley_tongue" data-cmtx-tag="<?php echo $lang_tag_smiley_tongue; ?>" title="<?php echo $lang_title_smiley_tongue; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_cry) { ?><span class="cmtx_smiley cmtx_smiley_cry" data-cmtx-tag="<?php echo $lang_tag_smiley_cry; ?>" title="<?php echo $lang_title_smiley_cry; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_grin) { ?><span class="cmtx_smiley cmtx_smiley_grin" data-cmtx-tag="<?php echo $lang_tag_smiley_grin; ?>" title="<?php echo $lang_title_smiley_grin; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_wink) { ?><span class="cmtx_smiley cmtx_smiley_wink" data-cmtx-tag="<?php echo $lang_tag_smiley_wink; ?>" title="<?php echo $lang_title_smiley_wink; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_scared) { ?><span class="cmtx_smiley cmtx_smiley_scared" data-cmtx-tag="<?php echo $lang_tag_smiley_scared; ?>" title="<?php echo $lang_title_smiley_scared; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_cool) { ?><span class="cmtx_smiley cmtx_smiley_cool" data-cmtx-tag="<?php echo $lang_tag_smiley_cool; ?>" title="<?php echo $lang_title_smiley_cool; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_sleep) { ?><span class="cmtx_smiley cmtx_smiley_sleep" data-cmtx-tag="<?php echo $lang_tag_smiley_sleep; ?>" title="<?php echo $lang_title_smiley_sleep; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_blush) { ?><span class="cmtx_smiley cmtx_smiley_blush" data-cmtx-tag="<?php echo $lang_tag_smiley_blush; ?>" title="<?php echo $lang_title_smiley_blush; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_confused) { ?><span class="cmtx_smiley cmtx_smiley_confused" data-cmtx-tag="<?php echo $lang_tag_smiley_confused; ?>" title="<?php echo $lang_title_smiley_confused; ?>"></span><?php } ?>
									<?php if ($enabled_smilies_shocked) { ?><span class="cmtx_smiley cmtx_smiley_shocked" data-cmtx-tag="<?php echo $lang_tag_smiley_shocked; ?>" title="<?php echo $lang_title_smiley_shocked; ?>"></span><?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>

			<div class="cmtx_row cmtx_comment_row cmtx_clear">
				<div class="cmtx_col_12">
					<div class="cmtx_container cmtx_comment_container">
						<textarea name="cmtx_comment" id="cmtx_comment" class="cmtx_field cmtx_textarea_field cmtx_comment_field <?php echo $comment_symbol; ?>" placeholder="<?php echo $lang_placeholder_comment; ?>" title="<?php echo $lang_title_comment; ?>" maxlength="<?php echo $comment_maximum_characters; ?>"><?php echo $comment; ?></textarea>
					</div>
				</div>
			</div>

			<?php if ($enabled_counter) { ?>
				<div class="cmtx_row cmtx_counter_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_comment'; } ?>">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_counter_container">
							<span id="cmtx_counter" class="cmtx_counter"><?php echo $comment_maximum_characters; ?></span>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if ($enabled_upload) { ?>
				<div class="cmtx_row cmtx_upload_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_comment'; } ?>">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_upload_container">
							<input type="file" name="cmtx_files[]" id="filer_input" multiple="multiple" accept="image/*">
						</div>
					</div>
				</div>

				<div class="cmtx_row cmtx_image_row cmtx_clear" style="display:none">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_image_container"></div>
					</div>
				</div>
			<?php } ?>

			<div class="cmtx_row cmtx_user_row cmtx_clear <?php if (!$user_row_visible) { echo 'cmtx_hide'; } ?>">
				<?php if ($enabled_name) { ?>
					<div class="<?php echo 'cmtx_col_' . $user_column_size; ?>">
						<div class="cmtx_container cmtx_name_container">
							<input type="text" name="cmtx_name" id="cmtx_name" class="cmtx_field cmtx_text_field cmtx_name_field <?php echo $name_symbol; ?>" value="<?php echo $name; ?>" placeholder="<?php echo $lang_placeholder_name; ?>" title="<?php echo $lang_title_name; ?>" maxlength="<?php echo $maximum_name; ?>" <?php if ($name_is_filled && $filled_name_action == 'disable') { echo 'readonly'; } ?>>
						</div>
					</div>
				<?php } ?>

				<?php if ($enabled_email) { ?>
					<div class="<?php echo 'cmtx_col_' . $user_column_size; ?>">
						<div class="cmtx_container cmtx_email_container">
							<input type="email" name="cmtx_email" id="cmtx_email" class="cmtx_field cmtx_text_field cmtx_email_field <?php echo $email_symbol; ?>" value="<?php echo $email; ?>" placeholder="<?php echo $lang_placeholder_email; ?>" title="<?php echo $lang_title_email; ?>" maxlength="<?php echo $maximum_email; ?>" <?php if ($email_is_filled && $filled_email_action == 'disable') { echo 'readonly'; } ?>>
						</div>
					</div>
				<?php } ?>
			</div>

			<?php if ($enabled_rating) { ?>
				<div class="cmtx_row cmtx_rating_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_user'; } ?>">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_rating_container">
							<div id="cmtx_rating" class="cmtx_rating <?php echo $rating_symbol; ?>">
								<div class="cmtx_rating_block">
									<input type="radio" id="cmtx_star_5" name="cmtx_rating" value="5" <?php if ($default_rating == '5') { echo 'checked'; } ?>><label for="cmtx_star_5" title="<?php echo $lang_title_rating_5; ?>"></label>
									<input type="radio" id="cmtx_star_4" name="cmtx_rating" value="4" <?php if ($default_rating == '4') { echo 'checked'; } ?>><label for="cmtx_star_4" title="<?php echo $lang_title_rating_4; ?>"></label>
									<input type="radio" id="cmtx_star_3" name="cmtx_rating" value="3" <?php if ($default_rating == '3') { echo 'checked'; } ?>><label for="cmtx_star_3" title="<?php echo $lang_title_rating_3; ?>"></label>
									<input type="radio" id="cmtx_star_2" name="cmtx_rating" value="2" <?php if ($default_rating == '2') { echo 'checked'; } ?>><label for="cmtx_star_2" title="<?php echo $lang_title_rating_2; ?>"></label>
									<input type="radio" id="cmtx_star_1" name="cmtx_rating" value="1" <?php if ($default_rating == '1') { echo 'checked'; } ?>><label for="cmtx_star_1" title="<?php echo $lang_title_rating_1; ?>"></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if ($enabled_website) { ?>
				<div class="cmtx_row cmtx_website_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_user'; } ?>">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_website_container">
							<input type="url" name="cmtx_website" id="cmtx_website" class="cmtx_field cmtx_text_field cmtx_website_field <?php echo $website_symbol; ?>" value="<?php echo $website; ?>" placeholder="<?php echo $lang_placeholder_website; ?>" title="<?php echo $lang_title_website; ?>" maxlength="<?php echo $maximum_website; ?>" <?php if ($website_is_filled && $filled_website_action == 'disable') { echo 'readonly'; } ?>>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if ($enabled_town || $enabled_country || $enabled_state ) { ?>
				<div class="cmtx_row cmtx_geo_row cmtx_clear <?php if (!$geo_row_visible) { echo 'cmtx_hide'; } else if ($hide_form) { echo 'cmtx_wait_for_user'; } ?>">
					<?php if ($enabled_town) { ?>
						<div class="<?php echo 'cmtx_col_' . $geo_column_size; ?>">
							<div class="cmtx_container cmtx_town_container">
								<input type="text" name="cmtx_town" id="cmtx_town" class="cmtx_field cmtx_text_field cmtx_town_field <?php echo $town_symbol; ?>" value="<?php echo $town; ?>" placeholder="<?php echo $lang_placeholder_town; ?>" title="<?php echo $lang_title_town; ?>" maxlength="<?php echo $maximum_town; ?>" <?php if ($town_is_filled && $filled_town_action == 'disable') { echo 'readonly'; } ?>>
							</div>
						</div>
					<?php } ?>

					<?php if ($enabled_country) { ?>
						<div class="<?php echo 'cmtx_col_' . $geo_column_size; ?>">
							<div class="cmtx_container cmtx_country_container">
								<select name="cmtx_country" id="cmtx_country" class="cmtx_field cmtx_select_field cmtx_country_field <?php echo $country_symbol; ?>" title="<?php echo $lang_title_country; ?>" <?php if ($country_is_filled && $filled_country_action == 'disable') { echo 'disabled'; } ?>>
									<option value="" hidden><?php echo $lang_placeholder_country; ?></option>
									<?php foreach ($countries as $country) { ?>
										<option value="<?php echo $country['id']; ?>"<?php if ($country['id'] && $country['id'] == $country_id) { echo ' selected'; } ?><?php if ($country['name'] == '---') { echo ' disabled'; } ?>><?php echo $country['name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($enabled_state) { ?>
						<div class="<?php echo 'cmtx_col_' . $geo_column_size; ?>">
							<div class="cmtx_container cmtx_state_container">
								<select name="cmtx_state" id="cmtx_state" class="cmtx_field cmtx_select_field cmtx_state_field <?php echo $state_symbol; ?>" title="<?php echo $lang_title_state; ?>" <?php if ($state_is_filled && $filled_state_action == 'disable') { echo 'disabled'; } ?>>
									<option value="" hidden><?php echo $lang_placeholder_state; ?></option>
									<?php foreach ($states as $state) { ?>
										<option value="<?php echo $state['id']; ?>" <?php if ($state && $state['id'] == $state_id) { echo 'selected'; } ?>><?php echo $state['name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if ($question) { ?>
				<div class="cmtx_row cmtx_question_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_user'; } ?>">
					<div class="cmtx_col_6">
						<div class="cmtx_container cmtx_question_container">
							<div id="cmtx_question" class="cmtx_field cmtx_text_field cmtx_question_field"><?php echo $question; ?></div>
						</div>
					</div>

					<div class="cmtx_col_6">
						<div class="cmtx_container cmtx_answer_container">
							<input type="text" name="cmtx_answer" id="cmtx_answer" class="cmtx_field cmtx_text_field cmtx_answer_field <?php echo $answer_symbol; ?>" value="" placeholder="<?php echo $lang_placeholder_answer; ?>" title="<?php echo $lang_title_answer; ?>" maxlength="250">
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if ($recaptcha) { ?>
				<div class="cmtx_row cmtx_recaptcha_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_user'; } ?>">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_recaptcha_container">
							<div id="g-recaptcha" class="g-recaptcha" data-sitekey="<?php echo $recaptcha_public_key; ?>" data-theme="<?php echo $recaptcha_theme; ?>" data-type="<?php echo $recaptcha_type; ?>" data-size="<?php echo $recaptcha_size; ?>"></div>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if ($securimage) { ?>
				<div class="cmtx_row cmtx_securimage_row cmtx_clear <?php if ($hide_form) { echo 'cmtx_wait_for_user'; } ?>">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_securimage_container">
							<div>
								<img id="cmtx_securimage_image" src="<?php echo $securimage_url; ?>securimage_show.php?namespace=<?php echo $captcha_namespace; ?>" alt="<?php echo $lang_alt_securimage; ?>">

								<span id="cmtx_securimage_refresh" class="cmtx_securimage_refresh fa fa-refresh" title="<?php echo $lang_title_refresh; ?>"></span>
							</div>

							<div><input type="text" name="cmtx_securimage" id="cmtx_securimage" class="cmtx_field cmtx_securimage_field <?php echo $answer_symbol; ?>" placeholder="<?php echo $lang_placeholder_securimage; ?>" title="<?php echo $lang_title_securimage; ?>" maxlength="<?php echo $maximum_securimage; ?>"></div>
						</div>
					</div>
				</div>
			<?php } ?>

			<div class="cmtx_checkbox_container <?php if ($hide_form) { echo 'cmtx_wait_for_user'; } ?>">
				<?php if ($enabled_notify && $enabled_email) { ?>
					<div class="cmtx_row cmtx_notify_row cmtx_clear">
						<div class="cmtx_col_12">
							<div class="cmtx_container cmtx_notify_container">
								<input type="checkbox" id="cmtx_notify" name="cmtx_notify" value="1" <?php if ($default_notify) { echo 'checked'; } ?>> <label for="cmtx_notify"><?php echo $lang_entry_notify; ?></label>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if ($enabled_cookie) { ?>
					<div class="cmtx_row cmtx_cookie_row cmtx_clear">
						<div class="cmtx_col_12">
							<div class="cmtx_container cmtx_cookie_container">
								<input type="checkbox" id="cmtx_cookie" name="cmtx_cookie" value="1" <?php if ($default_cookie) { echo 'checked'; } ?>> <label for="cmtx_cookie"><?php echo $lang_entry_cookie; ?></label>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if ($enabled_privacy) { ?>
					<div class="cmtx_row cmtx_privacy_row cmtx_clear">
						<div class="cmtx_col_12">
							<div class="cmtx_container cmtx_privacy_container">
								<input type="checkbox" id="cmtx_privacy" name="cmtx_privacy" value="1"> <label for="cmtx_privacy"><?php echo $lang_entry_privacy; ?></label>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if ($enabled_terms) { ?>
					<div class="cmtx_row cmtx_terms_row cmtx_clear">
						<div class="cmtx_col_12">
							<div class="cmtx_container cmtx_terms_container">
								<input type="checkbox" id="cmtx_terms" name="cmtx_terms" value="1"> <label for="cmtx_terms"><?php echo $lang_entry_terms; ?></label>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<div class="cmtx_row cmtx_button_row cmtx_clear">
				<div class="cmtx_col_2">
					<div class="cmtx_container cmtx_submit_button_container">
						<input type="button" id="cmtx_submit_button" class="cmtx_button cmtx_submit_button <?php if ($is_admin) { echo 'cmtx_admin_button'; } ?>" data-cmtx-type="submit" value="<?php echo $lang_button_submit; ?>" title="<?php echo $lang_button_submit; ?>">
					</div>
				</div>

				<div class="cmtx_col_2">
					<?php if ($enabled_preview) { ?>
						<div class="cmtx_container cmtx_preview_button_container">
							<input type="button" id="cmtx_preview_button" class="cmtx_button cmtx_preview_button <?php if ($is_admin) { echo 'cmtx_admin_button'; } ?>" data-cmtx-type="preview" value="<?php echo $lang_button_preview; ?>" title="<?php echo $lang_button_preview; ?>">
						</div>
					<?php } ?>
				</div>

				<div class="cmtx_col_8"></div>
			</div>

			<?php if ($enabled_powered_by) { ?>
				<div class="cmtx_row cmtx_powered_by_row cmtx_clear">
					<div class="cmtx_col_12">
						<div class="cmtx_container cmtx_powered_by_container">
							<div class="cmtx_powered_by"><?php echo $powered_by; ?></div>
						</div>
					</div>
				</div>
			<?php } ?>

			<input type="hidden" name="cmtx_reply_to" value="">

			<input type="hidden" id="cmtx_hidden_data" value="<?php echo $hidden_data; ?>">

			<input type="hidden" name="cmtx_subscribe" value="">

			<input type="hidden" name="cmtx_time" value="<?php echo $time; ?>">

			<input type="text" name="cmtx_honeypot" class="cmtx_honeypot" value="" autocomplete="off">
		</form>

		<?php if ($enabled_bb_code_bullet) { ?>
			<div id="cmtx_dialog_bullet" class="cmtx_dialog cmtx_dialog_bullet" title="<?php echo $lang_dialog_bullet_heading; ?>" style="display:none">
				<div><?php echo $lang_dialog_bullet_content; ?></div>
				<div><span><?php echo $lang_dialog_bullet_item; ?></span> <input type="text" id="cmtx_dialog_bullet_field_1"></div>
				<div><span><?php echo $lang_dialog_bullet_item; ?></span> <input type="text" id="cmtx_dialog_bullet_field_2"></div>
				<div><span><?php echo $lang_dialog_bullet_item; ?></span> <input type="text" id="cmtx_dialog_bullet_field_3"></div>
				<div><span><?php echo $lang_dialog_bullet_item; ?></span> <input type="text" id="cmtx_dialog_bullet_field_4"></div>
				<div><span><?php echo $lang_dialog_bullet_item; ?></span> <input type="text" id="cmtx_dialog_bullet_field_5"></div>
			</div>
		<?php } ?>

		<?php if ($enabled_bb_code_numeric) { ?>
			<div id="cmtx_dialog_numeric" class="cmtx_dialog cmtx_dialog_numeric" title="<?php echo $lang_dialog_numeric_heading; ?>" style="display:none">
				<div><?php echo $lang_dialog_numeric_content; ?></div>
				<div><span><?php echo $lang_dialog_numeric_item; ?></span> <input type="text" id="cmtx_dialog_numeric_field_1"></div>
				<div><span><?php echo $lang_dialog_numeric_item; ?></span> <input type="text" id="cmtx_dialog_numeric_field_2"></div>
				<div><span><?php echo $lang_dialog_numeric_item; ?></span> <input type="text" id="cmtx_dialog_numeric_field_3"></div>
				<div><span><?php echo $lang_dialog_numeric_item; ?></span> <input type="text" id="cmtx_dialog_numeric_field_4"></div>
				<div><span><?php echo $lang_dialog_numeric_item; ?></span> <input type="text" id="cmtx_dialog_numeric_field_5"></div>
			</div>
		<?php } ?>

		<?php if ($enabled_bb_code_link) { ?>
			<div id="cmtx_dialog_link" class="cmtx_dialog cmtx_dialog_link" title="<?php echo $lang_dialog_link_heading; ?>" style="display:none">
				<div><?php echo $lang_dialog_link_content_1; ?></div> <input type="url" id="cmtx_dialog_link_field_1" value="http://">
				<div><?php echo $lang_dialog_link_content_2; ?></div> <input type="text" id="cmtx_dialog_link_field_2">
			</div>
		<?php } ?>

		<?php if ($enabled_bb_code_email) { ?>
			<div id="cmtx_dialog_email" class="cmtx_dialog cmtx_dialog_email" title="<?php echo $lang_dialog_email_heading; ?>" style="display:none">
				<div><?php echo $lang_dialog_email_content_1; ?></div> <input type="email" id="cmtx_dialog_email_field_1">
				<div><?php echo $lang_dialog_email_content_2; ?></div> <input type="text" id="cmtx_dialog_email_field_2">
			</div>
		<?php } ?>

		<?php if ($enabled_bb_code_image) { ?>
			<div id="cmtx_dialog_image" class="cmtx_dialog cmtx_dialog_image" title="<?php echo $lang_dialog_image_heading; ?>" style="display:none">
				<div><?php echo $lang_dialog_image_content; ?></div> <input type="url" id="cmtx_dialog_image_field" value="http://">
			</div>
		<?php } ?>

		<?php if ($enabled_bb_code_youtube) { ?>
			<div id="cmtx_dialog_youtube" class="cmtx_dialog cmtx_dialog_youtube" title="<?php echo $lang_dialog_youtube_heading; ?>" style="display:none">
				<div><?php echo $lang_dialog_youtube_content; ?></div> <input type="url" id="cmtx_dialog_youtube_field" value="http://">
			</div>
		<?php } ?>

		<?php if ($enabled_privacy) { ?>
			<div id="cmtx_privacy_content" style="display:none">
				<?php echo $lang_text_privacy; ?>
			</div>
		<?php } ?>

		<?php if ($enabled_terms) { ?>
			<div id="cmtx_terms_content" style="display:none">
				<?php echo $lang_text_terms; ?>
			</div>
		<?php } ?>

		<script>cmtx_js_settings_form = <?php echo json_encode($cmtx_js_settings_form); ?>;</script>
	<?php } else { ?>
		<div class="cmtx_form_disabled"><?php echo $lang_error_form_disabled; ?></div>
	<?php } ?>
</div>