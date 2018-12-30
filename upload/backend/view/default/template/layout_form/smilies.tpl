<?php echo $header; ?>

<div class="layout_form_smilies_page">

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

    <form action="index.php?route=layout_form/smilies" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="enabled_smilies" value="1" <?php if ($enabled_smilies) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['smile']; ?>" title="<?php echo $lang_title_smile; ?>"></label>
            <input type="checkbox" name="enabled_smilies_smile" value="1" <?php if ($enabled_smilies_smile) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['sad']; ?>" title="<?php echo $lang_title_sad; ?>"></label>
            <input type="checkbox" name="enabled_smilies_sad" value="1" <?php if ($enabled_smilies_sad) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['huh']; ?>" title="<?php echo $lang_title_huh; ?>"></label>
            <input type="checkbox" name="enabled_smilies_huh" value="1" <?php if ($enabled_smilies_huh) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['laugh']; ?>" title="<?php echo $lang_title_laugh; ?>"></label>
            <input type="checkbox" name="enabled_smilies_laugh" value="1" <?php if ($enabled_smilies_laugh) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['mad']; ?>" title="<?php echo $lang_title_mad; ?>"></label>
            <input type="checkbox" name="enabled_smilies_mad" value="1" <?php if ($enabled_smilies_mad) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['tongue']; ?>" title="<?php echo $lang_title_tongue; ?>"></label>
            <input type="checkbox" name="enabled_smilies_tongue" value="1" <?php if ($enabled_smilies_tongue) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['cry']; ?>" title="<?php echo $lang_title_cry; ?>"></label>
            <input type="checkbox" name="enabled_smilies_cry" value="1" <?php if ($enabled_smilies_cry) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['grin']; ?>" title="<?php echo $lang_title_grin; ?>"></label>
            <input type="checkbox" name="enabled_smilies_grin" value="1" <?php if ($enabled_smilies_grin) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['wink']; ?>" title="<?php echo $lang_title_wink; ?>"></label>
            <input type="checkbox" name="enabled_smilies_wink" value="1" <?php if ($enabled_smilies_wink) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['scared']; ?>" title="<?php echo $lang_title_scared; ?>"></label>
            <input type="checkbox" name="enabled_smilies_scared" value="1" <?php if ($enabled_smilies_scared) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['cool']; ?>" title="<?php echo $lang_title_cool; ?>"></label>
            <input type="checkbox" name="enabled_smilies_cool" value="1" <?php if ($enabled_smilies_cool) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['sleep']; ?>" title="<?php echo $lang_title_sleep; ?>"></label>
            <input type="checkbox" name="enabled_smilies_sleep" value="1" <?php if ($enabled_smilies_sleep) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['blush']; ?>" title="<?php echo $lang_title_blush; ?>"></label>
            <input type="checkbox" name="enabled_smilies_blush" value="1" <?php if ($enabled_smilies_blush) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['confused']; ?>" title="<?php echo $lang_title_confused; ?>"></label>
            <input type="checkbox" name="enabled_smilies_confused" value="1" <?php if ($enabled_smilies_confused) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset smiley_image">
            <label><img src="<?php echo $smilies['shocked']; ?>" title="<?php echo $lang_title_shocked; ?>"></label>
            <input type="checkbox" name="enabled_smilies_shocked" value="1" <?php if ($enabled_smilies_shocked) { echo 'checked'; } ?>>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($enabled_smilies) { ?>
            $('.smiley_image').show();
        <?php } else { ?>
            $('.smiley_image').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[type="checkbox"][name="enabled_smilies"]').on('click', function() {
            if ($(this).is(":checked")) {
                $('.smiley_image').show();
            } else {
                $('.smiley_image').hide();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>