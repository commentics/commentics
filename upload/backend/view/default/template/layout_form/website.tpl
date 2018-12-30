<?php echo $header; ?>

<div class="layout_form_website_page">

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

    <form action="index.php?route=layout_form/website" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="enabled_website" value="1" <?php if ($enabled_website) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_required; ?></label>
            <input type="checkbox" name="required_website" value="1" <?php if ($required_website) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_required; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_default; ?></label>
            <input type="text" name="default_website" class="medium" value="<?php echo $default_website; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_default; ?>', this, event, '')">[?]</a>
            <?php if ($error_default_website) { ?>
                <span class="error"><?php echo $error_default_website; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_maximum; ?></label>
            <input type="text" required name="maximum_website" class="small" value="<?php echo $maximum_website; ?>" maxlength="3">
            <span class="note"><?php echo $lang_note_characters; ?></span>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_maximum; ?>', this, event, '')">[?]</a>
            <?php if ($error_maximum_website) { ?>
                <span class="error"><?php echo $error_maximum_website; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_filled_cookie; ?></label>
            <select name="filled_website_cookie_action">
                <option value="normal" <?php if ($filled_website_cookie_action == 'normal') { echo 'selected'; } ?>><?php echo $lang_select_normal; ?></option>
                <option value="disable" <?php if ($filled_website_cookie_action == 'disable') { echo 'selected'; } ?>><?php echo $lang_select_disable; ?></option>
                <option value="hide" <?php if ($filled_website_cookie_action == 'hide') { echo 'selected'; } ?>><?php echo $lang_select_hide; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_filled_cookie; ?>', this, event, '')">[?]</a>
            <?php if ($error_filled_website_cookie_action) { ?>
                <span class="error"><?php echo $error_filled_website_cookie_action; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_filled_login; ?></label>
            <select name="filled_website_login_action">
                <option value="normal" <?php if ($filled_website_login_action == 'normal') { echo 'selected'; } ?>><?php echo $lang_select_normal; ?></option>
                <option value="disable" <?php if ($filled_website_login_action == 'disable') { echo 'selected'; } ?>><?php echo $lang_select_disable; ?></option>
                <option value="hide" <?php if ($filled_website_login_action == 'hide') { echo 'selected'; } ?>><?php echo $lang_select_hide; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_filled_login; ?>', this, event, '')">[?]</a>
            <?php if ($error_filled_website_login_action) { ?>
                <span class="error"><?php echo $error_filled_website_login_action; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

</div>

<?php echo $footer; ?>