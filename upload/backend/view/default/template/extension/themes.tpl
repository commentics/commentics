<?php echo $header; ?>

<div class="extension_themes_page">

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

    <form action="index.php?route=extension/themes" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_frontend; ?></label>
            <select name="theme_frontend" class="medium">
            <?php foreach ($frontend_themes as $key => $value) { ?>
                <option value="<?php echo $value; ?>" <?php if ($value == $theme_frontend) { echo 'selected'; } ?>><?php echo $key; ?></option>
            <?php } ?>
            </select>
            <?php if ($error_theme_frontend) { ?>
                <span class="error"><?php echo $error_theme_frontend; ?></span>
            <?php } ?>
        </div>

        <img id="theme-preview-frontend" class="theme_preview" src="" alt="">

        <div class="fieldset">
            <label><?php echo $lang_entry_backend; ?></label>
            <select name="theme_backend" class="medium">
            <?php foreach ($backend_themes as $key => $value) { ?>
                <option value="<?php echo $value; ?>" <?php if ($value == $theme_backend) { echo 'selected'; } ?>><?php echo $key; ?></option>
            <?php } ?>
            </select>
            <?php if ($error_theme_backend) { ?>
                <span class="error"><?php echo $error_theme_backend; ?></span>
            <?php } ?>
        </div>

        <img id="theme-preview-backend" class="theme_preview" src="" alt="">

        <h2><?php echo $lang_subheading; ?></h2>

        <div class="fieldset">
            <label><?php echo $lang_entry_auto_detect; ?></label>
            <input type="checkbox" name="auto_detect" value="1" <?php if ($auto_detect) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_auto_detect; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_optimize; ?></label>
            <input type="checkbox" name="optimize" value="1" <?php if ($optimize) { echo 'checked'; } ?>>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_optimize; ?>', this, event, '')">[?]</a>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_jquery; ?></label>
            <select name="jquery_source">
                <option value="" <?php if ($jquery_source == '') { echo 'selected'; } ?>><?php echo $lang_select_no; ?></option>
                <option value="local" <?php if ($jquery_source == 'local') { echo 'selected'; } ?>><?php echo $lang_select_local; ?></option>
                <option value="google" <?php if ($jquery_source == 'google') { echo 'selected'; } ?>><?php echo $lang_select_google; ?></option>
                <option value="jquery" <?php if ($jquery_source == 'jquery') { echo 'selected'; } ?>><?php echo $lang_select_jquery; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_jquery_source; ?>', this, event, '')">[?]</a>
            <?php if ($error_jquery_source) { ?>
                <span class="error"><?php echo $error_jquery_source; ?></span>
            <?php } ?>
        </div>

        <p><?php echo $lang_text_parts; ?></p>

        <div class="sortable">
            <ul id="sortable">
                <?php if ($order_parts == '1,2') { ?>
                    <li id="1" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $lang_text_form; ?></li>
                    <li id="2" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $lang_text_comments; ?></li>
                <?php } else { ?>
                    <li id="2" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $lang_text_comments; ?></li>
                    <li id="1" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $lang_text_form; ?></li>
                <?php } ?>
            </ul>
            <?php if ($error_order_parts) { ?>
                <span class="error"><?php echo $error_order_parts; ?></span>
            <?php } ?>
        </div>

        <input type="hidden" name="order_parts" value="<?php echo $order_parts; ?>">

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('div.info a:last-child').click(function(e) {
            e.preventDefault();

            $('div.info').fadeOut(2000);
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="theme_frontend"]').change(function() {
            var theme = $('select[name="theme_frontend"]').val();

            var request = $.ajax({
                type: 'POST',
                cache: false,
                url: 'index.php?route=extension/themes/previewFrontend',
                data: 'theme=' + encodeURIComponent(theme),
                dataType: 'json',
                beforeSend: function() {
                    $('select[name="theme_frontend"]').after('<span class="fa fa-circle-o-notch fa-spin"></span>');
                }
            });

            request.always(function() {
                $('.fa-spin').remove();
            });

            request.done(function(response) {
                $('#theme-preview-frontend').attr('src', response['preview']);
            });

            request.fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        $('select[name="theme_frontend"]').trigger('change');
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="theme_backend"]').change(function() {
            var theme = $('select[name="theme_backend"]').val();

            var request = $.ajax({
                type: 'POST',
                cache: false,
                url: 'index.php?route=extension/themes/previewBackend',
                data: 'theme=' + encodeURIComponent(theme),
                dataType: 'json',
                beforeSend: function() {
                    $('select[name="theme_backend"]').after('<span class="fa fa-circle-o-notch fa-spin"></span>');
                }
            });

            request.always(function() {
                $('.fa-spin').remove();
            });

            request.done(function(response) {
                $('#theme-preview-backend').attr('src', response['preview']);
            });

            request.fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        $('select[name="theme_backend"]').trigger('change');
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('#sortable').sortable({
            update: function() {
                var order = $(this).sortable('toArray').toString();

                $('input[name="order_parts"]').val(order);
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>