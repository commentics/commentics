@if question
    <div class="cmtx_row cmtx_question_row cmtx_clear {{ cmtx_wait_for_user }}">
        <div class="cmtx_col_6">
            <div class="cmtx_container cmtx_question_container">
                <div class="cmtx_label_container">
                    <label>{{ lang_label_question }}</label>
                </div>
                <div class="cmtx_field_container">
                    <div id="cmtx_question" class="cmtx_field cmtx_text_field cmtx_question_field">{{ question }}</div>
                </div>
            </div>
        </div>

        <div class="cmtx_col_6">
            <div class="cmtx_container cmtx_answer_container">
                <div class="cmtx_label_container">
                    <label class="{{ general_symbol }}">{{ lang_label_answer }}</label>
                </div>
                <div class="cmtx_field_container">
                    <input type="text" name="cmtx_answer" id="cmtx_answer" class="cmtx_field cmtx_text_field cmtx_answer_field {{ general_symbol }}" value="" placeholder="{{ lang_placeholder_answer }}" title="{{ lang_title_answer }}" maxlength="250">
                </div>
            </div>
        </div>
    </div>
@endif