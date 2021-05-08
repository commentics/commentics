<?php echo $header; ?>

<div class="tool_upgrade_page">

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

    <div id="upgrade-progress"></div>

    <?php if ($start) { ?>
        <script>$(document).ready(function() { cmtx_start_upgrade('<?php echo $csrf_key; ?>'); });</script>
    <?php } else { ?>
        <?php if ($next_version) { ?>
            <p><?php echo $lang_text_newer; ?> <?php echo $lang_text_version; ?></p>

            <form action="index.php?route=tool/upgrade" class="controls" method="post">
                <textarea readonly><?php echo $changelog; ?></textarea>

                <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

                <p><input type="submit" class="button" value="<?php echo $lang_button_upgrade; ?>" title="<?php echo $lang_button_upgrade; ?>"></p>
            </form>
        <?php } else { ?>
            <p><?php echo $lang_text_no_update; ?></p>
        <?php } ?>
    <?php } ?>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('div.info a:last-child').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'index.php?route=tool/upgrade/dismiss',
            })

            $('div.info').fadeOut(2000);
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>