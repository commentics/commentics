<?php echo $header; ?>

<div class="layout_comments_share_page">

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

    <form action="index.php?route=layout_comments/share" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="show_share" value="1" <?php if ($show_share) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset share">
            <label><?php echo $lang_entry_window; ?></label>
            <input type="checkbox" name="share_new_window" value="1" <?php if ($share_new_window) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_window; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset share">
            <label><img src="<?php echo $shares['digg']; ?>" title="<?php echo $lang_title_digg; ?>"></label>
            <input type="checkbox" name="show_share_digg" value="1" <?php if ($show_share_digg) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset share">
            <label><img src="<?php echo $shares['facebook']; ?>" title="<?php echo $lang_title_facebook; ?>"></label>
            <input type="checkbox" name="show_share_facebook" value="1" <?php if ($show_share_facebook) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset share">
            <label><img src="<?php echo $shares['linkedin']; ?>" title="<?php echo $lang_title_linkedin; ?>"></label>
            <input type="checkbox" name="show_share_linkedin" value="1" <?php if ($show_share_linkedin) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset share">
            <label><img src="<?php echo $shares['reddit']; ?>" title="<?php echo $lang_title_reddit; ?>"></label>
            <input type="checkbox" name="show_share_reddit" value="1" <?php if ($show_share_reddit) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset share">
            <label><img src="<?php echo $shares['twitter']; ?>" title="<?php echo $lang_title_twitter; ?>"></label>
            <input type="checkbox" name="show_share_twitter" value="1" <?php if ($show_share_twitter) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset share">
            <label><img src="<?php echo $shares['weibo']; ?>" title="<?php echo $lang_title_weibo; ?>"></label>
            <input type="checkbox" name="show_share_weibo" value="1" <?php if ($show_share_weibo) { echo 'checked'; } ?>>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($show_share) { ?>
            $('.share').show();
        <?php } else { ?>
            $('.share').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[type="checkbox"][name="show_share"]').on('click', function() {
            if ($(this).is(":checked")) {
                $('.share').show();
            } else {
                $('.share').hide();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>