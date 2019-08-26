<div id="cmtx_form_container" class="cmtx_form_container cmtx_clear">
    <h3 class="cmtx_form_heading">{{ lang_heading_form }}</h3>

    <div id="cmtx_preview"></div>

    @if display_form
        @if maintenance_mode_admin
            <div class="cmtx_maintenance_mode_admin">{{ lang_text_maintenance_admin }}</div>
        @endif

        <form id="cmtx_form" class="cmtx_form">
            @if display_javascript_disabled
                <noscript>
                    <div class="cmtx_javascript_disabled">{{ lang_text_javascript_disabled }}</div>
                </noscript>
            @endif

            @if display_required_text and display_required_symbol
                <div class="cmtx_required_text">{{ lang_text_required }}</div>
            @endif

            @if enabled_bb_code or enabled_smilies
                <div class="cmtx_row cmtx_icons_row cmtx_clear {{ cmtx_wait_for_comment }}" role="toolbar">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_icons_container cmtx_clear">
                            @if enabled_bb_code
                                <div class="cmtx_bb_code_container">
                                    @if enabled_bb_code_bold
                                        <span class="cmtx_bb_code cmtx_bb_code_bold" data-cmtx-tag="{{ lang_tag_bb_code_bold }}" title="{{ lang_title_bb_code_bold }}"></span>
                                    @endif

                                    @if enabled_bb_code_italic
                                        <span class="cmtx_bb_code cmtx_bb_code_italic" data-cmtx-tag="{{ lang_tag_bb_code_italic }}" title="{{ lang_title_bb_code_italic }}"></span>
                                    @endif

                                    @if enabled_bb_code_underline
                                        <span class="cmtx_bb_code cmtx_bb_code_underline" data-cmtx-tag="{{ lang_tag_bb_code_underline }}" title="{{ lang_title_bb_code_underline }}"></span>
                                    @endif

                                    @if enabled_bb_code_strike
                                        <span class="cmtx_bb_code cmtx_bb_code_strike" data-cmtx-tag="{{ lang_tag_bb_code_strike }}" title="{{ lang_title_bb_code_strike }}"></span>
                                    @endif

                                    @if enabled_bb_code_superscript
                                        <span class="cmtx_bb_code cmtx_bb_code_superscript" data-cmtx-tag="{{ lang_tag_bb_code_superscript }}" title="{{ lang_title_bb_code_superscript }}"></span>
                                    @endif

                                    @if enabled_bb_code_subscript
                                        <span class="cmtx_bb_code cmtx_bb_code_subscript" data-cmtx-tag="{{ lang_tag_bb_code_subscript }}" title="{{ lang_title_bb_code_subscript }}"></span>
                                    @endif

                                    @if enabled_bb_code_code
                                        <span class="cmtx_bb_code cmtx_bb_code_code" data-cmtx-tag="{{ lang_tag_bb_code_code }}" title="{{ lang_title_bb_code_code }}"></span>
                                    @endif

                                    @if enabled_bb_code_php
                                        <span class="cmtx_bb_code cmtx_bb_code_php" data-cmtx-tag="{{ lang_tag_bb_code_php }}" title="{{ lang_title_bb_code_php }}"></span>
                                    @endif

                                    @if enabled_bb_code_quote
                                        <span class="cmtx_bb_code cmtx_bb_code_quote" data-cmtx-tag="{{ lang_tag_bb_code_quote }}" title="{{ lang_title_bb_code_quote }}"></span>
                                    @endif

                                    @if enabled_bb_code_line
                                        <span class="cmtx_bb_code cmtx_bb_code_line" data-cmtx-tag="{{ lang_tag_bb_code_line }}" title="{{ lang_title_bb_code_line }}"></span>
                                    @endif

                                    @if enabled_bb_code_bullet
                                        <span class="cmtx_bb_code cmtx_bb_code_bullet" data-cmtx-tag="{{ lang_tag_bb_code_bullet }}" title="{{ lang_title_bb_code_bullet }}" data-cmtx-target-modal="#cmtx_bullet_modal"></span>
                                    @endif

                                    @if enabled_bb_code_numeric
                                        <span class="cmtx_bb_code cmtx_bb_code_numeric" data-cmtx-tag="{{ lang_tag_bb_code_numeric }}" title="{{ lang_title_bb_code_numeric }}" data-cmtx-target-modal="#cmtx_numeric_modal"></span>
                                    @endif

                                    @if enabled_bb_code_link
                                        <span class="cmtx_bb_code cmtx_bb_code_link" data-cmtx-tag="{{ lang_tag_bb_code_link }}" title="{{ lang_title_bb_code_link }}" data-cmtx-target-modal="#cmtx_link_modal"></span>
                                    @endif

                                    @if enabled_bb_code_email
                                        <span class="cmtx_bb_code cmtx_bb_code_email" data-cmtx-tag="{{ lang_tag_bb_code_email }}" title="{{ lang_title_bb_code_email }}" data-cmtx-target-modal="#cmtx_email_modal"></span>
                                    @endif

                                    @if enabled_bb_code_image
                                        <span class="cmtx_bb_code cmtx_bb_code_image" data-cmtx-tag="{{ lang_tag_bb_code_image }}" title="{{ lang_title_bb_code_image }}" data-cmtx-target-modal="#cmtx_image_modal"></span>
                                    @endif

                                    @if enabled_bb_code_youtube
                                        <span class="cmtx_bb_code cmtx_bb_code_youtube" data-cmtx-tag="{{ lang_tag_bb_code_youtube }}" title="{{ lang_title_bb_code_youtube }}" data-cmtx-target-modal="#cmtx_youtube_modal"></span>
                                    @endif
                                </div>
                            @endif

                            @if enabled_bb_code and enabled_smilies
                                <div class="cmtx_icons_separator"></div>
                            @endif

                            @if enabled_smilies
                                <div class="cmtx_smilies_container">
                                    @if enabled_smilies_smile
                                        <span class="cmtx_smiley cmtx_smiley_smile" data-cmtx-tag="{{ lang_tag_smiley_smile }}" title="{{ lang_title_smiley_smile }}"></span>
                                    @endif

                                    @if enabled_smilies_sad
                                        <span class="cmtx_smiley cmtx_smiley_sad" data-cmtx-tag="{{ lang_tag_smiley_sad }}" title="{{ lang_title_smiley_sad }}"></span>
                                    @endif

                                    @if enabled_smilies_huh
                                        <span class="cmtx_smiley cmtx_smiley_huh" data-cmtx-tag="{{ lang_tag_smiley_huh }}" title="{{ lang_title_smiley_huh }}"></span>
                                    @endif

                                    @if enabled_smilies_laugh
                                        <span class="cmtx_smiley cmtx_smiley_laugh" data-cmtx-tag="{{ lang_tag_smiley_laugh }}" title="{{ lang_title_smiley_laugh }}"></span>
                                    @endif

                                    @if enabled_smilies_mad
                                        <span class="cmtx_smiley cmtx_smiley_mad" data-cmtx-tag="{{ lang_tag_smiley_mad }}" title="{{ lang_title_smiley_mad }}"></span>
                                    @endif

                                    @if enabled_smilies_tongue
                                        <span class="cmtx_smiley cmtx_smiley_tongue" data-cmtx-tag="{{ lang_tag_smiley_tongue }}" title="{{ lang_title_smiley_tongue }}"></span>
                                    @endif

                                    @if enabled_smilies_cry
                                        <span class="cmtx_smiley cmtx_smiley_cry" data-cmtx-tag="{{ lang_tag_smiley_cry }}" title="{{ lang_title_smiley_cry }}"></span>
                                    @endif

                                    @if enabled_smilies_grin
                                        <span class="cmtx_smiley cmtx_smiley_grin" data-cmtx-tag="{{ lang_tag_smiley_grin }}" title="{{ lang_title_smiley_grin }}"></span>
                                    @endif

                                    @if enabled_smilies_wink
                                        <span class="cmtx_smiley cmtx_smiley_wink" data-cmtx-tag="{{ lang_tag_smiley_wink }}" title="{{ lang_title_smiley_wink }}"></span>
                                    @endif

                                    @if enabled_smilies_scared
                                        <span class="cmtx_smiley cmtx_smiley_scared" data-cmtx-tag="{{ lang_tag_smiley_scared }}" title="{{ lang_title_smiley_scared }}"></span>
                                    @endif

                                    @if enabled_smilies_cool
                                        <span class="cmtx_smiley cmtx_smiley_cool" data-cmtx-tag="{{ lang_tag_smiley_cool }}" title="{{ lang_title_smiley_cool }}"></span>
                                    @endif

                                    @if enabled_smilies_sleep
                                        <span class="cmtx_smiley cmtx_smiley_sleep" data-cmtx-tag="{{ lang_tag_smiley_sleep }}" title="{{ lang_title_smiley_sleep }}"></span>
                                    @endif

                                    @if enabled_smilies_blush
                                        <span class="cmtx_smiley cmtx_smiley_blush" data-cmtx-tag="{{ lang_tag_smiley_blush }}" title="{{ lang_title_smiley_blush }}"></span>
                                    @endif

                                    @if enabled_smilies_confused
                                        <span class="cmtx_smiley cmtx_smiley_confused" data-cmtx-tag="{{ lang_tag_smiley_confused }}" title="{{ lang_title_smiley_confused }}"></span>
                                    @endif

                                    @if enabled_smilies_shocked
                                        <span class="cmtx_smiley cmtx_smiley_shocked" data-cmtx-tag="{{ lang_tag_smiley_shocked }}" title="{{ lang_title_smiley_shocked }}"></span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="cmtx_row cmtx_comment_row cmtx_clear">
                <div class="cmtx_col_12">
                    <div class="cmtx_container cmtx_comment_container">
                        <textarea name="cmtx_comment" id="cmtx_comment" class="cmtx_field cmtx_textarea_field cmtx_comment_field {{ comment_symbol }}" placeholder="{{ lang_placeholder_comment }}" title="{{ lang_title_comment }}" maxlength="{{ comment_maximum_characters }}">{{ comment }}</textarea>
                    </div>
                </div>
            </div>

            @if enabled_counter
                <div class="cmtx_row cmtx_counter_row cmtx_clear {{ cmtx_wait_for_comment }}">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_counter_container">
                            <span id="cmtx_counter" class="cmtx_counter">{{ comment_maximum_characters }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if enabled_upload
                <div class="cmtx_row cmtx_upload_row cmtx_clear {{ cmtx_wait_for_comment }}">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_upload_container">
                            <input type='file' name="cmtx_files[]" id="cmtx_upload" accept="image/*">
                            <div class="cmtx_drag_text">
                                <div>{{ lang_text_drag_and_drop }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cmtx_row cmtx_image_row cmtx_clear" style="display:none">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_image_container"></div>
                    </div>
                </div>
            @endif

            <div class="cmtx_row cmtx_user_row cmtx_clear {{ user_row_visible }}">
                @if enabled_name
                    <div class="cmtx_col_{{ user_column_size }}">
                        <div class="cmtx_container cmtx_name_container">
                            <input type="text" name="cmtx_name" id="cmtx_name" class="cmtx_field cmtx_text_field cmtx_name_field {{ name_symbol }}" value="{{ name }}" placeholder="{{ lang_placeholder_name }}" title="{{ lang_title_name }}" maxlength="{{ maximum_name }}" {{ name_readonly }}>
                        </div>
                    </div>
                @endif

                @if enabled_email
                    <div class="cmtx_col_{{ user_column_size }}">
                        <div class="cmtx_container cmtx_email_container">
                            <input type="email" name="cmtx_email" id="cmtx_email" class="cmtx_field cmtx_text_field cmtx_email_field {{ email_symbol }}" value="{{ email }}" placeholder="{{ lang_placeholder_email }}" title="{{ lang_title_email }}" maxlength="{{ maximum_email }}" {{ email_readonly }}>
                        </div>
                    </div>
                @endif
            </div>

            @if enabled_rating
                <div class="cmtx_row cmtx_rating_row cmtx_clear {{ cmtx_wait_for_user }}">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_rating_container">
                            <div id="cmtx_rating" class="cmtx_rating {{ rating_symbol }}">
                                <div class="cmtx_rating_block">
                                    <input type="radio" id="cmtx_star_5" name="cmtx_rating" value="5" {{ rating_5_checked }}><label for="cmtx_star_5" title="{{ lang_title_rating_5 }}"></label>
                                    <input type="radio" id="cmtx_star_4" name="cmtx_rating" value="4" {{ rating_4_checked }}><label for="cmtx_star_4" title="{{ lang_title_rating_4 }}"></label>
                                    <input type="radio" id="cmtx_star_3" name="cmtx_rating" value="3" {{ rating_3_checked }}><label for="cmtx_star_3" title="{{ lang_title_rating_3 }}"></label>
                                    <input type="radio" id="cmtx_star_2" name="cmtx_rating" value="2" {{ rating_2_checked }}><label for="cmtx_star_2" title="{{ lang_title_rating_2 }}"></label>
                                    <input type="radio" id="cmtx_star_1" name="cmtx_rating" value="1" {{ rating_1_checked }}><label for="cmtx_star_1" title="{{ lang_title_rating_1 }}"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if enabled_website
                <div class="cmtx_row cmtx_website_row cmtx_clear {{ cmtx_wait_for_user }}">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_website_container">
                            <input type="url" name="cmtx_website" id="cmtx_website" class="cmtx_field cmtx_text_field cmtx_website_field {{ website_symbol }}" value="{{ website }}" placeholder="{{ lang_placeholder_website }}" title="{{ lang_title_website }}" maxlength="{{ maximum_website }}" {{ website_readonly }}>
                        </div>
                    </div>
                </div>
            @endif

            @if enabled_town or enabled_country or enabled_state
                <div class="cmtx_row cmtx_geo_row cmtx_clear {{ geo_row_visible }}">
                    @if enabled_town
                        <div class="cmtx_col_{{ geo_column_size }}">
                            <div class="cmtx_container cmtx_town_container">
                                <input type="text" name="cmtx_town" id="cmtx_town" class="cmtx_field cmtx_text_field cmtx_town_field {{ town_symbol }}" value="{{ town }}" placeholder="{{ lang_placeholder_town }}" title="{{ lang_title_town }}" maxlength="{{ maximum_town }}" {{ town_readonly }}>
                            </div>
                        </div>
                    @endif

                    @if enabled_country
                        <div class="cmtx_col_{{ geo_column_size }}">
                            <div class="cmtx_container cmtx_country_container">
                                <select name="cmtx_country" id="cmtx_country" class="cmtx_field cmtx_select_field cmtx_country_field {{ country_symbol }}" title="{{ lang_title_country }}" {{ country_disabled }}>
                                    <option value="" hidden>{{ lang_placeholder_country }}</option>
                                    @foreach countries as country
                                        @if country.id and country.id equals country_id
                                            <option value="{{ country.id }}" selected>{{ country.name }}</option>
                                        @else
                                            @if country.name equals '---'
                                                <option value="{{ country.id }}" disabled>{{ country.name }}</option>
                                            @else
                                                <option value="{{ country.id }}">{{ country.name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if enabled_state
                        <div class="cmtx_col_{{ geo_column_size }}">
                            <div class="cmtx_container cmtx_state_container">
                                <select name="cmtx_state" id="cmtx_state" class="cmtx_field cmtx_select_field cmtx_state_field {{ state_symbol }}" title="{{ lang_title_state }}" {{ state_disabled }}>
                                    <option value="" hidden>{{ lang_placeholder_state }}</option>
                                    @foreach states as state
                                        @if state.id and state.id equals state_id
                                            <option value="{{ state.id }}" selected>{{ state.name }}</option>
                                        @else
                                            <option value="{{ state.id }}">{{ state.name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            @if question
                <div class="cmtx_row cmtx_question_row cmtx_clear {{ cmtx_wait_for_user }}">
                    <div class="cmtx_col_6">
                        <div class="cmtx_container cmtx_question_container">
                            <div id="cmtx_question" class="cmtx_field cmtx_text_field cmtx_question_field">{{ question }}</div>
                        </div>
                    </div>

                    <div class="cmtx_col_6">
                        <div class="cmtx_container cmtx_answer_container">
                            <input type="text" name="cmtx_answer" id="cmtx_answer" class="cmtx_field cmtx_text_field cmtx_answer_field {{ answer_symbol }}" value="" placeholder="{{ lang_placeholder_answer }}" title="{{ lang_title_answer }}" maxlength="250">
                        </div>
                    </div>
                </div>
            @endif

            @if recaptcha
                <div class="cmtx_row cmtx_recaptcha_row cmtx_clear {{ cmtx_wait_for_user }}">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_recaptcha_container">
                            <div id="g-recaptcha" class="g-recaptcha" data-sitekey="{{ recaptcha_public_key }}" data-theme="{{ recaptcha_theme }}" data-size="{{ recaptcha_size }}"></div>
                        </div>
                    </div>
                </div>
            @endif

            @if securimage
                <div class="cmtx_row cmtx_securimage_row cmtx_clear {{ cmtx_wait_for_user }}">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_securimage_container">
                            <div>
                                <img id="cmtx_securimage_image" src="{{ securimage_url }}" alt="{{ lang_alt_securimage }}">

                                <span id="cmtx_securimage_refresh" class="cmtx_securimage_refresh fa fa-refresh" title="{{ lang_title_refresh }}"></span>
                            </div>

                            <div><input type="text" name="cmtx_securimage" id="cmtx_securimage" class="cmtx_field cmtx_securimage_field {{ answer_symbol }}" placeholder="{{ lang_placeholder_securimage }}" title="{{ lang_title_securimage }}" maxlength="{{ maximum_securimage }}"></div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="cmtx_checkbox_container {{ cmtx_wait_for_user }}">
                @if enabled_notify and enabled_email
                    <div class="cmtx_row cmtx_notify_row cmtx_clear">
                        <div class="cmtx_col_12">
                            <div class="cmtx_container cmtx_notify_container">
                                <input type="checkbox" id="cmtx_notify" name="cmtx_notify" value="1" {{ notify_checked }}> <label for="cmtx_notify">{{ lang_entry_notify }}</label>
                            </div>
                        </div>
                    </div>
                @endif

                @if enabled_cookie
                    <div class="cmtx_row cmtx_cookie_row cmtx_clear">
                        <div class="cmtx_col_12">
                            <div class="cmtx_container cmtx_cookie_container">
                                <input type="checkbox" id="cmtx_cookie" name="cmtx_cookie" value="1" {{ cookie_checked }}> <label for="cmtx_cookie">{{ lang_entry_cookie }}</label>
                            </div>
                        </div>
                    </div>
                @endif

                @if enabled_privacy
                    <div class="cmtx_row cmtx_privacy_row cmtx_clear">
                        <div class="cmtx_col_12">
                            <div class="cmtx_container cmtx_privacy_container" data-cmtx-target-modal="#cmtx_privacy_modal">
                                <input type="checkbox" id="cmtx_privacy" name="cmtx_privacy" value="1"> <label for="cmtx_privacy">{{ lang_entry_privacy }}</label>
                            </div>
                        </div>
                    </div>
                @endif

                @if enabled_terms
                    <div class="cmtx_row cmtx_terms_row cmtx_clear">
                        <div class="cmtx_col_12">
                            <div class="cmtx_container cmtx_terms_container" data-cmtx-target-modal="#cmtx_terms_modal">
                                <input type="checkbox" id="cmtx_terms" name="cmtx_terms" value="1"> <label for="cmtx_terms">{{ lang_entry_terms }}</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="cmtx_row cmtx_button_row cmtx_clear">
                <div class="cmtx_col_2">
                    <div class="cmtx_container cmtx_submit_button_container">
                        <input type="button" id="cmtx_submit_button" class="cmtx_button cmtx_button_primary {{ cmtx_admin_button }}" data-cmtx-type="submit" value="{{ lang_button_submit }}" title="{{ lang_button_submit }}">
                    </div>
                </div>

                <div class="cmtx_col_2">
                    @if enabled_preview
                        <div class="cmtx_container cmtx_preview_button_container">
                            <input type="button" id="cmtx_preview_button" class="cmtx_button cmtx_button_secondary {{ cmtx_admin_button }}" data-cmtx-type="preview" value="{{ lang_button_preview }}" title="{{ lang_button_preview }}">
                        </div>
                    @endif
                </div>

                <div class="cmtx_col_8"></div>
            </div>

            @if enabled_powered_by
                <div class="cmtx_row cmtx_powered_by_row cmtx_clear">
                    <div class="cmtx_col_12">
                        <div class="cmtx_container cmtx_powered_by_container">
                            <div class="cmtx_powered_by">{{ powered_by }}</div>
                        </div>
                    </div>
                </div>
            @endif

            <input type="hidden" name="cmtx_reply_to" value="">

            <input type="hidden" id="cmtx_hidden_data" value="{{ hidden_data }}">

            <input type="hidden" name="cmtx_subscribe" value="">

            <input type="hidden" name="cmtx_time" value="{{ time }}">

            <input type="text" name="cmtx_honeypot" class="cmtx_honeypot" value="" autocomplete="off">
        </form>

        @if enabled_bb_code_bullet
            <div id="cmtx_bullet_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_bullet_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    <div>{{ lang_modal_bullet_content }}</div>
                    <div><span>{{ lang_modal_bullet_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_bullet_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_bullet_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_bullet_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_bullet_item }}</span> <input type="text"></div>
                </div>
                <footer>
                    <input type="button" id="cmtx_bullet_modal_insert" class="cmtx_button cmtx_button_primary" value="{{ lang_modal_insert }}">
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_cancel }}">
                </footer>
            </div>
        @endif

        @if enabled_bb_code_numeric
            <div id="cmtx_numeric_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_numeric_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    <div>{{ lang_modal_numeric_content }}</div>
                    <div><span>{{ lang_modal_numeric_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_numeric_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_numeric_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_numeric_item }}</span> <input type="text"></div>
                    <div><span>{{ lang_modal_numeric_item }}</span> <input type="text"></div>
                </div>
                <footer>
                    <input type="button" id="cmtx_numeric_modal_insert" class="cmtx_button cmtx_button_primary" value="{{ lang_modal_insert }}">
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_cancel }}">
                </footer>
            </div>
        @endif

        @if enabled_bb_code_link
            <div id="cmtx_link_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_link_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    <div>{{ lang_modal_link_content_1 }}</div>
                    <div><input type="url" placeholder="http://"></div>
                    <div>{{ lang_modal_link_content_2 }}</div>
                    <div><input type="text"></div>
                </div>
                <footer>
                    <input type="button" id="cmtx_link_modal_insert" class="cmtx_button cmtx_button_primary" value="{{ lang_modal_insert }}">
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_cancel }}">
                </footer>
            </div>
        @endif

        @if enabled_bb_code_email
            <div id="cmtx_email_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_email_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    <div>{{ lang_modal_email_content_1 }}</div>
                    <div><input type="email"></div>
                    <div>{{ lang_modal_email_content_2 }}</div>
                    <div><input type="text"></div>
                </div>
                <footer>
                    <input type="button" id="cmtx_email_modal_insert" class="cmtx_button cmtx_button_primary" value="{{ lang_modal_insert }}">
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_cancel }}">
                </footer>
            </div>
        @endif

        @if enabled_bb_code_image
            <div id="cmtx_image_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_image_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    <div>{{ lang_modal_image_content }}</div>
                    <div><input type="url" placeholder="http://"></div>
                </div>
                <footer>
                    <input type="button" id="cmtx_image_modal_insert" class="cmtx_button cmtx_button_primary" value="{{ lang_modal_insert }}">
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_cancel }}">
                </footer>
            </div>
        @endif

        @if enabled_bb_code_youtube
            <div id="cmtx_youtube_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_youtube_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    <div>{{ lang_modal_youtube_content }}</div>
                    <div><input type="url" placeholder="http://"></div>
                </div>
                <footer>
                    <input type="button" id="cmtx_youtube_modal_insert" class="cmtx_button cmtx_button_primary" value="{{ lang_modal_insert }}">
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_cancel }}">
                </footer>
            </div>
        @endif

        @if enabled_upload
            <div id="cmtx_upload_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_upload_heading }}</div>
                </header>
                <div class="cmtx_modal_body"></div>
                <footer>
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_close }}">
                </footer>
            </div>
        @endif

        @if enabled_privacy
            <div id="cmtx_privacy_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_privacy_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    {{ lang_modal_privacy_content }}
                </div>
                <footer>
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_close }}">
                </footer>
            </div>
        @endif

        @if enabled_terms
            <div id="cmtx_terms_modal" class="cmtx_modal_box" role="dialog">
                <header>
                    <a href="#" class="cmtx_modal_close">x</a>
                    <div>{{ lang_modal_terms_heading }}</div>
                </header>
                <div class="cmtx_modal_body">
                    {{ lang_modal_terms_content }}
                </div>
                <footer>
                    <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_close }}">
                </footer>
            </div>
        @endif

        {# These settings are passed to common.js #}
        <div id="cmtx_js_settings_form" style="display:none" hidden>{{ cmtx_js_settings_form }}</div>
    @else
        <div class="cmtx_form_disabled">{{ lang_error_form_disabled }}</div>
    @endif
</div>