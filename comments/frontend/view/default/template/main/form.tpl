<div id="cmtx_form_container" class="cmtx_form_container cmtx_field_label_{{ field_label }} cmtx_field_column_{{ field_column }} cmtx_field_width_{{ field_width }} cmtx_field_align_{{ field_align }} cmtx_clear">
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

            <div class="cmtx_rows">
                @foreach fields as key and field
                    @template field/{{ field.template }}
                @endforeach

                @template field/captcha

                @template field/checkboxes

                @template field/buttons
            </div>

            <input type="hidden" name="cmtx_reply_to" value="">

            <input type="hidden" id="cmtx_hidden_data" value="{{ hidden_data }}">

            <input type="hidden" name="cmtx_iframe" value="{{ iframe }}">

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

        @if enabled_privacy or quick_reply or show_edit
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

        @if enabled_terms or quick_reply or show_edit
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
        <div id="cmtx_js_settings_form" class="cmtx_hide" hidden>{{ cmtx_js_settings_form }}</div>
    @else
        <div class="cmtx_form_disabled">{{ lang_error_form_disabled }}</div>
    @endif
</div>