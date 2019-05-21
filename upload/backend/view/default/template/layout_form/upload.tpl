<?php echo $header; ?>

<div class="layout_form_upload_page">

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

    <form action="index.php?route=layout_form/upload" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="enabled_upload" value="1" <?php if ($enabled_upload) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_max_size; ?></label>
            <input type="text" required name="maximum_upload_size" class="small" value="<?php echo $maximum_upload_size; ?>" maxlength="2">
            <span class="note"><?php echo $lang_note_mb; ?></span>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_max_size; ?>', this, event, '')">[?]</a>
            <?php if ($error_maximum_upload_size) { ?>
                <span class="error"><?php echo $error_maximum_upload_size; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_max_amount; ?></label>
            <input type="text" required name="maximum_upload_amount" class="small" value="<?php echo $maximum_upload_amount; ?>" maxlength="2">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_max_amount; ?>', this, event, '')">[?]</a>
            <?php if ($error_maximum_upload_amount) { ?>
                <span class="error"><?php echo $error_maximum_upload_amount; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_max_total; ?></label>
            <input type="text" required name="maximum_upload_total" class="small" value="<?php echo $maximum_upload_total; ?>" maxlength="2">
            <span class="note"><?php echo $lang_note_mb; ?></span>                
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_max_total; ?>', this, event, '')">[?]</a>
            <?php if ($error_maximum_upload_total) { ?>
                <span class="error"><?php echo $error_maximum_upload_total; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

</div>

<?php echo $footer; ?>