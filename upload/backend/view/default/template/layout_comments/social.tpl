<?php echo $header; ?>

<div class="layout_comments_social_page">

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

    <form action="index.php?route=layout_comments/social" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="show_social" value="1" <?php if ($show_social) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset social">
            <label><?php echo $lang_entry_window; ?></label>
            <input type="checkbox" name="social_new_window" value="1" <?php if ($social_new_window) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_window; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset social">
            <label><img src="<?php echo $socials['digg']; ?>" title="<?php echo $lang_title_digg; ?>"></label>
            <input type="checkbox" name="show_social_digg" value="1" <?php if ($show_social_digg) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset social">
            <label><img src="<?php echo $socials['facebook']; ?>" title="<?php echo $lang_title_facebook; ?>"></label>
            <input type="checkbox" name="show_social_facebook" value="1" <?php if ($show_social_facebook) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset social">
            <label><img src="<?php echo $socials['linkedin']; ?>" title="<?php echo $lang_title_linkedin; ?>"></label>
            <input type="checkbox" name="show_social_linkedin" value="1" <?php if ($show_social_linkedin) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset social">
            <label><img src="<?php echo $socials['reddit']; ?>" title="<?php echo $lang_title_reddit; ?>"></label>
            <input type="checkbox" name="show_social_reddit" value="1" <?php if ($show_social_reddit) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset social">
            <label><img src="<?php echo $socials['twitter']; ?>" title="<?php echo $lang_title_twitter; ?>"></label>
            <input type="checkbox" name="show_social_twitter" value="1" <?php if ($show_social_twitter) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset social">
            <label><img src="<?php echo $socials['weibo']; ?>" title="<?php echo $lang_title_weibo; ?>"></label>
            <input type="checkbox" name="show_social_weibo" value="1" <?php if ($show_social_weibo) { echo 'checked'; } ?>>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($show_social) { ?>
            $('.social').show();
        <?php } else { ?>
            $('.social').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[type="checkbox"][name="show_social"]').on('click', function() {
            if ($(this).is(":checked")) {
                $('.social').show();
            } else {
                $('.social').hide();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>