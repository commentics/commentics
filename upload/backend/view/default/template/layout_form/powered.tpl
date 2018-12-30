<?php echo $header; ?>

<div class="layout_form_powered_page">

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

    <form action="index.php?route=layout_form/powered" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="enabled_powered_by" value="1" <?php if ($enabled_powered_by) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
            <?php if ($error_enabled_powered_by) { ?>
                <span class="error"><?php echo $error_enabled_powered_by; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_type; ?></label>
            <select name="powered_by_type">
                <option value="text" <?php if ($powered_by_type == 'text') { echo 'selected'; } ?>><?php echo $lang_select_text; ?></option>
                <option value="image" <?php if ($powered_by_type == 'image') { echo 'selected'; } ?>><?php echo $lang_select_image; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_type; ?>', this, event, '')">[?]</a>
            <?php if ($error_powered_by_type) { ?>
                <span class="error"><?php echo $error_powered_by_type; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_window; ?></label>
            <input type="checkbox" name="powered_by_new_window" value="1" <?php if ($powered_by_new_window) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_window; ?>', this, event, '')">[?]</a>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('div.info a:last-child').click(function(e) {
            e.preventDefault();

            $('div.info').fadeOut(2000);
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>