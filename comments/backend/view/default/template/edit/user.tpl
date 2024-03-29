<?php echo $header; ?>

<div id="edit_user_page">

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

    <?php if ($avatar_type) { ?>
        <div class="avatar_section">
            <a href="<?php echo $avatar_image; ?>" target="_blank"><img src="<?php echo $avatar_image; ?>" class="avatar"></a>
        </div>
    <?php } ?>

    <div class="description"><?php echo $lang_description; ?></div>

    <form action="index.php?route=edit/user&amp;id=<?php echo $id; ?>" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_name; ?></label>
            <input type="text" required name="name" class="large" value="<?php echo $name; ?>" maxlength="250">
            <?php if ($error_name) { ?>
                <span class="error"><?php echo $error_name; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_email; ?></label>
            <input type="email" name="email" class="large" value="<?php echo $email; ?>" maxlength="250">
            <?php if ($error_email) { ?>
                <span class="error"><?php echo $error_email; ?></span>
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
            <a class="hint" data-hint="<?php echo $lang_hint_moderate; ?>">[?]</a>
            <?php if ($error_moderate) { ?>
                <span class="error"><?php echo $error_moderate; ?></span>
            <?php } ?>
        </div>

        <?php if ($avatar_type == 'upload') { ?>
            <div class="fieldset">
                <label><?php echo $lang_entry_avatar; ?></label>
                <select name="avatar">
                    <option value="" <?php if ($avatar == '') { echo 'selected'; } ?>><?php echo $lang_select_no_action; ?></option>

                    <?php if ($avatar_pending_id) { ?>
                        <option value="approve" <?php if ($avatar == 'approve') { echo 'selected'; } ?>><?php echo $lang_select_approve; ?></option>
                    <?php } ?>

                    <?php if ($avatar_pending_id || $avatar_id) { ?>
                        <option value="disapprove" <?php if ($avatar == 'disapprove') { echo 'selected'; } ?>><?php echo $lang_select_disapprove; ?></option>
                    <?php } ?>
                </select>
                <?php if ($error_avatar) { ?>
                    <span class="error"><?php echo $error_avatar; ?></span>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="fieldset">
            <label><?php echo $lang_entry_link; ?></label>
            <div><a href="<?php echo $link_user; ?>" target="_blank"><?php echo $lang_link_view_user; ?></a></div>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_date; ?></label>
            <div><?php echo $date_added; ?></div>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons">
            <input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>">

            <input type="button" class="button" name="delete" data-id="<?php echo $id; ?>" data-url="manage/users" value="<?php echo $lang_button_delete; ?>" title="<?php echo $lang_button_delete; ?>">
        </div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <div id="delete_dialog" title="<?php echo $lang_dialog_delete_title; ?>" class="hide">
        <span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_delete_content; ?>
    </div>

</div>

<?php echo $footer; ?>