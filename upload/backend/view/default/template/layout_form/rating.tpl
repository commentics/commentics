<?php echo $header; ?>

<div class="layout_form_rating_page">

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

    <form action="index.php?route=layout_form/rating" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="enabled_rating" value="1" <?php if ($enabled_rating) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_required; ?></label>
            <input type="checkbox" name="required_rating" value="1" <?php if ($required_rating) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_required; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_default; ?></label>
            <select name="default_rating">
                <option value=""><?php echo $lang_select_select; ?></option>
                <option value="1" <?php if ($default_rating == '1') { echo 'selected'; } ?>><?php echo $lang_select_rating_1; ?></option>
                <option value="2" <?php if ($default_rating == '2') { echo 'selected'; } ?>><?php echo $lang_select_rating_2; ?></option>
                <option value="3" <?php if ($default_rating == '3') { echo 'selected'; } ?>><?php echo $lang_select_rating_3; ?></option>
                <option value="4" <?php if ($default_rating == '4') { echo 'selected'; } ?>><?php echo $lang_select_rating_4; ?></option>
                <option value="5" <?php if ($default_rating == '5') { echo 'selected'; } ?>><?php echo $lang_select_rating_5; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_default; ?>', this, event, '')">[?]</a>
            <?php if ($error_default_rating) { ?>
                <span class="error"><?php echo $error_default_rating; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_repeat; ?></label>
            <select name="repeat_rating">
                <option value="normal" <?php if ($repeat_rating == 'normal') { echo 'selected'; } ?>><?php echo $lang_select_normal; ?></option>
                <option value="hide" <?php if ($repeat_rating == 'hide') { echo 'selected'; } ?>><?php echo $lang_select_hide; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_repeat; ?>', this, event, '')">[?]</a>
            <?php if ($error_repeat_rating) { ?>
                <span class="error"><?php echo $error_repeat_rating; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

</div>

<?php echo $footer; ?>