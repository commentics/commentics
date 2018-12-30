<?php
namespace Commentics;

class MainUserController extends Controller
{
    public function index()
    {
        $this->loadLanguage('main/user');

        $this->loadModel('main/user');

        $this->data['stylesheet'] = $this->loadStylesheet('stylesheet.min.css');

        $this->data['custom'] = $this->loadCustomCss();

        $this->data['common'] = $this->loadJavascript('common-jq.min.js');

        $this->data['commentics_url'] = $this->url->getCommenticsUrl();

        $this->data['lang_heading'] = '';

        $this->data['user'] = '';

        if (isset($this->request->get['u-t'])) {
            $user = $this->model_main_user->getUser($this->request->get['u-t']);

            if ($user) {
                $this->data['user'] = $user;

                $this->data['lang_title'] .= ': ' . $user['name'];

                $this->data['lang_heading'] = $user['name'];

                if ($user['to_all']) {
                    $this->data['everything_checked'] = 'checked';
                    $this->data['custom_checked'] = '';
                } else {
                    $this->data['everything_checked'] = '';
                    $this->data['custom_checked'] = 'checked';
                }

                if ($user['format'] == 'html') {
                    $this->data['html_checked'] = 'checked';
                    $this->data['text_checked'] = '';
                } else {
                    $this->data['html_checked'] = '';
                    $this->data['text_checked'] = 'checked';
                }

                if ($user['to_admin']) {
                    $this->data['to_admin_checked'] = 'checked';
                } else {
                    $this->data['to_admin_checked'] = '';
                }

                if ($user['to_reply']) {
                    $this->data['to_reply_checked'] = 'checked';
                } else {
                    $this->data['to_reply_checked'] = '';
                }

                if ($user['to_approve']) {
                    $this->data['to_approve_checked'] = 'checked';
                } else {
                    $this->data['to_approve_checked'] = '';
                }

                if (isset($this->request->get['s-t'])) {
                    $subscription = $this->model_main_user->getSubscription($this->request->get['u-t'], $this->request->get['s-t']);

                    if ($subscription) {
                        if (isset($this->request->get['action']) && $this->request->get['action'] == 'c-s') {
                            if ($subscription['is_confirmed']) {
                                $this->data['error'] = $this->data['lang_message_error_confirmed'];
                            } else {
                                $this->model_main_user->confirmSubscription($this->request->get['s-t']);

                                $this->data['success'] = $this->data['lang_message_success'];
                            }
                        }
                    } else {
                        $this->data['error'] = $this->data['lang_message_error_no_sub'];
                    }
                }

                $subscriptions = $this->model_main_user->getSubscriptions($this->request->get['u-t']);

                $this->data['lang_text_subscriptions_section'] = sprintf($this->data['lang_text_subscriptions_section'], '<span class="count">' . count($subscriptions) . '</span>');

                foreach ($subscriptions as &$subscription) {
                    $subscription['date_added'] = $this->variable->formatDate($subscription['date_added'], 'c', $this->data);

                    $subscription['date_added_title'] = $this->variable->formatDate($subscription['date_added'], $this->data['lang_date_time_format'], $this->data);
                }

                $this->data['subscriptions'] = $subscriptions;

                /* These are passed to common.js via the template */
                $this->data['cmtx_js_settings_user'] = array(
                    'commentics_url'       => $this->url->getCommenticsUrl(),
                    'token'                => $user['token'],
                    'to_all'               => (bool) $user['to_all'],
                    'lang_text_saving'     => $this->data['lang_text_saving'],
                    'lang_text_no_results' => $this->data['lang_text_no_results'],
                    'timeago_suffixAgo'    => $this->data['lang_text_timeago_ago'],
                    'timeago_inPast'       => $this->data['lang_text_timeago_second'],
                    'timeago_seconds'      => $this->data['lang_text_timeago_seconds'],
                    'timeago_minute'       => $this->data['lang_text_timeago_minute'],
                    'timeago_minutes'      => $this->data['lang_text_timeago_minutes'],
                    'timeago_hour'         => $this->data['lang_text_timeago_hour'],
                    'timeago_hours'        => $this->data['lang_text_timeago_hours'],
                    'timeago_day'          => $this->data['lang_text_timeago_day'],
                    'timeago_days'         => $this->data['lang_text_timeago_days'],
                    'timeago_month'        => $this->data['lang_text_timeago_month'],
                    'timeago_months'       => $this->data['lang_text_timeago_months'],
                    'timeago_year'         => $this->data['lang_text_timeago_year'],
                    'timeago_years'        => $this->data['lang_text_timeago_years']
                );

                $this->data['cmtx_js_settings_user'] = json_encode($this->data['cmtx_js_settings_user']);
            } else {
                $this->data['error'] = $this->data['lang_message_error_no_user'];

                // TODO: Limit wrong attempts
            }
        } else {
            $this->data['error'] = $this->data['lang_message_error_invalid'];
        }

        $this->loadView('main/user');
    }

