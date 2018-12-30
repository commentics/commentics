<?php echo $header; ?>

<div class="edit_comment_page">

    <div class='page_help_block'><?php echo $page_help_link; ?></div>

    <h1><?php echo $lang_heading; ?></h1>

    <hr>

    <?php if ($success) { ?>
        <div class="success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if ($info) { ?>
        <div class="info"><?php echo $info; ?></div>
    <?php } ?>

    <?php if ($error) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <?php if ($warning) { ?>
        <div class="warning"><?php echo $warning; ?></div>
    <?php } ?>

    <div class="description"><?php echo $lang_description; ?></div>

    <form action="index.php?route=edit/comment&amp;id=<?php echo $id; ?>" class="controls" method="post">
        <div class="left">
            <h2><?php echo $lang_subheading_left; ?></h2>

            <div class="fieldset">
                <label><?php echo $lang_entry_name; ?></label>
                <div><a href="<?php echo $link_name; ?>"><?php echo $name; ?></a></div>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_email; ?></label>
                <?php if ($email) { ?>
                    <div><?php echo $email; ?></div>
                <?php } else { ?>
                    <div><i><?php echo $lang_text_no_email; ?></i></div>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_website; ?></label>
                <input type="text" name="website" class="large_plus" value="<?php echo $website; ?>" maxlength="250">
                <?php if ($error_website) { ?>
                    <span class="error"><?php echo $error_website; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_town; ?></label>
                <input type="text" name="town" class="large" value="<?php echo $town; ?>" maxlength="250">
                <?php if ($error_town) { ?>
                    <span class="error"><?php echo $error_town; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_state; ?></label>
                <select name="state_id"></select>
                <?php if ($error_state_id) { ?>
                    <span class="error"><?php echo $error_state_id; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_country; ?></label>
                <select name="country_id">
                    <option value=""><?php echo $lang_select_select; ?></option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country['id']; ?>" <?php if ($country_id && $country['id'] == $country_id) { echo 'selected'; } ?> <?php if ($country['name'] == '---') { echo 'disabled'; } ?>><?php echo $country['name']; ?></option>
                    <?php } ?>
                </select>
                <?php if ($error_country_id) { ?>
                    <span class="error"><?php echo $error_country_id; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_rating; ?></label>
                <select name="rating">
                    <option value=""><?php echo $lang_select_select; ?></option>
                    <option value="1" <?php if ($rating == '1') { echo 'selected'; } ?>><?php echo $lang_select_rating_1; ?></option>
                    <option value="2" <?php if ($rating == '2') { echo 'selected'; } ?>><?php echo $lang_select_rating_2; ?></option>
                    <option value="3" <?php if ($rating == '3') { echo 'selected'; } ?>><?php echo $lang_select_rating_3; ?></option>
                    <option value="4" <?php if ($rating == '4') { echo 'selected'; } ?>><?php echo $lang_select_rating_4; ?></option>
                    <option value="5" <?php if ($rating == '5') { echo 'selected'; } ?>><?php echo $lang_select_rating_5; ?></option>
                </select>
                <?php if ($error_rating) { ?>
                    <span class="error"><?php echo $error_rating; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_comment; ?></label>
                <textarea name="comment"><?php echo $comment; ?></textarea>
                <?php if ($error_comment) { ?>
                    <span class="error"><?php echo $error_comment; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_reply; ?></label>
                <textarea name="reply"><?php echo $reply; ?></textarea>
                <?php if ($error_reply) { ?>
                    <span class="error"><?php echo $error_reply; ?></span>
                <?php } ?>
            </div>
        </div>

        <div class="right">
            <h2><?php echo $lang_subheading_right; ?></h2>

            <div class="fieldset">
                <label><?php echo $lang_entry_page; ?></label>
                <select name="page_id">
                <?php foreach ($pages as $page) { ?>
                    <option value="<?php echo $page['id']; ?>" <?php if ($page['id'] == $page_id) { echo 'selected'; } ?>><?php echo $page['reference']; ?></option>
                <?php } ?>
                </select>
                <?php if ($error_page_id) { ?>
                    <span class="error"><?php echo $error_page_id; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_reply_to; ?></label>
                <select name="reply_to"></select>
                <?php if ($error_reply_to) { ?>
                    <span class="error"><?php echo $error_reply_to; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset divide_after">
                <label><?php echo $lang_entry_replies; ?></label>
                <div><?php echo $lang_text_replies; ?></div>
            </div>

            <div class="fieldset divide_after">
                <label><?php echo $lang_entry_uploads; ?></label>
                <div>
                    <?php if ($uploads) { ?>
                        <?php foreach ($uploads as $upload) { ?>
                            <a href="<?php echo $upload['image']; ?>" class="gallery"><img src="<?php echo $upload['image']; ?>" class="upload" title="<?php echo $upload['filename'] . '.' . $upload['extension']; ?>"></a>
                        <?php } ?>
                    <?php } else { ?>
                        <?php echo $lang_text_no_uploads; ?>
                    <?php } ?>
                </div>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_approved; ?></label>
                <select name="is_approved">
                    <option value="0" <?php if ($is_approved == '0') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                    <option value="1" <?php if ($is_approved == '1') { echo 'selected'; } ?>><?php echo $lang_text_yes; ?></option>
                </select>
                <?php if ($error_is_approved) { ?>
                    <span class="error"><?php echo $error_is_approved; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset divide_after">
                <label><?php echo $lang_entry_notes; ?></label>
                <textarea name="notes"><?php echo $notes; ?></textarea>
                <?php if ($error_notes) { ?>
                    <span class="error"><?php echo $error_notes; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset divide_after">
                <label><?php echo $lang_entry_send; ?></label>
                <?php if ($is_sent) { ?>
                    <div><?php echo $lang_text_sent; ?></div>
                <?php } else { ?>
                    <input type="checkbox" name="send" value="1" <?php if ($is_sent) { echo 'checked'; } ?>>
                    <a class="hint" onmouseover="showhint('<?php echo $lang_hint_send; ?>', this, event, '')">[?]</a>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_likes; ?></label>
                <div><?php echo $lang_text_likes; ?></div>
            </div>

            <div class="fieldset divide_after">
                <label><?php echo $lang_entry_dislikes; ?></label>
                <div><?php echo $lang_text_dislikes; ?></div>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_reports; ?></label>
                <div><?php echo $lang_text_reports; ?></div>
            </div>

            <div class="fieldset divide_after">
                <label><?php echo $lang_entry_verify; ?></label>
                <?php if ($is_verified) { ?>
                    <div><?php echo $lang_text_verified; ?></div>
                <?php } else { ?>
                    <input type="checkbox" name="verify" value="1" <?php if ($is_verified) { echo 'checked'; } ?>>
                    <a class="hint" onmouseover="showhint('<?php echo $lang_hint_verify; ?>', this, event, '')">[?]</a>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_sticky; ?></label>
                <select name="is_sticky" <?php if ($reply_to) { echo 'disabled'; } ?>>
                    <option value="0" <?php if ($is_sticky == '0') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                    <option value="1" <?php if ($is_sticky == '1') { echo 'selected'; } ?>><?php echo $lang_text_yes; ?></option>
                </select>
                <a class="hint" onmouseover="showhint('<?php echo $lang_hint_sticky; ?>', this, event, '')">[?]</a>
                <?php if ($error_is_sticky) { ?>
                    <span class="error"><?php echo $error_is_sticky; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset divide_after">
                <label><?php echo $lang_entry_locked; ?></label>
                <select name="is_locked">
                    <option value="0" <?php if ($is_locked == '0') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                    <option value="1" <?php if ($is_locked == '1') { echo 'selected'; } ?>><?php echo $lang_text_yes; ?></option>
                </select>
                <a class="hint" onmouseover="showhint('<?php echo $lang_hint_locked; ?>', this, event, '')">[?]</a>
                <?php if ($error_is_locked) { ?>
                    <span class="error"><?php echo $error_is_locked; ?></span>
                <?php } ?>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_ip_address; ?></label>
                <div><?php echo $ip_address; ?></div>
            </div>

            <div class="fieldset">
                <label><?php echo $lang_entry_date; ?></label>
                <div><?php echo $date_added; ?></div>
            </div>

            <div class="buttons">
                <input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>">

                <input type="button" class="button" name="delete" data-id="<?php echo $id; ?>" value="<?php echo $lang_button_delete; ?>" title="<?php echo $lang_button_delete; ?>">

                <input type="button" class="button" name="spam" value="<?php echo $lang_button_spam; ?>" title="<?php echo $lang_button_spam; ?>">
            </div>

            <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">
    </form>

    <div id="delete_dialog" title="<?php echo $lang_dialog_delete_title; ?>" style="display:none">
        <span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_delete_content; ?>
    </div>

    <style>
    .ui-dialog .ui-icon-alert {
        margin-bottom: 10px;
    }
    </style>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('div.info a:last-child').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'index.php?route=edit/comment/dismiss',
            })

            $('div.info').fadeOut(2000);
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="country_id"]').bind('change', function() {
            var data = 'country_id=' + encodeURIComponent($('select[name="country_id"]').val());

            var request = $.ajax({
                type: 'POST',
                cache: false,
                url: 'index.php?route=edit/comment/getStates',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $('select[name="country_id"]').after('<img src="<?php echo $loading; ?>" class="loading">');
                }
            });

            request.always(function() {
                setTimeout(function() {
                    $('.loading').remove();
                }, 500);
            });

            request.done(function(response) {
                states = response;

                html = '<option value=""><?php echo $lang_select_select; ?></option>';

                for (i = 0; i < states.length; i++) {
                    html += '<option value="' + states[i]['id'] + '"';

                    if (states[i]['id'] == '<?php echo $state_id; ?>') {
                        html += ' selected';
                    }

                    html += '>' + states[i]['name'] + '</option>';
                }

                $('select[name="state_id"]').html(html);

                $('select[name="state_id"]').trigger('change');
            });

            request.fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        $('select[name="country_id"]').trigger('change');
    });
    // ]]>
    </script>

    <?php if ($wysiwyg_enabled) { ?>
        <script>
        // <![CDATA[
        $(document).ready(function() {
            $('.left textarea').summernote({
                height: 175,
                disableDragAndDrop: true,
                shortcuts: false,
                toolbar: [
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['codeview']]
                ],
            });
        });
        // ]]>
        </script>
    <?php } ?>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="page_id"]').bind('change', function() {
            var data = 'id=' + encodeURIComponent('<?php echo $id; ?>') + '&page_id=' + encodeURIComponent($('select[name="page_id"]').val());

            var request = $.ajax({
                type: 'POST',
                cache: false,
                url: 'index.php?route=edit/comment/getReplies',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $('select[name="page_id"]').after('<img src="<?php echo $loading; ?>" class="loading">');
                }
            });

            request.always(function() {
                setTimeout(function() {
                    $('.loading').remove();
                }, 500);
            });

            request.done(function(response) {
                replies = response;

                html = '<option value="0"><?php echo $lang_text_nobody; ?></option>';

                for (i = 0; i < replies.length; i++) {
                    html += '<option value="' + replies[i]['id'] + '"';

                    if (replies[i]['id'] == '<?php echo $reply_to; ?>') {
                        html += ' selected';
                    }

                    html += '>' + replies[i]['name'] + ' - ' + replies[i]['date_added'] + '</option>';
                }

                $('select[name="reply_to"]').html(html);

                $('select[name="reply_to"]').trigger('change');
            });

            request.fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        $('select[name="page_id"]').trigger('change');
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="reply_to"]').bind('change', function() {
            var reply_to = $(this).val();

            if (reply_to == '0') {
                $('select[name="is_sticky"]').attr('disabled', false);
            } else {
                $('select[name="is_sticky"]').val('0');

                $('select[name="is_sticky"]').attr('disabled', true);
            }
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('a.gallery').colorbox({
            maxWidth: '80%',
            maxHeight: '50%',
            rel: 'gallery'
        })
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name="delete"]').click(function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#delete_dialog').dialog({
                modal: true,
                height: 'auto',
                width: 'auto',
                resizable: false,
                draggable: false,
                center: true,
                buttons: {
                    '<?php echo $lang_dialog_yes; ?>': function() {
                        $('form').attr('action', 'index.php?route=manage/comments');

                        var input = $('<input>').attr('type', 'hidden').attr('name', 'single_delete').val(id);

                        $('form').append($(input));

                        $('form').submit();

                        $(this).dialog('close');
                    },
                    '<?php echo $lang_dialog_no; ?>': function() {
                        $(this).dialog('close');
                    }
                }
            });

            $('#delete_dialog').dialog('open');
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name="spam"]').click(function(e) {
            location = '<?php echo $link_spam; ?>';
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>