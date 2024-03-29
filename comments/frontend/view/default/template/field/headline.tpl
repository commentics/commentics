@if enabled_headline
    <div class="cmtx_row cmtx_headline_row cmtx_clear {{ cmtx_wait_for_comment }}">
        <div class="cmtx_col_12">
            <div class="cmtx_container cmtx_headline_container">
                <div class="cmtx_label_container">
                    <label class="{{ headline_symbol }}">{{ lang_label_headline }}</label>
                </div>
                <div class="cmtx_field_container">
                    <input type="text" name="cmtx_headline" id="cmtx_headline" class="cmtx_field cmtx_text_field cmtx_headline_field {{ headline_symbol }}" value="{{ default_headline }}" placeholder="{{ lang_placeholder_headline }}" title="{{ lang_title_headline }}" maxlength="{{ headline_maximum_characters }}">
                </div>
            </div>
        </div>
    </div>
@endif