    public function save()
    {
        if ($this->request->isAjax()) {
            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (isset($this->request->post['u-t'])) {
                $this->loadLanguage('main/user');

                $this->loadModel('main/user');

                $user_token = $this->request->post['u-t'];

                $ip_address = $this->user->getIpAddress();

                if ($this->setting->get('maintenance_mode')) { // check if in maintenance mode
                    $json['error'] = $this->data['lang_error_maintenance'];
                } else if (!$this->model_main_user->getUser($user_token)) { // check if user exists
                    $json['error'] = $this->data['lang_error_no_user'];
                } else if ($this->user->isBanned($ip_address)) { // check if user is banned
                    $json['error'] = $this->data['lang_error_banned'];
                }

                if (!$json) {
                    $this->model_main_user->save($this->request->post);

                    $json['success'] = $this->data['lang_text_saved'];
                }
            }

            echo json_encode($json);
        }
    }

    public function deleteSubscription()
    {
        if ($this->request->isAjax()) {
            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (isset($this->request->post['u-t']) && isset($this->request->post['s-t'])) {
                $this->loadLanguage('main/user');

                $this->loadModel('main/user');

                $user_token = $this->request->post['u-t'];

                $subscription_token = $this->request->post['s-t'];

                $ip_address = $this->user->getIpAddress();

                if ($this->setting->get('maintenance_mode')) { // check if in maintenance mode
                    $json['error'] = $this->data['lang_error_maintenance'];
                } else if (!$this->model_main_user->getUser($user_token)) { // check if user exists
                    $json['error'] = $this->data['lang_error_no_user'];
                } else if (!$this->model_main_user->getSubscription($user_token, $subscription_token)) { // check if subscription exists
                    $json['error'] = $this->data['lang_error_no_subscription'];
                } else if ($this->user->isBanned($ip_address)) { // check if user is banned
                    $json['error'] = $this->data['lang_error_banned'];
                }

                if (!$json) {
                    $this->model_main_user->deleteSubscription($subscription_token);

                    $json['count'] = count($this->model_main_user->getSubscriptions($user_token));

                    $json['success'] = true;
                }
            }

            echo json_encode($json);
        }
    }

    public function deleteAllSubscriptions()
    {
        if ($this->request->isAjax()) {
            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (isset($this->request->post['u-t'])) {
                $this->loadLanguage('main/user');

                $this->loadModel('main/user');

                $user = $this->model_main_user->getUser($this->request->post['u-t']);

                $ip_address = $this->user->getIpAddress();

                if ($this->setting->get('maintenance_mode')) { // check if in maintenance mode
                    $json['error'] = $this->data['lang_error_maintenance'];
                } else if (!$user) { // check if user exists
                    $json['error'] = $this->data['lang_error_no_user'];
                } else if ($this->user->isBanned($ip_address)) { // check if user is banned
                    $json['error'] = $this->data['lang_error_banned'];
                }

                if (!$json) {
                    $this->model_main_user->deleteAllSubscriptions($user['id']);

                    $json['success'] = true;
                }
            }

            echo json_encode($json);
        }
    }
}
