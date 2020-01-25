<?php
namespace Commentics;

class PartNotifyController extends Controller
{
    public function index()
    {
        $this->loadLanguage('part/notify');

        /* These are passed to common.js via the template */
        $this->data['cmtx_js_settings_notify'] = array(
            'lang_button_processing'   => $this->data['lang_button_processing'],
            'lang_button_notify'       => $this->data['lang_button_notify'],
            'lang_heading_notify'      => $this->data['lang_heading_notify'],
            'lang_text_notify_info'    => $this->data['lang_text_notify_info'],
            'lang_title_cancel_notify' => $this->data['lang_title_cancel_notify'],
            'lang_link_cancel'         => $this->data['lang_link_cancel']
        );

        $this->data['cmtx_js_settings_notify'] = json_encode($this->data['cmtx_js_settings_notify'], JSON_HEX_TAG);

        return $this->data;
    }

    public function notify()
    {
        if ($this->request->isAjax()) { // TODO: Share following code with submit() from /controller/main/form.php
            $this->loadLanguage('main/form');

            $this->loadLanguage('part/notify');

            $this->loadModel('main/form');

            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (!$this->setting->get('show_notify')) { // check if feature enabled
                $json['result']['error'] = $this->data['lang_error_disabled'];
            } else {
                /* Is this an administrator? */
                $is_admin = $this->user->isAdmin();

                if ($this->setting->get('maintenance_mode') && !$is_admin) {
                    $json['result']['error'] = $this->setting->get('maintenance_message');
                } else {
                    if ($this->setting->get('enabled_form')) {
                        $page_id = $this->page->getId();

                        if ($page_id) {
                            $page = $this->page->getPage($page_id);

                            if ($page['is_form_enabled']) {
                                $ip_address = $this->user->getIpAddress();

                                if ($this->user->isBanned($ip_address)) {
                                    $json['result']['error'] = $this->data['lang_error_banned'];
                                } else {
                                    /* Check referrer */
                                    if ($this->setting->get('check_referrer')) {
                                        if (isset($this->request->server['HTTP_REFERER'])) {
                                            $referrer = $this->url->decode($this->request->server['HTTP_REFERER']);

                                            $domain = $this->url->decode($this->setting->get('site_domain'));

                                            if (!$this->variable->stristr($referrer, $domain)) { // if referrer does not contain domain
                                                $json['result']['error'] = $this->data['lang_error_incorrect_referrer'];
                                            }
                                        } else {
                                            $json['result']['error'] = $this->data['lang_error_no_referrer'];
                                        }
                                    }

                                    /* Check honeypot */
                                    if ($this->setting->get('check_honeypot') && (!isset($this->request->post['cmtx_honeypot']) || $this->request->post['cmtx_honeypot'])) {
                                        $json['result']['error'] = $this->data['lang_error_honeypot'];
                                    }

                                    /* Check time */
                                    if ($this->setting->get('check_time') && (!isset($this->request->post['cmtx_time']) || (time() - intval($this->request->post['cmtx_time'])) < 5)) {
                                        $json['result']['error'] = $this->data['lang_error_time'];
                                    }

                                    /* Name */
                                    if (isset($this->request->post['cmtx_name']) && $this->request->post['cmtx_name'] != '') {
                                        $name = $this->security->decode($this->request->post['cmtx_name']);

                                        if (!$this->model_main_form->isNameValid($name)) {
                                            $json['error']['name'] = $this->data['lang_error_name_invalid'];
                                        }

                                        if (!$this->model_main_form->startsWithLetter($name)) {
                                            $json['error']['name'] = $this->data['lang_error_name_start'];
                                        }

                                        if ($this->validation->length($name) < 1 || $this->validation->length($name) > $this->setting->get('maximum_name')) {
                                            $json['error']['name'] = sprintf($this->data['lang_error_length'], 1, $this->setting->get('maximum_name'));
                                        }

                                        if ($this->setting->get('one_name_enabled') && !$this->model_main_form->isOneWord($name)) {
                                            $json['error']['name'] = $this->data['lang_error_name_one_word'];
                                        }

                                        if ($this->setting->get('fix_name_enabled')) {
                                            $this->request->post['cmtx_name'] = $this->variable->fixCase($this->request->post['cmtx_name']);
                                        }

                                        if ($this->setting->get('detect_link_in_name_enabled') && $this->model_main_form->hasLink($name)) {
                                            if ($this->setting->get('link_in_name_action') == 'error') {
                                                $json['error']['name'] = $this->data['lang_error_name_has_link'];
                                            } else if ($this->setting->get('link_in_name_action') == 'approve') {
                                                $approve .= $this->data['lang_error_name_has_link'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_name_has_link']);
                                            }
                                        }

                                        if ($this->setting->get('reserved_names_enabled') && !$is_admin && $this->model_main_form->hasWord($name, 'reserved_names')) {
                                            if ($this->setting->get('reserved_names_action') == 'error') {
                                                $json['error']['name'] = $this->data['lang_error_name_reserved'];
                                            } else if ($this->setting->get('reserved_names_action') == 'approve') {
                                                $approve .= $this->data['lang_error_name_reserved'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_name_reserved']);
                                            }
                                        }

                                        if ($this->setting->get('dummy_names_enabled') && $this->model_main_form->hasWord($name, 'dummy_names')) {
                                            if ($this->setting->get('dummy_names_action') == 'error') {
                                                $json['error']['name'] = $this->data['lang_error_name_dummy'];
                                            } else if ($this->setting->get('dummy_names_action') == 'approve') {
                                                $approve .= $this->data['lang_error_name_dummy'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_name_dummy']);
                                            }
                                        }

                                        if ($this->setting->get('banned_names_enabled') && $this->model_main_form->hasWord($name, 'banned_names')) {
                                            if ($this->setting->get('banned_names_action') == 'error') {
                                                $json['error']['name'] = $this->data['lang_error_name_banned'];
                                            } else if ($this->setting->get('banned_names_action') == 'approve') {
                                                $approve .= $this->data['lang_error_name_banned'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_name_banned']);
                                            }
                                        }
                                    } else {
                                        $json['error']['name'] = $this->data['lang_error_name_empty'];
                                    }

                                    /* Email */
                                    if (isset($this->request->post['cmtx_email']) && $this->request->post['cmtx_email'] != '') {
                                        $email = $this->security->decode($this->request->post['cmtx_email']);

                                        if (!$this->validation->isEmail($email)) {
                                            $json['error']['email'] = $this->data['lang_error_email_invalid'];
                                        }

                                        if ($this->validation->length($email) < 1 || $this->validation->length($email) > $this->setting->get('maximum_email')) {
                                            $json['error']['email'] = sprintf($this->data['lang_error_length'], 1, $this->setting->get('maximum_email'));
                                        }

                                        if ($this->security->isInjected($email)) {
                                            $json['result']['error'] = $this->data['lang_error_ban'];

                                            $this->user->ban($ip_address, $this->data['lang_error_email_injected']);
                                        }

                                        if ($this->setting->get('reserved_emails_enabled') && !$is_admin && $this->model_main_form->hasWord($email, 'reserved_emails', false)) {
                                            if ($this->setting->get('reserved_emails_action') == 'error') {
                                                $json['error']['email'] = $this->data['lang_error_email_reserved'];
                                            } else if ($this->setting->get('reserved_emails_action') == 'approve') {
                                                $approve .= $this->data['lang_error_email_reserved'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_email_reserved']);
                                            }
                                        }

                                        if ($this->setting->get('dummy_emails_enabled') && $this->model_main_form->hasWord($email, 'dummy_emails', false)) {
                                            if ($this->setting->get('dummy_emails_action') == 'error') {
                                                $json['error']['email'] = $this->data['lang_error_email_dummy'];
                                            } else if ($this->setting->get('dummy_emails_action') == 'approve') {
                                                $approve .= $this->data['lang_error_email_dummy'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_email_dummy']);
                                            }
                                        }

                                        if ($this->setting->get('banned_emails_enabled') && $this->model_main_form->hasWord($email, 'banned_emails', false)) {
                                            if ($this->setting->get('banned_emails_action') == 'error') {
                                                $json['error']['email'] = $this->data['lang_error_email_banned'];
                                            } else if ($this->setting->get('banned_emails_action') == 'approve') {
                                                $approve .= $this->data['lang_error_email_banned'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_email_banned']);
                                            }
                                        }
                                    } else {
                                        $json['error']['email'] = $this->data['lang_error_email_empty'];
                                    }

                                    /* User */
                                    if (isset($this->request->post['cmtx_name']) && $this->request->post['cmtx_name'] != '' && isset($this->request->post['cmtx_email']) && $this->request->post['cmtx_email'] != '') {
                                        $user = $this->user->getUserByNameAndEmail($this->request->post['cmtx_name'], $this->request->post['cmtx_email']);

                                        if (!$user) {
                                            if ($this->user->userExistsByEmail($this->request->post['cmtx_email'])) {
                                                $json['error']['email'] = $this->data['lang_error_email_partial'];
                                            }

                                            if ($this->setting->get('unique_name_enabled')) {
                                                if ($this->user->userExistsByName($this->request->post['cmtx_name'])) {
                                                    $json['error']['name'] = $this->data['lang_error_name_partial'];
                                                }
                                            }
                                        }
                                    }

                                    /* Subscription */
                                    if (isset($user) && $user) { // if the user exists
                                        /* Check if user is already subscribed to this page */
                                        if ($this->model_main_form->subscriptionExists($user['id'], $page_id)) {
                                            $json['result']['error'] = $this->data['lang_error_subscribed'];
                                        }

                                        /* Check if user has a pending subscription to any page */
                                        if ($this->model_main_form->userHasSubscriptionAttempt($user['id'])) {
                                            $json['result']['error'] = $this->data['lang_error_pending'];
                                        }
                                    }

                                    /* Check if IP address has a pending subscription to any page */
                                    if ($this->model_main_form->ipHasSubscriptionAttempt($ip_address)) {
                                        $json['result']['error'] = $this->data['lang_error_pending'];
                                    }

                                    /* Question */
                                    if ($this->setting->get('enabled_question')) {
                                        if (isset($this->request->post['cmtx_answer']) && $this->request->post['cmtx_answer'] != '') {
                                            $answer = $this->security->decode($this->request->post['cmtx_answer']);

                                            if (isset($this->session->data['cmtx_question_id_' . $this->page->getId()])) {
                                                $question_id = $this->session->data['cmtx_question_id_' . $this->page->getId()];

                                                if (!$this->model_main_form->isAnswerValid($question_id, $answer)) {
                                                    $json['error']['answer'] = $this->data['lang_error_answer_invalid'];
                                                }
                                            } else {
                                                /* The session may have expired */
                                                $json['error']['answer'] = $this->data['lang_error_question_empty'];
                                            }

                                            /* Generate a new question to answer */
                                            if (isset($json['error']['answer'])) {
                                                $question = $this->model_main_form->getQuestion();

                                                if ($question) {
                                                    $this->session->data['cmtx_question_id_' . $this->page->getId()] = $question['id'];

                                                    $json['question'] = $question['question'];
                                                }
                                            }
                                        } else {
                                            $json['error']['answer'] = $this->data['lang_error_answer_empty'];
                                        }
                                    }

                                    /* ReCaptcha */
                                    if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'recaptcha' && (bool) ini_get('allow_url_fopen') && !isset($this->session->data['cmtx_captcha_complete_' . $this->page->getId()])) {
                                        if (isset($this->request->post['g-recaptcha-response'])) {
                                            $captcha = $this->request->post['g-recaptcha-response'];

                                            if ($captcha) {
                                                $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->setting->get('recaptcha_private_key') . '&response=' . $captcha . '&remoteip=' . str_replace(' ', '%20', $ip_address));

                                                $response = json_decode($response);

                                                if ($response->success === false) {
                                                    $json['error']['recaptcha'] = $this->data['lang_error_incorrect_recaptcha'];
                                                } else {
                                                    $this->session->data['cmtx_captcha_complete_' . $this->page->getId()] = true;
                                                }
                                            } else {
                                                $json['error']['recaptcha'] = $this->data['lang_error_no_recaptcha'];
                                            }
                                        } else {
                                            $json['error']['recaptcha'] = $this->data['lang_error_no_recaptcha'];
                                        }
                                    }

                                    /* Securimage */
                                    if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'securimage' && extension_loaded('gd') && function_exists('imagettftext') && is_callable('imagettftext') && !isset($this->session->data['cmtx_captcha_complete_' . $this->page->getId()])) {
                                        if (isset($this->request->post['cmtx_securimage']) && $this->request->post['cmtx_securimage'] != '') {
                                            if (!class_exists('Securimage')) {
                                                require_once CMTX_DIR_3RDPARTY . 'securimage/securimage.php';
                                            }

                                            $securimage = new \Commentics\Securimage();

                                            $securimage->setNamespace('cmtx_' . $this->page->getId());

                                            if ($securimage->check($this->request->post['cmtx_securimage']) == false) {
                                                $json['error']['securimage'] = $this->data['lang_error_incorrect_securimage'];
                                            } else {
                                                $this->session->data['cmtx_captcha_complete_' . $this->page->getId()] = true;
                                            }
                                        } else {
                                            $json['error']['securimage'] = $this->data['lang_error_no_securimage'];
                                        }
                                    }

                                    /* Captcha */
                                    if (isset($this->session->data['cmtx_captcha_complete_' . $this->page->getId()])) {
                                        $json['captcha_complete'] = true;
                                    }
                                }
                            } else {
                                $json['result']['error'] = $this->data['lang_error_form_disabled'];
                            }
                        } else {
                            $json['result']['error'] = $this->data['lang_error_page_invalid'];
                        }
                    } else {
                        $json['result']['error'] = $this->data['lang_error_form_disabled'];
                    }
                }
            }

            if ($json && (isset($json['result']['error']) || isset($json['error']))) {
                if (isset($json['result']['error'])) {
                    $json['error'] = '';
                } else {
                    $json['result']['error'] = $this->data['lang_error_review'];
                }
            } else {
                if ($user) {
                    $user_id = $user['id'];

                    $user_token = $user['token'];
                } else {
                    $user_token = $this->variable->random();

                    $user_id = $this->user->createUser($this->request->post['cmtx_name'], $this->request->post['cmtx_email'], $user_token, $ip_address);
                }

                if ($this->setting->get('enabled_question')) {
                    $question = $this->model_main_form->getQuestion();

                    if ($question) {
                        $this->session->data['cmtx_question_id_' . $this->page->getId()] = $question['id'];

                        $json['question'] = $question['question'];
                    }
                }

                $subscription_token = $this->variable->random();

                $subscription_id = $this->model_main_form->addSubscription($user_id, $page_id, $subscription_token, $ip_address);

                $this->notify->subscriberConfirmation($this->setting->get('notify_format'), $this->request->post['cmtx_name'], $this->request->post['cmtx_email'], $page['reference'], $page['url'], $user_token, $subscription_token);

                /* Unset that the Captcha is complete so the user has to pass it again */
                unset($this->session->data['cmtx_captcha_complete_' . $this->page->getId()]);

                $json['result']['success'] = $this->data['lang_text_notify_success'];
            }

            echo json_encode($json);
        }
    }
}
