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