<?php echo $header; ?>

<div class="edit_subscription_page">

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

    <form action="index.php?route=edit/subscription&amp;id=<?php echo $id; ?>" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_name; ?></label>
            <div><a href="<?php echo $link_name; ?>"><?php echo $name; ?></a></div>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_email; ?></label>
            <div><?php echo $email; ?></div>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_page; ?></label>
            <div><a href="<?php echo $link_page; ?>"><?php echo $page_reference; ?></a></div>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_confirmed; ?></label>
            <select name="is_confirmed">
                <option value="0" <?php if ($is_confirmed == '0') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                <option value="1" <?php if ($is_confirmed == '1') { echo 'selected'; } ?>><?php echo $lang_text_yes; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_confirmed; ?>', this, event, '')">[?]</a>
            <?php if ($error_is_confirmed) { ?>
                <span class="error"><?php echo $error_is_confirmed; ?></span>
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
                        $('form').attr('action', 'index.php?route=manage/subscriptions');

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