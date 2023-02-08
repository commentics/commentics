@if recaptcha
    <div class="cmtx_row cmtx_recaptcha_row cmtx_clear {{ cmtx_wait_for_user }}">
        <div class="cmtx_col_12">
            <div class="cmtx_container cmtx_recaptcha_container">
                <div class="cmtx_label_container">
                    <label class="{{ general_symbol }}">{{ lang_label_captcha }}</label>
                </div>
                <div class="cmtx_field_container">
                    <div id="g-recaptcha" class="g-recaptcha" data-sitekey="{{ recaptcha_public_key }}" data-theme="{{ recaptcha_theme }}" data-size="{{ recaptcha_size }}"></div>
                </div>
            </div>
        </div>
    </div>
@endif

@if captcha
    <div class="cmtx_row cmtx_captcha_row cmtx_clear {{ cmtx_wait_for_user }}">
        <div class="cmtx_col_12">
            <div class="cmtx_container cmtx_captcha_container">
                <div class="cmtx_label_container">
                    <label class="{{ general_symbol }}">{{ lang_label_captcha }}</label>
                </div>
                <div class="cmtx_field_container">
                    <div>
                        <img id="cmtx_captcha_image" src="{{ captcha_url }}" alt="{{ lang_alt_captcha }}">

                        <span id="cmtx_captcha_refresh" class="cmtx_captcha_refresh fa fa-refresh" title="{{ lang_title_refresh }}"></span>
                    </div>

                    <div><input type="text" name="cmtx_captcha" id="cmtx_captcha" class="cmtx_field cmtx_captcha_field {{ general_symbol }}" placeholder="{{ lang_placeholder_captcha }}" title="{{ lang_title_captcha }}" maxlength="{{ captcha_length }}"></div>
                </div>
            </div>
        </div>
    </div>
@endif