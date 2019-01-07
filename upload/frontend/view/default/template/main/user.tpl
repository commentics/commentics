<!DOCTYPE html>
<html>
<head>
    <title>{{ lang_title }}</title>
    <meta name="robots" content="noindex">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ stylesheet }}">
    @if custom
        <link rel="stylesheet" type="text/css" href="{{ custom }}">
    @endif
    <script src="{{ common }}"></script>
</head>
<body class="cmtx_user_body">
    <div id="cmtx_user_container" class="cmtx_user_container cmtx_clear">
        @if lang_heading
            <h1>{{ lang_heading }}</h1>
        @endif

        @if success
            <div class="cmtx_message cmtx_message_success">{{ success }}</div>
        @endif

        @if info
            <div class="cmtx_message cmtx_message_info">{{ info }}</div>
        @endif

        @if error
            <div class="cmtx_message cmtx_message_error">{{ error }}</div>
        @endif

        @if warning
            <div class="cmtx_message cmtx_message_warning">{{ warning }}</div>
        @endif

        @if user
            <form>
                <div class="cmtx_settings_container">
                    <div class="cmtx_area cmtx_notifications_area">
                        <div class="cmtx_area_heading cmtx_desktop">{{ lang_text_notifications_section }}</div>
                        <div class="cmtx_area_heading cmtx_mobile">{{ lang_text_notifications }}</div>

                        <div class="cmtx_area_body">
                            <div><input type="radio" id="everything" name="to_all" value="1" {{ everything_checked }}> <label for="everything">{{ lang_text_everything }}</label></div>
                            <div><input type="radio" id="custom" name="to_all" value="0" {{ custom_checked }}> <label for="custom">{{ lang_text_custom }}</label></div>
                        </div>

                        <div class="cmtx_area_body cmtx_notifications_area_custom">
                            <div class="cmtx_custom_text">{{ lang_text_custom_section }}</div>

                            <div><input type="checkbox" id="to_admin" name="to_admin" value="1" {{ to_admin_checked }}> <label for="to_admin">{{ lang_text_admin_comments }}</label></div>
                            <div><input type="checkbox" id="to_reply" name="to_reply" value="1" {{ to_reply_checked }}> <label for="to_reply">{{ lang_text_reply_comments }}</label></div>
                            <div><input type="checkbox" id="to_approve" name="to_approve" value="1" {{ to_approve_checked }}> <label for="to_approve">{{ lang_text_approved_comments }}</label></div>
                        </div>
                    </div>

                    <div class="cmtx_area cmtx_format_area">
                        <div class="cmtx_area_heading">{{ lang_text_format_section }}</div>

                        <div class="cmtx_area_body">
                            <div><input type="radio" id="html" name="format" value="html" {{ html_checked }}> <label for="html">{{ lang_text_html }}</label></div>
                            <div><input type="radio" id="text" name="format" value="text" {{ text_checked }}> <label for="text">{{ lang_text_text }}</label></div>
                        </div>
                    </div>
                </div>
            </form>

            <div id="subscriptions" class="cmtx_area cmtx_subscriptions_area">
                <div class="cmtx_area_heading">{{ lang_text_subscriptions_section }}</div>

                <div class="cmtx_area_body">
                    <table class="cmtx_table">
                        <thead>
                            <tr>
                                <th>{{ lang_column_number }}</th>
                                <th>{{ lang_column_page }}</th>
                                <th>{{ lang_column_date }}</th>
                                <th>{{ lang_column_action }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if subscriptions
                                @start count at 1

                                @foreach subscriptions as subscription
                                    <tr>
                                        <td>{{ count }}</td>
                                        <td><a href="{{ subscription.url }}" target="_blank">{{ subscription.reference }}</a></td>
                                        <td><time class="timeago" datetime="{{ subscription.date_added }}" title="{{ subscription.date_added_title }}"></time></td>
                                        <td><span class="cmtx_trash_icon" title="{{ lang_title_delete }}" data-sub-token="{{ subscription.token }}"></span></td>
                                    </tr>

                                    @increase count
                                @endforeach
                            @else
                                <tr>
                                    <td class="cmtx_no_results" colspan="4">{{ lang_text_no_results }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="cmtx_subscriptions_area_delete">
                    <div class="cmtx_area_heading">{{ lang_text_delete_section }}</div>

                    <div class="cmtx_area_body">
                        <a href="#" class="cmtx_delete_all" title="{{ lang_title_delete_all }}">{{ lang_link_delete }}</a>
                    </div>
                </div>
            </div>

            {# These settings are passed to common.js #}
            <div id="cmtx_js_settings_user" style="display:none" hidden>{{ cmtx_js_settings_user }}</div>
        @endif
    </div>
</body>
</html>