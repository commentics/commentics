<?php echo $header; ?>

<div class="layout_comments_flag_page">

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

    <form action="index.php?route=layout_comments/flag" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="show_flag" value="1" <?php if ($show_flag) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_max_per_user; ?></label>
            <input type="text" required name="flag_max_per_user" class="small" value="<?php echo $flag_max_per_user; ?>" maxlength="4">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_max_per_user; ?>', this, event, '')">[?]</a>
            <?php if ($error_flag_max_per_user) { ?>
                <span class="error"><?php echo $error_flag_max_per_user; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_min_per_comment; ?></label>
            <input type="text" required name="flag_min_per_comment" class="small" value="<?php echo $flag_min_per_comment; ?>" maxlength="4">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_min_per_comment; ?>', this, event, '')">[?]</a>
            <?php if ($error_flag_min_per_comment) { ?>
                <span class="error"><?php echo $error_flag_min_per_comment; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_disapprove; ?></label>
            <input type="checkbox" name="flag_disapprove" value="1" <?php if ($flag_disapprove) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_disapprove; ?>', this, event, '')">[?]</a>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

</div>

<?php echo $footer; ?>