<?php echo $header; ?>

<div id="module_api_page">

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

    <form action="index.php?route=module/api" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="api_enabled" value="1" <?php if ($api_enabled) {echo 'checked';}?>>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_key; ?></label>
            <input type="text" required name="api_key" class="large" value="<?php echo $api_key; ?>" maxlength="250">
            <a class="hint" data-hint="<?php echo $lang_hint_key; ?>">[?]</a>
            <?php if ($error_api_key) {?>
                <span class="error"><?php echo $error_api_key; ?></span>
            <?php }?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_ip_address; ?></label>
            <input type="text" required name="api_ip_address" class="large" value="<?php echo $api_ip_address; ?>" maxlength="250">
            <a class="hint" data-hint="<?php echo $lang_hint_ip_address; ?>">[?]</a>
            <?php if ($error_api_ip_address) {?>
                <span class="error"><?php echo $error_api_ip_address; ?></span>
            <?php }?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_check_ip; ?></label>
            <select name="api_check_ip">
                <option value="" <?php if ($api_check_ip == '') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                <option value="loose" <?php if ($api_check_ip == 'loose') { echo 'selected'; } ?>><?php echo $lang_text_loose; ?></option>
                <option value="strict" <?php if ($api_check_ip == 'strict') { echo 'selected'; } ?>><?php echo $lang_text_strict; ?></option>
            </select>
            <a class="hint" data-hint="<?php echo $lang_hint_check_ip; ?>">[?]</a>
            <?php if ($error_api_check_ip) { ?>
                <span class="error"><?php echo $error_api_check_ip; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_logging; ?></label>
            <input type="checkbox" name="api_logging" value="1" <?php if ($api_logging) { echo 'checked'; } ?>>
            <a class="hint" data-hint="<?php echo $lang_hint_logging; ?>">[?]</a>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

</div>

<?php echo $footer; ?>