<?php echo $header; ?>

<div class="settings_system_page">

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

    <form action="index.php?route=settings/system" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_site_name; ?></label>
            <input type="text" required name="site_name" class="large" value="<?php echo $site_name; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_site_name; ?>', this, event, '')">[?]</a>
            <?php if ($error_site_name) { ?>
                <span class="error"><?php echo $error_site_name; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_site_domain; ?></label>
            <input type="text" required name="site_domain" class="large" value="<?php echo $site_domain; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_site_domain; ?>', this, event, '')">[?]</a>
            <?php if ($error_site_domain) { ?>
                <span class="error"><?php echo $error_site_domain; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_site_url; ?></label>
            <input type="text" required name="site_url" class="large" value="<?php echo $site_url; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_site_url; ?>', this, event, '')">[?]</a>
            <?php if ($error_site_url) { ?>
                <span class="error"><?php echo $error_site_url; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_time_zone; ?></label>
            <select name="time_zone" class="large">
            <?php foreach ($zones as $zone) { ?>
                <option value="<?php echo $zone; ?>" <?php if ($zone == $time_zone) { echo 'selected'; } ?>><?php echo $zone; ?></option>
            <?php } ?>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_time_zone; ?>', this, event, '')">[?]</a>
            <?php if ($error_time_zone) { ?>
                <span class="error"><?php echo $error_time_zone; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_commentics_folder; ?></label>
            <input type="text" required name="commentics_folder" class="large" value="<?php echo $commentics_folder; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_commentics_folder; ?>', this, event, '')">[?]</a>
            <?php if ($error_commentics_folder) { ?>
                <span class="error"><?php echo $error_commentics_folder; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_commentics_url; ?></label>
            <input type="text" required name="commentics_url" class="large" value="<?php echo $commentics_url; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_commentics_url; ?>', this, event, '')">[?]</a>
            <?php if ($error_commentics_url) { ?>
                <span class="error"><?php echo $error_commentics_url; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_backend_folder; ?></label>
            <input type="text" required name="backend_folder" class="large" value="<?php echo $backend_folder; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_backend_folder; ?>', this, event, '')">[?]</a>
            <?php if ($error_backend_folder) { ?>
                <span class="error"><?php echo $error_backend_folder; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_use_wysiwyg; ?></label>
            <input type="checkbox" name="use_wysiwyg" value="1" <?php if ($use_wysiwyg) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_use_wysiwyg; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_display_parsing; ?></label>
            <input type="checkbox" name="display_parsing" value="1" <?php if ($display_parsing) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_display_parsing; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_limit_results; ?></label>
            <input type="text" required name="limit_results" class="small" value="<?php echo $limit_results; ?>" maxlength="4">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_limit_results; ?>', this, event, '')">[?]</a>
            <?php if ($error_limit_results) { ?>
                <span class="error"><?php echo $error_limit_results; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_admin_cookie; ?></label>
            <input type="text" required name="admin_cookie_days" class="small" value="<?php echo $admin_cookie_days; ?>" maxlength="4">
            <span class="note"><?php echo $lang_note_days; ?></span>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_admin_cookie; ?>', this, event, '')">[?]</a>
            <?php if ($error_admin_cookie_days) { ?>
                <span class="error"><?php echo $error_admin_cookie_days; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>
    </form>

</div>

<?php echo $footer; ?>