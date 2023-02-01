@if enabled_website
    <div class="cmtx_row cmtx_website_row cmtx_clear {{ cmtx_wait_for_user }}">
        <div class="cmtx_col_12">
            <div class="cmtx_container cmtx_website_container">
                <div class="cmtx_label_container">
                    <label class="{{ website_symbol }}">{{ lang_label_website }}</label>
                </div>
                <div class="cmtx_field_container">
                    <input type="url" name="cmtx_website" id="cmtx_website" class="cmtx_field cmtx_text_field cmtx_website_field {{ website_symbol }}" value="{{ website }}" placeholder="{{ lang_placeholder_website }}" title="{{ lang_title_website }}" maxlength="{{ maximum_website }}" {{ website_readonly }}>
                </div>
            </div>
        </div>
    </div>
@endif