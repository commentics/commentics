<?php echo $header; ?>

<div class="report_viewers_page">

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

    <p><input type="button" id="refresh" class="button" value="<?php echo $lang_button_refresh; ?>" title="<?php echo $lang_button_refresh; ?>"></p>

    <div class="filter">
        <div class="row">
            <div class="column">
                <label><?php echo $lang_filter_type; ?></label>
                <input type="text" name="filter_type" value="<?php echo $filter_type; ?>">

                <label><?php echo $lang_filter_page_url; ?></label>
                <input type="text" name="filter_page_url" value="<?php echo $filter_page_url; ?>">
            </div>

            <div class="column">
                <label><?php echo $lang_filter_ip_address; ?></label>
                <input type="text" name="filter_ip_address" value="<?php echo $filter_ip_address; ?>">
            </div>

            <div class="column">
                <label><?php echo $lang_filter_page_reference; ?></label>
                <input type="text" name="filter_page_reference" value="<?php echo $filter_page_reference; ?>">

                <input type="button" id="filter" class="button" value="<?php echo $lang_button_filter; ?>" title="<?php echo $lang_button_filter; ?>">
            </div>
        </div>
    </div>

    <div class="table_container">
        <table class="table">
            <thead>
                <tr>
                    <th><a href="<?php echo $sort_viewer; ?>" <?php if ($sort == 'v.viewer') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_viewer; ?></a></th>
                    <th><a href="<?php echo $sort_type; ?>" <?php if ($sort == 'v.type') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_type; ?></a></th>
                    <th><a href="<?php echo $sort_ip_address; ?>" <?php if ($sort == 'v.ip_address') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_ip_address; ?></a></th>
                    <th><a href="<?php echo $sort_page_reference; ?>" <?php if ($sort == 'v.page_reference') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_page_reference; ?></a></th>
                    <th><a href="<?php echo $sort_page_url; ?>" <?php if ($sort == 'v.page_url') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_page_url; ?></a></th>
                    <th><a href="<?php echo $sort_time; ?>" <?php if ($sort == 'v.time_added') { echo 'class="' . $order . '"'; } ?>><?php echo $lang_column_last_activity; ?></a></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($viewers) { ?>
                    <?php foreach ($viewers as $viewer) { ?>
                        <tr>
                            <td data-th="<?php echo $lang_column_viewer; ?>:"><img src="<?php echo $viewer['viewer']; ?>" class="viewer" title="<?php echo $viewer['type']; ?>"></td>
                            <td data-th="<?php echo $lang_column_type; ?>:"><?php echo $viewer['type']; ?></td>
                            <td data-th="<?php echo $lang_column_ip_address; ?>:"><?php echo $viewer['ip_address']; ?></td>
                            <td data-th="<?php echo $lang_column_page_reference; ?>:"><?php echo $viewer['page_reference']; ?></td>
                            <td data-th="<?php echo $lang_column_page_url; ?>:"><a href="<?php echo $viewer['page_url']; ?>" target="_blank"><?php echo $viewer['page_url']; ?></a></td>
                            <td data-th="<?php echo $lang_column_last_activity; ?>:"><?php echo $viewer['time']; ?></td>
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

    <div class="pagination_stats"><?php echo $pagination_stats; ?></div>

    <div class="pagination_links"><?php echo $pagination_links; ?></div>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('#refresh').click(function() {
            window.location.reload();
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('#filter').click(function() {
            var url = 'index.php?route=report/viewers';

            var filter_type = $('input[name="filter_type"]').val();

            if (filter_type) {
                url += '&filter_type=' + encodeURIComponent(filter_type);
            }

            var filter_ip_address = $('input[name="filter_ip_address"]').val();

            if (filter_ip_address) {
                url += '&filter_ip_address=' + encodeURIComponent(filter_ip_address);
            }

            var filter_page_reference = $('input[name="filter_page_reference"]').val();

            if (filter_page_reference) {
                url += '&filter_page_reference=' + encodeURIComponent(filter_page_reference);
            }

            var filter_page_url = $('input[name="filter_page_url"]').val();

            if (filter_page_url) {
                url += '&filter_page_url=' + encodeURIComponent(filter_page_url);
            }

            location = url;
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('input[name=\'filter_type\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=report/viewers/autocomplete&filter_type=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.type,
                                value: item.type
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
                    url: 'index.php?route=report/viewers/autocomplete&filter_ip_address=' + encodeURIComponent(request.term),
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
        $('input[name=\'filter_page_reference\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=report/viewers/autocomplete&filter_page_reference=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.page_reference,
                                value: item.page_reference
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
        $('input[name=\'filter_page_url\']').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: 'index.php?route=report/viewers/autocomplete&filter_page_url=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.page_url,
                                value: item.page_url
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