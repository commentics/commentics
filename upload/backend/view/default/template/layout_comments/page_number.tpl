<?php echo $header; ?>

<div class="layout_comments_page_number_page">

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

    <form action="index.php?route=layout_comments/page_number" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="show_page_number" value="1" <?php if ($show_page_number) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_format; ?></label>
            <select name="page_number_format">
                <option value="Page X" <?php if ($page_number_format == 'Page X') { echo 'selected'; } ?>><?php echo $lang_select_page_x; ?></option>
                <option value="Page X of Y" <?php if ($page_number_format == 'Page X of Y') { echo 'selected'; } ?>><?php echo $lang_select_page_x_of_y; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_format; ?>', this, event, '')">[?]</a>
            <?php if ($error_page_number_format) { ?>
                <span class="error"><?php echo $error_page_number_format; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

</div>

<?php echo $footer; ?>