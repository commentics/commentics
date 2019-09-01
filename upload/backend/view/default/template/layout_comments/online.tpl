<?php echo $header; ?>

<div class="layout_comments_online_page">

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

    <form action="index.php?route=layout_comments/online" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="show_online" value="1" <?php if ($show_online) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_refresh; ?></label>
            <input type="checkbox" name="online_refresh_enabled" value="1" <?php if ($online_refresh_enabled) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_refresh; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_interval; ?></label>
            <input type="text" required name="online_refresh_interval" class="small" value="<?php echo $online_refresh_interval; ?>" maxlength="3">
            <span class="note"><?php echo $lang_note_seconds; ?></span>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_interval; ?>', this, event, '')">[?]</a>
            <?php if ($error_online_refresh_interval) { ?>
                <span class="error"><?php echo $error_online_refresh_interval; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('div.info a:last-child').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'index.php?route=layout_comments/online/dismiss',
            })

            $('div.info').fadeOut(2000);
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>