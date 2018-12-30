<?php echo $header; ?>

<div class="edit_page_page">

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

    <form action="index.php?route=edit/page&amp;id=<?php echo $id; ?>" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_identifier; ?></label>
            <input type="text" required name="identifier" class="large" value="<?php echo $identifier; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_identifier; ?>', this, event, '')">[?]</a>
            <?php if ($error_identifier) { ?>
                <span class="error"><?php echo $error_identifier; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_reference; ?></label>
            <input type="text" required name="reference" class="large" value="<?php echo $reference; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_reference; ?>', this, event, '')">[?]</a>
            <?php if ($error_reference) { ?>
                <span class="error"><?php echo $error_reference; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_url; ?></label>
            <input type="text" required name="url" class="large_plus" value="<?php echo $url; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_url; ?>', this, event, '')">[?]</a>
            <?php if ($error_url) { ?>
                <span class="error"><?php echo $error_url; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_comments; ?></label>
            <div><?php echo $lang_text_comments; ?></div>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_subscriptions; ?></label>
            <div><?php echo $lang_text_subscriptions; ?></div>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_moderate; ?></label>
            <select name="moderate">
                <option value="default" <?php if ($moderate == 'default') { echo 'selected'; } ?>><?php echo $lang_select_default; ?></option>
                <option value="never" <?php if ($moderate == 'never') { echo 'selected'; } ?>><?php echo $lang_select_never; ?></option>
                <option value="always" <?php if ($moderate == 'always') { echo 'selected'; } ?>><?php echo $lang_select_always; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_moderate; ?>', this, event, '')">[?]</a>
            <?php if ($error_moderate) { ?>
                <span class="error"><?php echo $error_moderate; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_form_enabled; ?></label>
            <input type="checkbox" name="is_form_enabled" value="1" <?php if ($is_form_enabled) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_form_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_date; ?></label>
            <div><?php echo $date_added; ?></div>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons">
            <input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>">

            <input type="button" class="button" name="delete" data-id="<?php echo $id; ?>" value="<?php echo $lang_button_delete; ?>" title="<?php echo $lang_button_delete; ?>">
        </div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
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
                        $('form').attr('action', 'index.php?route=manage/pages');

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

</div>

<?php echo $footer; ?>