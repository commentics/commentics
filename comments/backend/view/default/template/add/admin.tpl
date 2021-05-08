<?php echo $header; ?>

<div class="add_admin_page">

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

    <form action="index.php?route=add/admin" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_username; ?></label>
            <input type="text" required name="username" class="large" value="<?php echo $username; ?>" maxlength="250">
            <?php if ($error_username) { ?>
                <span class="error"><?php echo $error_username; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_password_1; ?></label>
            <input type="password" required name="password_1" class="large" value="" maxlength="250">
            <?php if ($error_password) { ?>
                <span class="error"><?php echo $error_password; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_password_2; ?></label>
            <input type="password" required name="password_2" class="large" value="" maxlength="250">
            <?php if ($error_password) { ?>
                <span class="error"><?php echo $error_password; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_strength; ?></label>
            <span id="password_strength" class="strength_0"></span>
            <span id="password_description"></span>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_email; ?></label>
            <input type="email" required name="email" class="large" value="<?php echo $email; ?>" maxlength="250">
            <?php if ($error_email) { ?>
                <span class="error"><?php echo $error_email; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="is_enabled" value="1" <?php if ($is_enabled) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_super; ?></label>
            <input type="checkbox" name="is_super" value="1" <?php if ($is_super) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_super; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_restrict; ?></label>
            <input type="checkbox" name="restrict_pages" value="1" <?php if ($restrict_pages) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_restrict; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset restriction_fieldset" style="display:none">
            <label></label>
            <span class="note"><?php echo $lang_text_allowed_pages; ?></span>
        </div>

        <?php foreach ($restrictions as $restriction) { ?>
            <div class="fieldset restriction_fieldset <?php if ($restriction['is_top']) { echo 'restriction_fieldset_top'; } ?>" style="display:none">
                <label></label>

                <input type="checkbox" name="viewable_pages[]" style="margin-left: <?php echo $restriction['indent']; ?>" value="<?php echo $restriction['page']; ?>" <?php if ($restriction['is_viewable']) { echo 'checked'; } ?>>

                <?php if (!$restriction['is_top']) { ?>
                    <input type="checkbox" name="modifiable_pages[]" value="<?php echo $restriction['page']; ?>" <?php if ($restriction['is_modifiable']) { echo 'checked'; } ?>>
                <?php } ?>

                <?php if (!$restriction['is_top']) { ?>
                    <span class="restriction_menu"><?php echo $restriction['title']; ?></span>
                <?php } else { ?>
                    <span class="restriction_menu_top"><?php echo $restriction['title']; ?></span>
                <?php } ?>
            </div>
        <?php } ?>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_add; ?>" title="<?php echo $lang_button_add; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($restrict_pages) { ?>
            $('.restriction_fieldset').show();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name="restrict_pages"]').change(function() {
            if ($(this).is(':checked')) {
                $('.restriction_fieldset').show();
            } else {
                $('.restriction_fieldset').hide();
            }
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('.restriction_fieldset input[type="checkbox"]').change(function() {
            $('input[name="viewable_pages[]"]').each(function() {
                if ($(this).next().attr('name') == 'modifiable_pages[]') {
                     if ($(this).is(':checked')) {
                         $(this).next().prop('disabled', false);
                     } else {
                         $(this).next().prop('checked', false);
                         $(this).next().prop('disabled', true);
                     }
                }
            });
        });

        $('.restriction_fieldset input[type="checkbox"]').trigger('change');
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>