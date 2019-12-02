<?php echo $header; ?>

<div class="report_version_check_page">

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

    <div class="controls">
        <textarea name="log" readonly><?php echo $log; ?></textarea>
    </div>

    <p><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></p>

</div>

<?php echo $footer; ?>