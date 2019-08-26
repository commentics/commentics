<?php echo $header; ?>

<div class="layout_comments_gravatar_page">

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

    <form action="index.php?route=layout_comments/gravatar" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="show_gravatar" value="1" <?php if ($show_gravatar) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_default; ?></label>
            <select name="gravatar_default">
                <option value="" <?php if ($gravatar_default == 'default') { echo 'selected'; } ?>><?php echo $lang_select_default; ?></option>
                <option value="custom" <?php if ($gravatar_default == 'custom') { echo 'selected'; } ?>><?php echo $lang_select_custom; ?></option>
                <option value="mm" <?php if ($gravatar_default == 'mm') { echo 'selected'; } ?>><?php echo $lang_select_mm; ?></option>
                <option value="identicon" <?php if ($gravatar_default == 'identicon') { echo 'selected'; } ?>><?php echo $lang_select_identicon; ?></option>
                <option value="monsterid" <?php if ($gravatar_default == 'monsterid') { echo 'selected'; } ?>><?php echo $lang_select_monsterid; ?></option>
                <option value="wavatar" <?php if ($gravatar_default == 'wavatar') { echo 'selected'; } ?>><?php echo $lang_select_wavatar; ?></option>
                <option value="retro" <?php if ($gravatar_default == 'retro') { echo 'selected'; } ?>><?php echo $lang_select_retro; ?></option>
                <option value="robohash" <?php if ($gravatar_default == 'robohash') { echo 'selected'; } ?>><?php echo $lang_select_robohash; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_default; ?>', this, event, '')">[?]</a>
            <?php if ($error_gravatar_default) { ?>
                <span class="error"><?php echo $error_gravatar_default; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset custom_section">
            <label><?php echo $lang_entry_custom; ?></label>
            <input type="text" name="gravatar_custom" class="large" value="<?php echo $gravatar_custom; ?>" placeholder="http://" maxlength="250">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_custom; ?>', this, event, '')">[?]</a>
            <?php if ($error_gravatar_custom) { ?>
                <span class="error"><?php echo $error_gravatar_custom; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_size; ?></label>
            <input type="text" required name="gravatar_size" class="small" value="<?php echo $gravatar_size; ?>" maxlength="4">
            <span class="note"><?php echo $lang_note_pixels; ?></span>
            <?php if ($error_gravatar_size) { ?>
                <span class="error"><?php echo $error_gravatar_size; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset divide_after">
            <label><?php echo $lang_entry_rating; ?></label>
            <select name="gravatar_rating">
                <option value="g" <?php if ($gravatar_default == 'g') { echo 'selected'; } ?>>G</option>
                <option value="pg" <?php if ($gravatar_default == 'pg') { echo 'selected'; } ?>>PG</option>
                <option value="r" <?php if ($gravatar_default == 'r') { echo 'selected'; } ?>>R</option>
                <option value="x" <?php if ($gravatar_default == 'x') { echo 'selected'; } ?>>X</option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_rating; ?>', this, event, '')">[?]</a>
            <?php if ($error_gravatar_rating) { ?>
                <span class="error"><?php echo $error_gravatar_rating; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_show_level; ?></label>
            <input type="checkbox" name="show_level" value="1" <?php if ($show_level) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_show_level; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_level_5; ?></label>
            <input type="text" required name="level_5" class="small" value="<?php echo $level_5; ?>" maxlength="5">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_level_5; ?>', this, event, '')">[?]</a>
            <?php if ($error_level_5) { ?>
                <span class="error"><?php echo $error_level_5; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_level_4; ?></label>
            <input type="text" required name="level_4" class="small" value="<?php echo $level_4; ?>" maxlength="5">
            <?php if ($error_level_4) { ?>
                <span class="error"><?php echo $error_level_4; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_level_3; ?></label>
            <input type="text" required name="level_3" class="small" value="<?php echo $level_3; ?>" maxlength="5">
            <?php if ($error_level_3) { ?>
                <span class="error"><?php echo $error_level_3; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_level_2; ?></label>
            <input type="text" required name="level_2" class="small" value="<?php echo $level_2; ?>" maxlength="5">
            <?php if ($error_level_2) { ?>
                <span class="error"><?php echo $error_level_2; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_level_1; ?></label>
            <input type="text" required name="level_1" class="small" value="<?php echo $level_1; ?>" maxlength="5">
            <?php if ($error_level_1) { ?>
                <span class="error"><?php echo $error_level_1; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset divide_after">
            <label><?php echo $lang_entry_level_0; ?></label>
            <input type="text" required name="level_0" class="small" value="<?php echo $level_0; ?>" maxlength="5">
            <?php if ($error_level_0) { ?>
                <span class="error"><?php echo $error_level_0; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_show_bio; ?></label>
            <input type="checkbox" name="show_bio" value="1" <?php if ($show_bio) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_show_bio; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_top_poster; ?></label>
            <input type="checkbox" name="show_badge_top_poster" value="1" <?php if ($show_badge_top_poster) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_top_poster; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_most_likes; ?></label>
            <input type="checkbox" name="show_badge_most_likes" value="1" <?php if ($show_badge_most_likes) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_most_likes; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_first_poster; ?></label>
            <input type="checkbox" name="show_badge_first_poster" value="1" <?php if ($show_badge_first_poster) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_first_poster; ?>', this, event, '')">[?]</a>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($gravatar_default == 'custom' || $error_gravatar_custom) { ?>
            $('.custom_section').show();
        <?php } else { ?>
            $('.custom_section').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="gravatar_default"]').on('change', function() {
            var gravatar_default = $(this).val();

            if (gravatar_default == 'custom') {
                $('.custom_section').show();
            } else {
                $('.custom_section').hide();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>