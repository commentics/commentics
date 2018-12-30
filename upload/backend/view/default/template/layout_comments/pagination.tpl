<?php echo $header; ?>

<div class="layout_comments_pagination_page">

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

    <form action="index.php?route=layout_comments/pagination" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="show_pagination" value="1" <?php if ($show_pagination) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_enabled; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_type; ?></label>
            <select name="pagination_type">
                <option value="multiple" <?php if ($pagination_type == 'multiple') { echo 'selected'; } ?>><?php echo $lang_select_multiple; ?></option>
                <option value="button" <?php if ($pagination_type == 'button') { echo 'selected'; } ?>><?php echo $lang_select_button; ?></option>
                <option value="infinite" <?php if ($pagination_type == 'infinite') { echo 'selected'; } ?>><?php echo $lang_select_infinite; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_type; ?>', this, event, '')">[?]</a>
            <?php if ($error_pagination_type) { ?>
                <span class="error"><?php echo $error_pagination_type; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_amount; ?></label>
            <input type="text" required name="pagination_amount" class="small" value="<?php echo $pagination_amount; ?>" maxlength="3">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_amount; ?>', this, event, '')">[?]</a>
            <?php if ($error_pagination_amount) { ?>
                <span class="error"><?php echo $error_pagination_amount; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset range_section">
            <label><?php echo $lang_entry_range; ?></label>
            <input type="text" required name="pagination_range" class="small" value="<?php echo $pagination_range; ?>" maxlength="2">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_range; ?>', this, event, '')">[?]</a>
            <?php if ($error_pagination_range) { ?>
                <span class="error"><?php echo $error_pagination_range; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($pagination_type == 'multiple' || $error_pagination_range) { ?>
            $('.range_section').show();
        <?php } else { ?>
            $('.range_section').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="pagination_type"]').on('change', function() {
            var pagination_type = $(this).val();

            if (pagination_type == 'multiple') {
                $('.range_section').show();
            } else {
                $('.range_section').hide();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>