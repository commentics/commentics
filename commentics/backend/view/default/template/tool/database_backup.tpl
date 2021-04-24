<?php echo $header; ?>

<div class="tool_database_backup_page">

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

    <div class="filter">
        <div class="row">
            <div class="column">
                <label><?php echo $lang_filter_description; ?></label>
                <input type="text" name="filter_description" value="<?php echo $filter_description; ?>">
            </div>

            <div class="column">
                <label><?php echo $lang_filter_filename; ?></label>
                <input type="text" name="filter_filename" value="<?php echo $filter_filename; ?>">
            </div>

            <div class="column">
                <label><?php echo $lang_filter_date; ?></label>
                <input type="text" class="datepicker" name="filter_date" value="<?php echo $filter_date; ?>" placeholder="YYYY-MM-DD">

                <input type="button" id="filter" class="button" value="<?php echo $lang_button_filter; ?>" title="<?php echo $lang_button_filter; ?>">
            </div>
        </div>
    </div>

    <form action="index.php?route=tool/database_backup" class="controls" method="post">
        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <p>
            <input type="text" required name="description" class="medium_plus" placeholder="<?php echo $lang_text_description; ?>" maxlength="100">

            <input type="submit" name="create" class="button" value="<?php echo $lang_button_create; ?>" title="<?php echo $lang_button_create; ?>">
        </p>
    </form>

    <form action="index.php?route=tool/database_backup" class="controls" method="post">
        <div class="table_container">
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th><a href="<?php echo $sort_description; ?>" <?php if ($sort == 'b.description') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_description; ?></a></th>
                        <th><a href="<?php echo $sort_filename; ?>" <?php if ($sort == 'b.filename') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_filename; ?></a></th>
                        <th><?php echo $lang_column_size; ?></th>
                        <th><a href="<?php echo $sort_date; ?>" <?php if ($sort == 'b.date_added') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_date; ?></a></th>
                        <th><?php echo $lang_column_action; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($backups) { ?>
                        <?php foreach ($backups as $backup) { ?>
                            <tr>
                                <td class="selector"><input type="checkbox" name="bulk[]" value="<?php echo $backup['id']; ?>"></td>
                                <td data-th="<?php echo $lang_column_description; ?>:"><?php echo $backup['description']; ?></td>
                                <td data-th="<?php echo $lang_column_filename; ?>:"><a href="<?php echo $backup['url']; ?>" download><?php echo $backup['filename']; ?></a></td>
                                <td data-th="<?php echo $lang_column_size; ?>:"><?php echo $backup['size']; ?></td>
                                <td data-th="<?php echo $lang_column_date; ?>:"><?php echo $backup['dated']; ?></td>
                                <td class="actions"><a data-id="<?php echo $backup['id']; ?>" class="single_delete"><img src="<?php echo $button_delete; ?>" class="button_delete" title="<?php echo $lang_button_delete; ?>"></a></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td class="no_results" colspan="6"><?php echo $lang_text_no_results; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <p><input type="submit" name="bulk_delete" class="button" value="<?php echo $lang_button_delete; ?>" title="<?php echo $lang_button_delete; ?>"></p>
    </form>

    <div class="pagination_stats"><?php echo $pagination_stats; ?></div>

    <div class="pagination_links"><?php echo $pagination_links; ?></div>

    <div id="single_delete_dialog" title="<?php echo $lang_dialog_single_delete_title; ?>" style="display:none">
        <span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_single_delete_content; ?>
    </div>

    <div id="bulk_delete_dialog" title="<?php echo $lang_dialog_bulk_delete_title; ?>" style="display:none">
        <span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_bulk_delete_content; ?>
    </div>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('#filter').click(function() {
            var url = 'index.php?route=tool/database_backup';

            var filter_description = $('input[name="filter_description"]').val();

            if (filter_description) {
                url += '&filter_description=' + encodeURIComponent(filter_description);
            }

            var filter_filename = $('input[name="filter_filename"]').val();

            if (filter_filename) {
                url += '&filter_filename=' + encodeURIComponent(filter_filename);
            }

            var filter_date = $('input[name="filter_date"]').val();

            if (filter_date) {
                url += '&filter_date=' + encodeURIComponent(filter_date);
            }

            location = url;
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name=\'filter_description\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=tool/database_backup/autocomplete&filter_description=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.description,
                                value: item.description
                            }
                        }));
                    }
                });
            }
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name=\'filter_filename\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=tool/database_backup/autocomplete&filter_filename=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.filename,
                                value: item.filename
                            }
                        }));
                    }
                });
            }
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('.single_delete').click(function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#single_delete_dialog').dialog({
                modal: true,
                height: 'auto',
                width: 'auto',
                resizable: false,
                draggable: false,
                center: true,
                buttons: {
                    '<?php echo $lang_dialog_yes; ?>': function() {
                        var input = $('<input>').attr('type', 'hidden').attr('name', 'single_delete').val(id);

                        $('form').append($(input));

                        $('form').submit();

                        $(this).dialog('close');
                    },
                    '<?php echo $lang_dialog_no; ?>': function() {
                        $(this).dialog('close');
                    }
                }
            });

            $('#single_delete_dialog').dialog('open');
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name="bulk_delete"]').click(function(e) {
            e.preventDefault();

            $('#bulk_delete_dialog').dialog({
                modal: true,
                height: 'auto',
                width: 'auto',
                resizable: false,
                draggable: false,
                center: true,
                buttons: {
                    '<?php echo $lang_dialog_yes; ?>': function() {
                        $('form').submit();

                        $(this).dialog('close');
                    },
                    '<?php echo $lang_dialog_no; ?>': function() {
                        $(this).dialog('close');
                    }
                }
            });

            $('#bulk_delete_dialog').dialog('open');
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>