<div class="cmtx_checkbox_container {{ cmtx_wait_for_user }}">
    @if enabled_notify and ( enabled_email or email_is_filled )
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
                <div class="cmtx_container cmtx_privacy_container">
                    <input type="checkbox" id="cmtx_privacy" name="cmtx_privacy" value="1"> <label for="cmtx_privacy">{{ lang_entry_privacy }}</label>
                </div>
            </div>
        </div>
    @endif

    @if enabled_terms
        <div class="cmtx_row cmtx_terms_row cmtx_clear">
            <div class="cmtx_col_12">
                <div class="cmtx_container cmtx_terms_container">
                    <input type="checkbox" id="cmtx_terms" name="cmtx_terms" value="1"> <label for="cmtx_terms">{{ lang_entry_terms }}</label>
                </div>
            </div>
        </div>
    @endif
</div>