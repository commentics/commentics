<?php echo $header; ?>

<div class="extension_modules_page">

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

    <form action="index.php?route=extension/modules" class="controls" method="post">
        <div class="table_container">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo $lang_column_name; ?></th>
                        <th><?php echo $lang_column_action; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($modules) { ?>
                        <?php foreach ($modules as $module) { ?>
                            <tr>
                                <td data-th="<?php echo $lang_column_name; ?>:"><?php echo $module['name']; ?></td>
                                <?php if ($module['installed']) { ?>
                                    <td data-th="<?php echo $lang_column_action; ?>:">
                                        <a href="<?php echo $module['url']; ?>"><?php echo $lang_link_edit; ?></a>
                                        <a data-id="<?php echo $module['module']; ?>" class="uninstall"><?php echo $lang_link_uninstall; ?></a>
                                    </td>
                                <?php } else { ?>
                                    <td data-th="<?php echo $lang_column_action; ?>:"><a data-id="<?php echo $module['module']; ?>" class="install"><?php echo $lang_link_install; ?></a></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td class="no_results" colspan="2"><?php echo $lang_text_no_results; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">
    </form>

    <div id="uninstall_dialog" title="<?php echo $lang_dialog_uninstall_title; ?>" style="display:none">
        <span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_uninstall_content; ?>
    </div>

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
        $('.install').click(function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            var input = $('<input>').attr('type', 'hidden').attr('name', 'module').val(id);

            $('form').append($(input));

            $('form').attr('action', 'index.php?route=extension/modules/install');

            $('form').submit();
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('.uninstall').click(function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#uninstall_dialog').dialog({
                modal: true,
                height: 'auto',
                width: 'auto',
                resizable: false,
                draggable: false,
                center: true,
                buttons: {
                    '<?php echo $lang_dialog_yes; ?>': function() {
                        var input = $('<input>').attr('type', 'hidden').attr('name', 'module').val(id);

                        $('form').append($(input));

                        $('form').attr('action', 'index.php?route=extension/modules/uninstall');

                        $('form').submit();

                        $(this).dialog('close');
                    },
                    '<?php echo $lang_dialog_no; ?>': function() {
                        $(this).dialog('close');
                    }
                }
            });

            $('#uninstall_dialog').dialog('open');
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>