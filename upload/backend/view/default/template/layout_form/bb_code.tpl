<?php echo $header; ?>

<div class="layout_form_bb_code_page">

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

    <form action="index.php?route=layout_form/bb_code" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="enabled_bb_code" value="1" <?php if ($enabled_bb_code) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['bold']; ?>" title="<?php echo $lang_title_bold; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_bold" value="1" <?php if ($enabled_bb_code_bold) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['italic']; ?>" title="<?php echo $lang_title_italic; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_italic" value="1" <?php if ($enabled_bb_code_italic) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['underline']; ?>" title="<?php echo $lang_title_underline; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_underline" value="1" <?php if ($enabled_bb_code_underline) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['strike']; ?>" title="<?php echo $lang_title_strike; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_strike" value="1" <?php if ($enabled_bb_code_strike) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['superscript']; ?>" title="<?php echo $lang_title_superscript; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_superscript" value="1" <?php if ($enabled_bb_code_superscript) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['subscript']; ?>" title="<?php echo $lang_title_subscript; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_subscript" value="1" <?php if ($enabled_bb_code_subscript) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['code']; ?>" title="<?php echo $lang_title_code; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_code" value="1" <?php if ($enabled_bb_code_code) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['php']; ?>" title="<?php echo $lang_title_php; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_php" value="1" <?php if ($enabled_bb_code_php) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['quote']; ?>" title="<?php echo $lang_title_quote; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_quote" value="1" <?php if ($enabled_bb_code_quote) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['line']; ?>" title="<?php echo $lang_title_line; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_line" value="1" <?php if ($enabled_bb_code_line) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['bullet']; ?>" title="<?php echo $lang_title_bullet; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_bullet" value="1" <?php if ($enabled_bb_code_bullet) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['numeric']; ?>" title="<?php echo $lang_title_numeric; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_numeric" value="1" <?php if ($enabled_bb_code_numeric) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['link']; ?>" title="<?php echo $lang_title_link; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_link" value="1" <?php if ($enabled_bb_code_link) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['email']; ?>" title="<?php echo $lang_title_email; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_email" value="1" <?php if ($enabled_bb_code_email) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['image']; ?>" title="<?php echo $lang_title_image; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_image" value="1" <?php if ($enabled_bb_code_image) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset bb_image">
            <label><img src="<?php echo $bb_code['youtube']; ?>" title="<?php echo $lang_title_youtube; ?>"></label>
            <input type="checkbox" name="enabled_bb_code_youtube" value="1" <?php if ($enabled_bb_code_youtube) { echo 'checked'; } ?>>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($enabled_bb_code) { ?>
            $('.bb_image').show();
        <?php } else { ?>
            $('.bb_image').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[type="checkbox"][name="enabled_bb_code"]').on('click', function() {
            if ($(this).is(":checked")) {
                $('.bb_image').show();
            } else {
                $('.bb_image').hide();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>