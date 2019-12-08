<?php echo $header; ?>

<div class="main_dashboard_page">

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

    <div class="left">
        <div class="block version_block">
            <div class="title"><span class="fa fa-wrench"></span> <?php echo $lang_title_version_check; ?></div>
            <div class="content">
                <?php if ($version_check['type'] == 'positive') { ?>
                    <span class="positive"><?php echo $version_check['text']; ?></span>
                <?php } ?>
                <?php if ($version_check['type'] == 'negative') { ?>
                    <span class="negative"><?php echo $version_check['text']; ?></span>

                    <?php if ($version_check['link']) { ?>
                        (<a href="<?php echo $version_check['link_href']; ?>"><?php echo $version_check['link_text']; ?></a>)
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

        <div class="block login_block">
            <div class="title"><span class="fa fa-lock"></span> <?php echo $lang_title_last_login; ?></div>
            <div class="content">
                <?php echo $lang_text_last_login; ?>
            </div>
        </div>

        <div class="block stats_block">
            <div class="title"><span class="fa fa-info"></span> <?php echo $lang_title_statistics; ?></div>
            <div class="content">
                <?php echo $lang_text_stats_action; ?><br>
                <?php echo $lang_text_stats_today; ?><br>
                <?php echo $lang_text_stats_total; ?>
            </div>
        </div>

        <div class="block tips_block dashboard_extra">
            <div class="title"><span class="fa fa-lightbulb-o"></span> <?php echo $lang_title_tip_of_the_day; ?></div>
            <div class="content">
                <?php echo $tip_of_the_day; ?>
            </div>
        </div>
    </div>

    <div class="right">
        <div class="block news_block">
            <div class="title"><span class="fa fa-bullhorn"></span> <?php echo $lang_title_news; ?></div>
            <div class="content">
                <?php echo $news; ?>
            </div>
        </div>

        <div class="block links_block">
            <div class="title"><span class="fa fa-link"></span> <?php echo $lang_title_quick_links; ?></div>
            <div class="content">
                <?php if ($quick_links) { ?>
                    <?php foreach ($quick_links as $key => $value) { ?>
                        <div class="quick_link"><?php echo $key + 1; ?>. <a href="index.php?route=<?php echo $value['page']; ?>"><?php echo $value['page']; ?></a></div>
                    <?php } ?>
                <?php } else { ?>
                    <?php echo $lang_text_no_links; ?>
                <?php } ?>
            </div>
        </div>

        <div class="block licence_block">
            <div class="title"><span class="fa fa-id-card"></span> <?php echo $lang_title_licence; ?></div>
            <div class="content">
                <?php if ($is_licence_valid) { ?>
                    <?php echo $licence; ?>
                <?php } else { ?>
                    <?php if ($licence_result == 'none') { ?>
                        <span class="negative"><?php echo $lang_text_no_licence; ?></span> (<a href="https://www.commentics.org/pricing" target="_blank"><?php echo $lang_text_purchase; ?></a>)
                    <?php } else if ($licence_result == 'unable') { ?>
                        <span class="negative"><?php echo $lang_text_unable; ?></span>
                    <?php } else if ($licence_result == 'invalid') { ?>
                        <span class="negative"><?php echo $lang_text_licence_invalid; ?></span> (<a href="https://www.commentics.org/pricing" target="_blank"><?php echo $lang_text_purchase; ?></a>)
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="clear"></div>

    <?php if ($sponsors) { ?>
        <div class="block sponsors_block">
            <div class="title"><span class="fa fa-thumbs-o-up"></span> <?php echo $lang_title_sponsors; ?></div>
            <div class="content">
                <ul class="sponsors">
                <?php foreach ($sponsors as $key => $sponsor) { ?>
                    <li class="sponsor"><a href="<?php echo $sponsor['href']; ?>" target="_blank" title="<?php echo $sponsor['name']; ?>"><img src="<?php echo $sponsor['image']; ?>" alt="<?php echo $sponsor['name']; ?>"></a></li>
                <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>

    <?php if ($show_chart) { ?>
        <div class="chart_block">
            <div class="title"><span class="fa fa-bar-chart"></span> <?php echo $lang_title_chart; ?></div>

            <canvas id="chart" class="chart"></canvas>

            <script>
            // <![CDATA[
            $(document).ready(function() {
                var ctx = $('#chart');

                var data = {
                    labels: [
                        "<?php echo $lang_january; ?>",
                        "<?php echo $lang_february; ?>",
                        "<?php echo $lang_march; ?>",
                        "<?php echo $lang_april; ?>",
                        "<?php echo $lang_may; ?>",
                        "<?php echo $lang_june; ?>",
                        "<?php echo $lang_july; ?>",
                        "<?php echo $lang_august; ?>",
                        "<?php echo $lang_september; ?>",
                        "<?php echo $lang_october; ?>",
                        "<?php echo $lang_november; ?>",
                        "<?php echo $lang_december; ?>"
                    ],
                    datasets: [
                        {
                            label: "<?php echo $lang_text_comments; ?>",
                            fill: true,
                            backgroundColor: "rgba(237,237,237,0.2)",
                            borderColor: "#A8A8A8",
                            borderWidth: 1,
                            data: [
                                <?php echo $chart_comments['jan']; ?>,
                                <?php echo $chart_comments['feb']; ?>,
                                <?php echo $chart_comments['mar']; ?>,
                                <?php echo $chart_comments['apr']; ?>,
                                <?php echo $chart_comments['may']; ?>,
                                <?php echo $chart_comments['jun']; ?>,
                                <?php echo $chart_comments['jul']; ?>,
                                <?php echo $chart_comments['aug']; ?>,
                                <?php echo $chart_comments['sep']; ?>,
                                <?php echo $chart_comments['oct']; ?>,
                                <?php echo $chart_comments['nov']; ?>,
                                <?php echo $chart_comments['dec']; ?>
                            ]
                        },
                        {
                            label: "<?php echo $lang_text_subscriptions; ?>",
                            fill: true,
                            backgroundColor: "rgba(237,237,237,0.2)",
                            borderColor: "#FF7F00",
                            borderWidth: 1,
                            data: [
                                <?php echo $chart_subscriptions['jan']; ?>,
                                <?php echo $chart_subscriptions['feb']; ?>,
                                <?php echo $chart_subscriptions['mar']; ?>,
                                <?php echo $chart_subscriptions['apr']; ?>,
                                <?php echo $chart_subscriptions['may']; ?>,
                                <?php echo $chart_subscriptions['jun']; ?>,
                                <?php echo $chart_subscriptions['jul']; ?>,
                                <?php echo $chart_subscriptions['aug']; ?>,
                                <?php echo $chart_subscriptions['sep']; ?>,
                                <?php echo $chart_subscriptions['oct']; ?>,
                                <?php echo $chart_subscriptions['nov']; ?>,
                                <?php echo $chart_subscriptions['dec']; ?>
                            ]
                        }
                    ]
                };

                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio : false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision: 0
                                }
                            }]
                        }
                    }
                });
            });
            // ]]>
            </script>
        </div>
    <?php } ?>

    <form action="index.php?route=main/dashboard" class="controls" method="post">
        <div class="title"><span class="fa fa-pencil"></span> <?php echo $lang_title_administrator_notes; ?></div>

        <textarea name="notes"><?php echo $notes; ?></textarea>
        <?php if ($error_notes) { ?>
            <span class="error"><?php echo $error_notes; ?></span>
        <?php } ?>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <p><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></p>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('div.warning a:last-child').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'index.php?route=main/dashboard/dismiss',
            })

            $('div.warning').fadeOut(2000);
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>