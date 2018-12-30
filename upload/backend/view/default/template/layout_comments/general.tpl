<?php echo $header; ?>

<div class="layout_comments_general_page">

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

    <form action="index.php?route=layout_comments/general" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_display_count; ?></label>
            <input type="checkbox" name="show_comment_count" value="1" <?php if ($show_comment_count) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_display_count; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_default_order; ?></label>
            <select name="comments_order">
                <option value="1" <?php if ($comments_order == '1') { echo 'selected'; } ?>><?php echo $lang_select_newest; ?></option>
                <option value="2" <?php if ($comments_order == '2') { echo 'selected'; } ?>><?php echo $lang_select_oldest; ?></option>
                <option value="3" <?php if ($comments_order == '3') { echo 'selected'; } ?>><?php echo $lang_select_likes; ?></option>
                <option value="4" <?php if ($comments_order == '4') { echo 'selected'; } ?>><?php echo $lang_select_dislikes; ?></option>
                <option value="5" <?php if ($comments_order == '5') { echo 'selected'; } ?>><?php echo $lang_select_positive; ?></option>
                <option value="6" <?php if ($comments_order == '6') { echo 'selected'; } ?>><?php echo $lang_select_critical; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_default_order; ?>', this, event, '')">[?]</a>
            <?php if ($error_comments_order) { ?>
                <span class="error"><?php echo $error_comments_order; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_display_says; ?></label>
            <input type="checkbox" name="show_says" value="1" <?php if ($show_says) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_display_says; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_positions; ?></label>
            <div class="position_block">
                <div class="row row_1">
                    <div class="left">
                        <select name="comments_position_1">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_1 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_1) { ?>
                            <span class="error"><?php echo $error_comments_position_1; ?></span>
                        <?php } ?>
                    </div>

                    <div class="center">
                        <select name="comments_position_2">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_2 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_2) { ?>
                            <span class="error"><?php echo $error_comments_position_2; ?></span>
                        <?php } ?>
                    </div>

                    <div class="right">
                        <select name="comments_position_3">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_3 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_3) { ?>
                            <span class="error"><?php echo $error_comments_position_3; ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="row row_2">
                    <div class="left">
                        <select name="comments_position_4">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_4 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_4) { ?>
                            <span class="error"><?php echo $error_comments_position_4; ?></span>
                        <?php } ?>
                    </div>

                    <div class="center">
                        <select name="comments_position_5">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_5 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_5) { ?>
                            <span class="error"><?php echo $error_comments_position_5; ?></span>
                        <?php } ?>
                    </div>

                    <div class="right">
                        <select name="comments_position_6">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_6 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_6) { ?>
                            <span class="error"><?php echo $error_comments_position_6; ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="comments">
                    <?php echo $lang_text_comments; ?>
                </div>

                <div class="row row_3">
                    <div class="left">
                        <select name="comments_position_7">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_7 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_7) { ?>
                            <span class="error"><?php echo $error_comments_position_7; ?></span>
                        <?php } ?>
                    </div>

                    <div class="center">
                        <select name="comments_position_8">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_8 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_8) { ?>
                            <span class="error"><?php echo $error_comments_position_8; ?></span>
                        <?php } ?>
                    </div>

                    <div class="right">
                        <select name="comments_position_9">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_9 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_9) { ?>
                            <span class="error"><?php echo $error_comments_position_9; ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="row row_4">
                    <div class="left">
                        <select name="comments_position_10">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_10 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_10) { ?>
                            <span class="error"><?php echo $error_comments_position_10; ?></span>
                        <?php } ?>
                    </div>

                    <div class="center">
                        <select name="comments_position_11">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_11 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_11) { ?>
                            <span class="error"><?php echo $error_comments_position_11; ?></span>
                        <?php } ?>
                    </div>

                    <div class="right">
                        <select name="comments_position_12">
                            <?php foreach ($elements as $selection => $value) { ?>
                                <option value="<?php echo $value; ?>" <?php if ($comments_position_12 == $value) { echo 'selected'; } ?>><?php echo $selection; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($error_comments_position_12) { ?>
                            <span class="error"><?php echo $error_comments_position_12; ?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

</div>

<?php echo $footer; ?>