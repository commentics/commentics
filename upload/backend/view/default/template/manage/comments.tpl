<?php echo $header; ?>

<div class="manage_comments_page">

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
                <label><?php echo $lang_filter_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>">

                <label><?php echo $lang_filter_page; ?></label>
                <input type="text" name="filter_page" value="<?php echo $filter_page; ?>">

                <label><?php echo $lang_filter_flagged; ?></label>
                <select name="filter_flagged">
                    <option value=""><?php echo $lang_select_select; ?></option>
                    <option value="1" <?php if ($filter_flagged == '1') { echo 'selected'; } ?>><?php echo $lang_text_yes; ?></option>
                    <option value="0" <?php if ($filter_flagged == '0') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                </select>
            </div>

            <div class="column">
                <label><?php echo $lang_filter_comment; ?></label>
                <input type="text" name="filter_comment" value="<?php echo $filter_comment; ?>">

                <label><?php echo $lang_filter_approved; ?></label>
                <select name="filter_approved">
                    <option value=""><?php echo $lang_select_select; ?></option>
                    <option value="1" <?php if ($filter_approved == '1') { echo 'selected'; } ?>><?php echo $lang_text_yes; ?></option>
                    <option value="0" <?php if ($filter_approved == '0') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                </select>

                <label><?php echo $lang_filter_ip_address; ?></label>
                <input type="text" name="filter_ip_address" value="<?php echo $filter_ip_address; ?>">
            </div>

            <div class="column">
                <label><?php echo $lang_filter_rating; ?></label>
                <select name="filter_rating">
                    <option value=""><?php echo $lang_select_select; ?></option>
                    <option value="1" <?php if ($filter_rating == '1') { echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if ($filter_rating == '2') { echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if ($filter_rating == '3') { echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if ($filter_rating == '4') { echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if ($filter_rating == '5') { echo 'selected'; } ?>>5</option>
                </select>

                <label><?php echo $lang_filter_sent; ?></label>
                <select name="filter_sent">
                    <option value=""><?php echo $lang_select_select; ?></option>
                    <option value="1" <?php if ($filter_sent == '1') { echo 'selected'; } ?>><?php echo $lang_text_yes; ?></option>
                    <option value="0" <?php if ($filter_sent == '0') { echo 'selected'; } ?>><?php echo $lang_text_no; ?></option>
                </select>

                <label><?php echo $lang_filter_date; ?></label>
                <input type="text" class="datepicker" name="filter_date" value="<?php echo $filter_date; ?>" placeholder="YYYY-MM-DD">

                <input type="button" id="filter" class="button" value="<?php echo $lang_button_filter; ?>" title="<?php echo $lang_button_filter; ?>">
            </div>
        </div>
    </div>

    <form action="index.php?route=manage/comments" class="controls" method="post">
        <div class="table_container">
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th><a href="<?php echo $sort_name; ?>" <?php if ($sort == 'u.name') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_name; ?></a></th>
                        <th><a href="<?php echo $sort_comment; ?>" <?php if ($sort == 'c.comment') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_comment; ?></a></th>
                        <th><a href="<?php echo $sort_rating; ?>" <?php if ($sort == 'c.rating') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_rating; ?></a></th>
                        <th><a href="<?php echo $sort_page; ?>" <?php if ($sort == 'p.reference') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_page; ?></a></th>
                        <th><a href="<?php echo $sort_approved; ?>" <?php if ($sort == 'c.is_approved') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_approved; ?></a></th>
                        <th><a href="<?php echo $sort_sent; ?>" <?php if ($sort == 'c.is_sent') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_sent; ?></a></th>
                        <th><a href="<?php echo $sort_reports; ?>" <?php if ($sort == 'c.reports') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_reports; ?></a></th>
                        <th><a href="<?php echo $sort_flagged; ?>" <?php if ($sort == 'c.flagged') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_flagged; ?></a></th>
                        <th><a href="<?php echo $sort_ip_address; ?>" <?php if ($sort == 'c.ip_address') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_ip_address; ?></a></th>
                        <th><a href="<?php echo $sort_date; ?>" <?php if ($sort == 'c.date_added') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_date; ?></a></th>
                        <th><?php echo $lang_column_action; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($comments) { ?>
                        <?php foreach ($comments as $comment) { ?>
                            <tr>
                                <td class="selector"><input type="checkbox" name="bulk[]" value="<?php echo $comment['id']; ?>"></td>
                                <td data-th="<?php echo $lang_column_name; ?>:"><a href="<?php echo $comment['name_url']; ?>"><?php echo $comment['name']; ?></a></td>
                                <td data-th="<?php echo $lang_column_comment; ?>:"><?php echo $comment['comment']; ?></td>
                                <td data-th="<?php echo $lang_column_rating; ?>:">
                                    <?php if ($comment['rating']) { ?>
                                        <?php for ($i = 0; $i < 5; $i++) { ?>
                                            <?php if ($i < $comment['rating']) { ?>
                                                <span class="star star_full"></span>
                                            <?php } else { ?>
                                                <span class="star star_empty"></span>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php echo $lang_text_no_rating; ?>
                                    <?php } ?>
                                </td>
                                <td data-th="<?php echo $lang_column_page; ?>:"><a href="<?php echo $comment['page_url']; ?>"><?php echo $comment['page']; ?></a></td>
                                <td data-th="<?php echo $lang_column_approved; ?>:"><?php echo $comment['approved']; ?></td>
                                <td data-th="<?php echo $lang_column_sent; ?>:"><?php echo $comment['sent']; ?></td>
                                <td data-th="<?php echo $lang_column_reports; ?>:"><?php echo $comment['reports']; ?></td>
                                <td data-th="<?php echo $lang_column_flagged; ?>:"><?php echo $comment['flagged']; ?></td>
                                <td data-th="<?php echo $lang_column_ip_address; ?>:"><?php echo $comment['ip_address']; ?></td>
                                <td data-th="<?php echo $lang_column_date; ?>:"><?php echo $comment['date_added']; ?></td>
                                <td class="actions">
                                    <a href="<?php echo $comment['action_view']; ?>" target="_blank"><img src="<?php echo $button_view; ?>" class="button_view" title="<?php echo $lang_button_view; ?>"></a>
                                    <a data-id="<?php echo $comment['id']; ?>" class="single_approve"><img src="<?php echo $button_approve; ?>" class="button_approve" title="<?php echo $lang_button_approve; ?>"></a>
                                    <a data-id="<?php echo $comment['id']; ?>" class="single_send"><img src="<?php echo $button_send; ?>" class="button_send" title="<?php echo $lang_button_send; ?>"></a>
                                    <a href="<?php echo $comment['action_edit']; ?>"><img src="<?php echo $button_edit; ?>" class="button_edit" title="<?php echo $lang_button_edit; ?>"></a>
                                    <a data-id="<?php echo $comment['id']; ?>" class="single_delete"><img src="<?php echo $button_delete; ?>" class="button_delete" title="<?php echo $lang_button_delete; ?>"></a>
                                    <a href="<?php echo $comment['action_spam']; ?>"><img src="<?php echo $button_spam; ?>" class="button_spam" title="<?php echo $lang_button_spam; ?>"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td class="no_results" colspan="12"><?php echo $lang_text_no_results; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons">
            <input type="submit" name="bulk_approve" class="button" value="<?php echo $lang_button_approve; ?>" title="<?php echo $lang_button_approve; ?>">

            <input type="submit" name="bulk_send" class="button" value="<?php echo $lang_button_send; ?>" title="<?php echo $lang_button_send; ?>">

            <input type="submit" name="bulk_delete" class="button" value="<?php echo $lang_button_delete; ?>" title="<?php echo $lang_button_delete; ?>">
        </div>
    </form>

    <div class="pagination_stats"><?php echo $pagination_stats; ?></div>

    <div class="pagination_links"><?php echo $pagination_links; ?></div>

    <div id="single_delete_dialog" title="<?php echo $lang_dialog_single_delete_title; ?>" style="display:none">
        <span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_single_delete_content; ?>
    </div>

    <div id="bulk_delete_dialog" title="<?php echo $lang_dialog_bulk_delete_title; ?>" style="display:none">
        <span class="ui-icon ui-icon-alert"></span> <?php echo $lang_dialog_bulk_delete_content; ?>
    </div>

    <style>
    .ui-dialog .ui-icon-alert {
        margin-bottom: 10px;
    }
    </style>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('div.info a:last-child').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'index.php?route=manage/comments/dismiss',
            })

            $('div.info').fadeOut(2000);
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('#filter').click(function() {
            var url = 'index.php?route=manage/comments';

            var filter_name = $('input[name="filter_name"]').val();

            if (filter_name) {
                url += '&filter_name=' + encodeURIComponent(filter_name);
            }

            var filter_comment = $('input[name="filter_comment"]').val();

            if (filter_comment) {
                url += '&filter_comment=' + encodeURIComponent(filter_comment);
            }

            var filter_rating = $('select[name="filter_rating"]').val();

            if (filter_rating) {
                url += '&filter_rating=' + encodeURIComponent(filter_rating);
            }

            var filter_page = $('input[name="filter_page"]').val();

            if (filter_page) {
                url += '&filter_page=' + encodeURIComponent(filter_page);
            }

            var filter_approved = $('select[name="filter_approved"]').val();

            if (filter_approved) {
                url += '&filter_approved=' + encodeURIComponent(filter_approved);
            }

            var filter_sent = $('select[name="filter_sent"]').val();

            if (filter_sent) {
                url += '&filter_sent=' + encodeURIComponent(filter_sent);
            }

            var filter_flagged = $('select[name="filter_flagged"]').val();

            if (filter_flagged) {
                url += '&filter_flagged=' + encodeURIComponent(filter_flagged);
            }

            var filter_ip_address = $('input[name="filter_ip_address"]').val();

            if (filter_ip_address) {
                url += '&filter_ip_address=' + encodeURIComponent(filter_ip_address);
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
        $('input[name=\'filter_name\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=manage/comments/autocomplete&filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.name,
                                value: item.name
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
        $('input[name=\'filter_comment\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=manage/comments/autocomplete&filter_comment=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.comment,
                                value: item.comment
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
        $('input[name=\'filter_page\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=manage/comments/autocomplete&filter_page=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.page,
                                value: item.page
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
        $('input[name=\'filter_ip_address\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=manage/comments/autocomplete&filter_ip_address=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.ip_address,
                                value: item.ip_address
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
        $('.single_approve').click(function(e) {
            var id = $(this).data('id');

            var input = $('<input>').attr('type', 'hidden').attr('name', 'single_approve').val(id);

            $('form').append($(input));

            $('form').submit();
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('.single_send').click(function(e) {
            var id = $(this).data('id');

            var input = $('<input>').attr('type', 'hidden').attr('name', 'single_send').val(id);

            $('form').append($(input));

            $('form').submit();
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
        $('input[name="bulk_approve"]').click(function(e) {
            var input = $('<input>').attr('type', 'hidden').attr('name', 'bulk_action').val('approve');

            $('form').append($(input));

            $('form').submit();
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name="bulk_send"]').click(function(e) {
            var input = $('<input>').attr('type', 'hidden').attr('name', 'bulk_action').val('send');

            $('form').append($(input));

            $('form').submit();
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
                        var input = $('<input>').attr('type', 'hidden').attr('name', 'bulk_action').val('delete');

                        $('form').append($(input));

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