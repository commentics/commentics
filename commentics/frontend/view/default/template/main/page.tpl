<div id="cmtx_container" class="cmtx_container">
    {{ header }}

    @if maintenance_mode
        <h3>{{ lang_heading_maintenance }}</h3>

        <div class="cmtx_maintenance_mode">{{ maintenance_message }}</div>
    @else
        @if order_parts equals '1,2'
            <div class="cmtx_form_section">{{ form }}</div>
        @else
            <div class="cmtx_comments_section">{{ comments }}</div>
        @endif

        @if display_parsing
            <div class="cmtx_parsing_box cmtx_clear">
                <div>{{ lang_text_generated_in }} {{ generated_time }} {{ lang_text_seconds }}</div>
                <div><b>PHP</b>: {{ php_time }}s | <b>SQL</b>: {{ query_time }}s ({{ query_count }} {{ lang_text_queries }})</div>
            </div>
        @endif

        <div class="cmtx_divider_section"></div>

        @if order_parts equals '1,2'
            <div class="cmtx_comments_section">{{ comments }}</div>
        @else
            <div class="cmtx_form_section">{{ form }}</div>
        @endif
    @endif

    @if auto_detect
        <div id="cmtx_autodetect_modal" class="cmtx_modal_box" role="dialog">
            <header>
                <div>{{ lang_modal_autodetect_heading }}</div>
            </header>
            <div class="cmtx_modal_body">
                {{ lang_modal_autodetect_content }}
            </div>
        </div>
    @endif

    @if admin_detect
        <div id="cmtx_admindetect_modal" class="cmtx_modal_box" role="dialog">
            <header>
                <a href="#" class="cmtx_modal_close">x</a>
                <div>{{ lang_modal_admindetect_heading }}</div>
            </header>
            <div class="cmtx_modal_body">
                {{ lang_modal_admindetect_content }}
            </div>
            <footer>
                <input type="button" id="cmtx_admindetect_modal_stop" class="cmtx_button cmtx_button_primary" value="{{ lang_modal_stop }}">
                <input type="button" class="cmtx_button cmtx_button_secondary" value="{{ lang_modal_close }}">
            </footer>
        </div>
    @endif

    {# These are passed to autodetect.js via the template #}
    <div id="cmtx_js_settings_page" style="display:none" hidden>{{ cmtx_js_settings_page }}</div>

    {{ footer }}
</div>