<?php echo $header; ?>

<div class="report_access_page">

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
                <label><?php echo $lang_filter_username; ?></label>
                <input type="text" name="filter_username" value="<?php echo $filter_username; ?>">

                <label><?php echo $lang_filter_date; ?></label>
                <input type="text" class="datepicker" name="filter_date" value="<?php echo $filter_date; ?>" placeholder="YYYY-MM-DD">
            </div>

            <div class="column">
                <label><?php echo $lang_filter_ip_address; ?></label>
                <input type="text" name="filter_ip_address" value="<?php echo $filter_ip_address; ?>">
            </div>

            <div class="column">
                <label><?php echo $lang_filter_page; ?></label>
                <input type="text" name="filter_page" value="<?php echo $filter_page; ?>">

                <input type="button" id="filter" class="button" value="<?php echo $lang_button_filter; ?>" title="<?php echo $lang_button_filter; ?>">
            </div>
        </div>
    </div>

    <div class="table_container">
        <table class="table">
            <thead>
                <tr>
                    <th><a href="<?php echo $sort_username; ?>" <?php if ($sort == 'a.username') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_username; ?></a></th>
                    <th><a href="<?php echo $sort_ip_address; ?>" <?php if ($sort == 'a.ip_address') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_ip_address; ?></a></th>
                    <th><a href="<?php echo $sort_page; ?>" <?php if ($sort == 'a.page') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_page; ?></a></th>
                    <th><a href="<?php echo $sort_date; ?>" <?php if ($sort == 'a.date_added') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_date; ?></a></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($views) { ?>
                    <?php foreach ($views as $view) { ?>
                        <tr>
                            <td data-th="<?php echo $lang_column_username; ?>:"><?php echo $view['username']; ?></td>
                            <td data-th="<?php echo $lang_column_ip_address; ?>:"><?php echo $view['ip_address']; ?></td>
                            <td data-th="<?php echo $lang_column_page; ?>:"><?php echo $view['page']; ?></td>
                            <td data-th="<?php echo $lang_column_date; ?>:"><?php echo $view['date_added']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td class="no_results" colspan="4"><?php echo $lang_text_no_results; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="pagination_stats"><?php echo $pagination_stats; ?></div>

    <div class="pagination_links"><?php echo $pagination_links; ?></div>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('#filter').click(function() {
            var url = 'index.php?route=report/access';

            var filter_username = $('input[name="filter_username"]').val();

            if (filter_username) {
                url += '&filter_username=' + encodeURIComponent(filter_username);
            }

            var filter_ip_address = $('input[name="filter_ip_address"]').val();

            if (filter_ip_address) {
                url += '&filter_ip_address=' + encodeURIComponent(filter_ip_address);
            }

            var filter_page = $('input[name="filter_page"]').val();

            if (filter_page) {
                url += '&filter_page=' + encodeURIComponent(filter_page);
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
        $('input[name=\'filter_username\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=report/access/autocomplete&filter_username=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.username,
                                value: item.username
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
                    url: 'index.php?route=report/access/autocomplete&filter_ip_address=' + encodeURIComponent(request.term),
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
        $('input[name=\'filter_page\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=report/access/autocomplete&filter_page=' + encodeURIComponent(request.term),
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

</div>

<?php echo $footer; ?>