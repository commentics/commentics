<?php echo $header; ?>

<div class="layout_form_captcha_page">

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

    <form action="index.php?route=layout_form/captcha" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="enabled_captcha" value="1" <?php if ($enabled_captcha) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_type; ?></label>
            <select name="captcha_type">
                <option value="recaptcha" <?php if ($captcha_type == 'recaptcha') { echo 'selected'; } ?>>ReCaptcha</option>
                <option value="securimage" <?php if ($captcha_type == 'securimage') { echo 'selected'; } ?>>Securimage</option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_type; ?>', this, event, '')">[?]</a>
            <?php if ($error_captcha_type) { ?>
                <span class="error"><?php echo $error_captcha_type; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset recaptcha_section">
            <label><?php echo $lang_entry_public_key; ?></label>
            <input type="text" name="recaptcha_public_key" class="large" value="<?php echo $recaptcha_public_key; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_recaptcha_key; ?>', this, event, '')">[?]</a>
            <?php if ($error_recaptcha_public_key) { ?>
                <span class="error"><?php echo $error_recaptcha_public_key; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset recaptcha_section">
            <label><?php echo $lang_entry_private_key; ?></label>
            <input type="text" name="recaptcha_private_key" class="large" value="<?php echo $recaptcha_private_key; ?>" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_recaptcha_key; ?>', this, event, '')">[?]</a>
            <?php if ($error_recaptcha_private_key) { ?>
                <span class="error"><?php echo $error_recaptcha_private_key; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset recaptcha_section">
            <label><?php echo $lang_entry_theme; ?></label>
            <select name="recaptcha_theme">
                <option value="dark" <?php if ($recaptcha_theme == 'dark') { echo 'selected'; } ?>>Dark</option>
                <option value="light" <?php if ($recaptcha_theme == 'light') { echo 'selected'; } ?>>Light</option>
            </select>
            <?php if ($error_recaptcha_theme) { ?>
                <span class="error"><?php echo $error_recaptcha_theme; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset recaptcha_section">
            <label><?php echo $lang_entry_size; ?></label>
            <select name="recaptcha_size">
                <option value="compact" <?php if ($recaptcha_size == 'compact') { echo 'selected'; } ?>><?php echo $lang_select_compact; ?></option>
                <option value="normal" <?php if ($recaptcha_size == 'normal') { echo 'selected'; } ?>><?php echo $lang_select_normal; ?></option>
            </select>
            <?php if ($error_recaptcha_size) { ?>
                <span class="error"><?php echo $error_recaptcha_size; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_width; ?></label>
            <input type="text" required name="securimage_width" class="small" value="<?php echo $securimage_width; ?>" maxlength="3">
            <?php if ($error_securimage_width) { ?>
                <span class="error"><?php echo $error_securimage_width; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_height; ?></label>
            <input type="text" required name="securimage_height" class="small" value="<?php echo $securimage_height; ?>" maxlength="3">
            <?php if ($error_securimage_height) { ?>
                <span class="error"><?php echo $error_securimage_height; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_length; ?></label>
            <input type="text" required name="securimage_length" class="small" value="<?php echo $securimage_length; ?>" maxlength="2">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_length; ?>', this, event, '')">[?]</a>
            <?php if ($error_securimage_length) { ?>
                <span class="error"><?php echo $error_securimage_length; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_perturbation; ?></label>
            <input type="text" required name="securimage_perturbation" class="small" value="<?php echo $securimage_perturbation; ?>" maxlength="4">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_perturbation; ?>', this, event, '')">[?]</a>
            <?php if ($error_securimage_perturbation) { ?>
                <span class="error"><?php echo $error_securimage_perturbation; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_lines; ?></label>
            <input type="text" required name="securimage_lines" class="small" value="<?php echo $securimage_lines; ?>" maxlength="2">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_lines; ?>', this, event, '')">[?]</a>
            <?php if ($error_securimage_lines) { ?>
                <span class="error"><?php echo $error_securimage_lines; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_noise; ?></label>
            <input type="text" required name="securimage_noise" class="small" value="<?php echo $securimage_noise; ?>" maxlength="2">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_noise; ?>', this, event, '')">[?]</a>
            <?php if ($error_securimage_noise) { ?>
                <span class="error"><?php echo $error_securimage_noise; ?></span>
            <?php } ?>
        </div>

        <h2 class="securimage_section"><?php echo $lang_subheading; ?></h2>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_text_color; ?></label>
            <input type="text" required name="securimage_text_color" class="medium" value="<?php echo $securimage_text_color; ?>" maxlength="7">
            <?php if ($error_securimage_text_color) { ?>
                <span class="error"><?php echo $error_securimage_text_color; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_line_color; ?></label>
            <input type="text" required name="securimage_line_color" class="medium" value="<?php echo $securimage_line_color; ?>" maxlength="7">
            <?php if ($error_securimage_line_color) { ?>
                <span class="error"><?php echo $error_securimage_line_color; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_back_color; ?></label>
            <input type="text" required name="securimage_back_color" class="medium" value="<?php echo $securimage_back_color; ?>" maxlength="7">
            <?php if ($error_securimage_back_color) { ?>
                <span class="error"><?php echo $error_securimage_back_color; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset securimage_section">
            <label><?php echo $lang_entry_noise_color; ?></label>
            <input type="text" required name="securimage_noise_color" class="medium" value="<?php echo $securimage_noise_color; ?>" maxlength="7">
            <?php if ($error_securimage_noise_color) { ?>
                <span class="error"><?php echo $error_securimage_noise_color; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('.recaptcha_section').hide();
        $('.securimage_section').hide();

        <?php if ($captcha_type == 'recaptcha') { ?>
            $('.recaptcha_section').show();
        <?php } ?>

        <?php if ($captcha_type == 'securimage') { ?>
            $('.securimage_section').show();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="captcha_type"]').on('change', function() {
            var type = $(this).val();

            if (type == 'recaptcha') {
                $('.recaptcha_section').show();
                $('.securimage_section').hide();
            } else {
                $('.recaptcha_section').hide();
                $('.securimage_section').show();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>