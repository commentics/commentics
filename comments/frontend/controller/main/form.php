<?php
namespace Commentics;

class MainFormController extends Controller
{
    public function index()
    {
        $this->loadLanguage('main/form');

        $this->loadModel('main/form');
        $this->loadModel('main/form_prepare');

        if ($this->setting->get('enabled_form') && $this->page->isFormEnabled()) {
            $this->data['display_form'] = true;

            if (defined('CMTX_LOGGED_IN') && !CMTX_LOGGED_IN) {
                $this->data['display_form'] = false;

                $this->data['lang_error_form_disabled'] = $this->data['lang_error_logged_in'];
            }
        } else {
            $this->data['display_form'] = false;
        }

        if ($this->data['display_form']) {
            $this->data['commentics_url'] = $this->url->getCommenticsUrl();

            /* Stores form data to be posted in a hidden field */
            $this->data['hidden_data'] = '';

            $cookie = $this->model_main_form->getFormCookie();

            /* Comment */
            $this->data = $this->model_main_form_prepare->prepareComment($this->data);

            /* Headline */
            $this->data = $this->model_main_form_prepare->prepareHeading($this->data);

            /* Rating */
            $this->data = $this->model_main_form_prepare->prepareRating($this->data);

            /* Name */
            $this->data = $this->model_main_form_prepare->prepareName($this->data, $cookie);

            /* Email */
            $this->data = $this->model_main_form_prepare->prepareEmail($this->data, $cookie);

            /* User */
            $this->data = $this->model_main_form_prepare->prepareUser($this->data);

            /* Website */
            $this->data = $this->model_main_form_prepare->prepareWebsite($this->data, $cookie);

            /* Town */
            $this->data = $this->model_main_form_prepare->prepareTown($this->data, $cookie);

            /* Country */
            $this->data = $this->model_main_form_prepare->prepareCountry($this->data, $cookie);

            /* State */
            $this->data = $this->model_main_form_prepare->prepareState($this->data, $cookie);

            /* Geo */
            $this->data = $this->model_main_form_prepare->prepareGeo($this->data);

            /* Question */
            $this->data = $this->model_main_form_prepare->prepareQuestion($this->data);

            /* Extra fields */
            $this->data = $this->model_main_form_prepare->prepareExtraFields($this->data);

            /* ReCaptcha */
            $this->data = $this->model_main_form_prepare->prepareReCaptcha($this->data);

            /* Captcha */
            $this->data = $this->model_main_form_prepare->prepareCaptcha($this->data);

            /* Notify */
            $this->data = $this->model_main_form_prepare->prepareNotify($this->data);

            /* Cookie */
            $this->data = $this->model_main_form_prepare->prepareCookie($this->data);

            /* Powered By */
            $this->data = $this->model_main_form_prepare->preparePoweredBy($this->data);

            /* Maintenance mode */
            if ($this->setting->get('maintenance_mode')) {
                $this->data['maintenance_mode_admin'] = true;
            } else {
                $this->data['maintenance_mode_admin'] = false;
            }

            /* Is this an administrator? */
            if ($this->user->isAdmin()) {
                $this->data['cmtx_admin_button'] = 'cmtx_admin_button';
            } else {
                $this->data['cmtx_admin_button'] = '';
            }

            /* This is for fields that are always required */
            $this->data['general_symbol'] = ($this->setting->get('display_required_symbol') ? 'cmtx_required' : '');

            $this->data['page_id'] = $this->page->getId();

            $this->data['iframe'] = (int) $this->page->isIFrame();

            $this->data['time'] = time();

            /* Unset that the Captcha is complete */
            unset($this->session->data['cmtx_captcha_complete_' . $this->page->getId()]);

            /* Avatar provided by login information */
            if ($this->user->getLogin('avatar')) {
                $this->data['hidden_data'] .= '&cmtx_avatar=' . $this->url->encode($this->user->getLogin('avatar'));
            }

            /* Name/email provided by login information */
            if ($this->user->getLogin('name') || $this->user->getLogin('email')) {
                $this->data['hidden_data'] .= '&cmtx_login=1';
            } else {
                $this->data['hidden_data'] .= '&cmtx_login=0';
            }

            $this->data['hidden_data'] = str_replace('&', '&amp;', $this->data['hidden_data']);

            $this->data['lang_text_drag_and_drop'] = sprintf($this->data['lang_text_drag_and_drop'], $this->setting->get('maximum_upload_amount'));

            /* These are passed to common.js via the template */
            $this->data['cmtx_js_settings_form'] = array(
                'commentics_url'           => $this->url->getCommenticsUrl(),
                'page_id'                  => (int) $this->page->getId(),
                'enabled_country'          => (bool) $this->setting->get('enabled_country'),
                'country_id'               => (int) $this->data['country_id'],
                'enabled_state'            => (bool) $this->setting->get('enabled_state'),
                'state_id'                 => (int) $this->data['state_id'],
                'enabled_upload'           => (bool) $this->setting->get('enabled_upload'),
                'maximum_upload_amount'    => (int) $this->setting->get('maximum_upload_amount'),
                'maximum_upload_size'      => (float) $this->setting->get('maximum_upload_size'),
                'maximum_upload_total'     => (float) $this->setting->get('maximum_upload_total'),
                'captcha'                  => (bool) $this->data['captcha'],
                'captcha_url'              => $this->data['captcha_url'],
                'cmtx_wait_for_comment'    => $this->data['cmtx_wait_for_comment'],
                'lang_error_file_num'      => $this->data['lang_error_file_num'],
                'lang_error_file_size'     => $this->data['lang_error_file_size'],
                'lang_error_file_total'    => $this->data['lang_error_file_total'],
                'lang_error_file_type'     => $this->data['lang_error_file_type'],
                'lang_text_loading'        => $this->data['lang_text_loading'],
                'lang_placeholder_country' => $this->data['lang_placeholder_country'],
                'lang_placeholder_state'   => $this->data['lang_placeholder_state'],
                'lang_text_country_first'  => $this->data['lang_text_country_first'],
                'lang_button_submit'       => $this->data['lang_button_submit'],
                'lang_button_preview'      => $this->data['lang_button_preview'],
                'lang_button_remove'       => $this->data['lang_button_remove'],
                'lang_button_processing'   => $this->data['lang_button_processing']
            );

            $this->data['cmtx_js_settings_form'] = json_encode($this->data['cmtx_js_settings_form']);
        }

        return $this->data;
    }

    public function getCountries()
    {
        if ($this->request->isAjax()) {
            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            $countries = $this->geo->getCountries();

            foreach ($countries as $country) {
                $json[] = array(
                    'id'   => $country['id'],
                    'name' => $country['name']
                );
            }

            echo json_encode($json);
        }
    }

    public function getStates()
    {
        if ($this->request->isAjax()) {
            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (isset($this->request->post['country_id']) && $this->request->post['country_id']) {
                $country_id = $this->request->post['country_id'];
            } else if ($this->setting->get('default_country')) {
                $country_id = $this->setting->get('default_country');
            } else {
                $country_id = '189'; // United States
            }

            $states = $this->geo->getStatesByCountryId($country_id);

            foreach ($states as $state) {
                $json[] = array(
                    'id'   => $state['id'],
                    'name' => $state['name']
                );
            }

            echo json_encode($json);
        }
    }

    public function captcha()
    {
        if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'image' && extension_loaded('gd') && function_exists('imagettftext') && is_callable('imagettftext')) {
            if (isset($this->request->get['page_id'])) {
                $page_id = (int) $this->request->get['page_id'];

                if ($this->page->pageExists($page_id)) {
                    $this->loadModel('main/form_captcha');

                    $captcha_string = $this->variable->random($this->setting->get('captcha_length'), true);

                    $this->session->data['cmtx_captcha_answer_' . $page_id] = $captcha_string;

                    $image = $this->model_main_form_captcha->createImage($captcha_string);

                    $this->response->addHeader('Content-type: image/png');

                    imagepng($image);
                    imagedestroy($image);
                }
            }
        }
    }

    public function submit()
    {
        if ($this->request->isAjax()) {
            $this->loadLanguage('main/form');

            $this->loadModel('main/form');
            $this->loadModel('main/form_validate');

            $this->response->addHeader('Content-Type: application/json');

            $json = array();

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
                                /* Is this a preview? */
                                if ($this->setting->get('enabled_preview') && isset($this->request->post['cmtx_type']) && $this->request->post['cmtx_type'] == 'preview') {
                                    $is_preview = true;
                                } else {
                                    $is_preview = false;
                                }

                                /* Check for flooding (delay) */
                                $this->model_main_form_validate->validateFloodingDelay($is_admin, $page_id);

                                /* Check for flooding (maximum) */
                                $this->model_main_form_validate->validateFloodingMaximum($is_admin, $page_id);

                                /* Check referrer */
                                $this->model_main_form_validate->validateReferrer();

                                /* Check honeypot */
                                $this->model_main_form_validate->validateHoneypot();

                                /* Check time */
                                $this->model_main_form_validate->validateTime();

                                /* Comment */
                                $this->model_main_form_validate->validateComment($is_preview);

                                /* Headline */
                                $this->model_main_form_validate->validateHeadline($is_preview);

                                /* Name */
                                $this->model_main_form_validate->validateName($is_admin);

                                /* Email */
                                $this->model_main_form_validate->validateEmail($is_admin);

                                /* User */
                                $user = $this->model_main_form_validate->validateUser();

                                /* Rating */
                                $this->model_main_form_validate->validateRating($page_id);

                                /* Website */
                                $this->model_main_form_validate->validateWebsite($is_admin);

                                /* Town */
                                $this->model_main_form_validate->validateTown($is_admin);

                                /* Country */
                                $this->model_main_form_validate->validateCountry();

                                /* State */
                                $this->model_main_form_validate->validateState();

                                /* Question */
                                $this->model_main_form_validate->validateQuestion();

                                /* Extra fields */
                                $this->model_main_form_validate->validateExtraFields($is_preview);

                                /* ReCaptcha */
                                $this->model_main_form_validate->validateReCaptcha();

                                /* Image Captcha */
                                $this->model_main_form_validate->validateImageCaptcha();

                                /* Captcha */
                                $this->model_main_form_validate->validateCaptcha();

                                /* Privacy */
                                $this->model_main_form_validate->validatePrivacy($is_preview);

                                /* Terms */
                                $this->model_main_form_validate->validateTerms($is_preview);

                                /* Reply */
                                $this->model_main_form_validate->validateReply();

                                /* Upload */
                                $this->model_main_form_validate->validateUpload($is_preview);

                                /* Avatar provided by login information */
                                if ($this->setting->get('avatar_type') == 'login' && isset($this->request->post['cmtx_avatar']) && $this->validation->isUrl($this->request->post['cmtx_avatar']) && $this->request->post['cmtx_email']) {
                                    $avatar_login = $this->request->post['cmtx_avatar'];
                                } else {
                                    $avatar_login = '';
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

            $json = array_merge($json, $this->model_main_form_validate->getJson());

            if ($json && (isset($json['result']['error']) || isset($json['error']))) {
                if (isset($json['result']['error'])) {
                    $json['error'] = '';
                } else {
                    $json['result']['error'] = $this->data['lang_error_review'];
                }
            } else {
                $uploads = $this->model_main_form_validate->getUploads();
                $extra_fields = $this->model_main_form_validate->getExtraFields();

                if ($is_preview) {
                    $this->loadLanguage('main/comments');

                    $this->loadModel('main/comments');

                    extract($this->setting->all());

                    $reply_depth = 0;

                    $show_bio = false;

                    $website_new_window = 'target="_blank"';
                    $website_no_follow  = '';

                    if ($avatar_login) {
                        $avatar = $avatar_login;
                    } else if ($user) {
                        $avatar = $this->user->getAvatar($user['id']);
                    } else {
                        $avatar = $this->user->getAvatar(0);
                    }

                    $location = '';

                    if ($this->setting->get('show_town') && $this->request->post['cmtx_town']) {
                        $location .= $this->request->post['cmtx_town'] . ', ';
                    }

                    if ($this->setting->get('show_state') && $this->request->post['cmtx_state']) {
                        $state = $this->geo->getState($this->request->post['cmtx_state']);

                        $location .= $state['name'] . ', ';
                    }

                    if ($this->setting->get('show_country') && $this->request->post['cmtx_country']) {
                        $country = $this->geo->getCountry($this->request->post['cmtx_country']);

                        $location .= $country['name'] . ', ';
                    }

                    $location = rtrim($location, ', ');

                    $ratings = array(0, 1, 2, 3, 4);

                    $comment_post = $this->request->post['cmtx_comment'];

                    if ($this->setting->get('enabled_smilies')) {
                        $comment_post = $this->model_main_comments->convertSmilies($comment_post);
                    }

                    if ($this->setting->get('enabled_bb_code') && ($this->setting->get('enabled_bb_code_code') || $this->setting->get('enabled_bb_code_php'))) {
                        $comment_post = $this->model_main_comments->highlightCode($comment_post);
                    }

                    $comment_post = $this->model_main_comments->purifyComment($comment_post);

                    $date_added = $this->data['lang_text_today'];

                    $comment = array(
                        'id'               => 0,
                        'avatar'           => $avatar,
                        'level'            => $this->data['lang_text_preview'],
                        'name'             => $this->request->post['cmtx_name'],
                        'website'          => $this->request->post['cmtx_website'],
                        'location'         => $location,
                        'is_sticky'        => false,
                        'rating'           => $this->request->post['cmtx_rating'],
                        'comment'          => $comment_post,
                        'headline'         => $this->request->post['cmtx_headline'],
                        'is_admin'         => $is_admin,
                        'date_added'       => $date_added,
                        'datetime'         => '',
                        'uploads'          => $uploads,
                        'extra_fields'     => $extra_fields,
                        'reply'            => false,
                        'reply_id'         => array(),
                        'number_edits'     => 0
                    );

                    extract($this->data);

                    ob_start();

                    require $this->loadTemplate('comment/' . $this->setting->get('comment_layout'));

                    $json['result']['preview'] = ob_get_clean();
                } else {
                    if ($user) {
                        $user_token = $user['token'];

                        $user_id = $user['id'];

                        if ($this->setting->get('avatar_user_link') && $this->request->post['cmtx_email']) {
                            if (in_array($this->setting->get('avatar_type'), array('gravatar', 'selection', 'upload'))) {
                                $this->loadModel('main/user');

                                if ($this->setting->get('avatar_link_days') && $this->model_main_user->numDaysSinceUserAdded($user['date_added']) <= $this->setting->get('avatar_link_days')) {
                                    $json['user_link'] = sprintf($this->data['lang_text_user_link'], $this->setting->get('commentics_url') . 'frontend/index.php?route=main/user&u-t=' . $user_token);
                                }
                            }
                        }
                    } else {
                        $user_token = $this->user->createToken();

                        $user_id = $this->user->createUser($this->request->post['cmtx_name'], $this->request->post['cmtx_email'], $user_token, $ip_address);

                        if ($this->setting->get('avatar_user_link')) {
                            if (in_array($this->setting->get('avatar_type'), array('selection', 'upload')) || ($this->setting->get('avatar_type') == 'gravatar' && $this->request->post['cmtx_email'])) {
                                $json['user_link'] = sprintf($this->data['lang_text_user_link'], $this->setting->get('commentics_url') . 'frontend/index.php?route=main/user&u-t=' . $user_token);
                            }
                        }
                    }

                    /* Determine if the comment needs to be approved by the administrator */
                    $approve = $this->model_main_form_validate->needsApproval($is_admin, $user, $page, $ip_address);

                    $comment_id = $this->comment->createComment($user_id, $page_id, $this->request->post['cmtx_website'], $this->request->post['cmtx_town'], $this->request->post['cmtx_state'], $this->request->post['cmtx_country'], $this->request->post['cmtx_rating'], $this->request->post['cmtx_reply_to'], $this->request->post['cmtx_headline'], $this->request->post['cmtx_original_comment'], $this->request->post['cmtx_comment'], $ip_address, $approve, $this->model_main_form_validate->getNotes(), $is_admin, $uploads, $extra_fields);

                    $this->comment->deleteCache($comment_id);

                    if ($this->request->post['cmtx_rating']) {
                        $this->cache->delete('getaveragerating_pageid' . $page_id);
                    }

                    if ($this->setting->get('enabled_question')) {
                        $question = $this->model_main_form->getQuestion();

                        if ($question) {
                            $this->session->data['cmtx_question_id_' . $this->page->getId()] = $question['id'];

                            $json['question'] = $question['question'];
                        }
                    }

                    if ($this->setting->get('enabled_notify') && isset($this->request->post['cmtx_notify']) && $this->setting->get('enabled_email') && $this->request->post['cmtx_email'] && !$is_admin) {
                        if (!$this->model_main_form->subscriptionExists($user_id, $page_id) && !$this->model_main_form->userHasSubscriptionAttempt($user_id) && !$this->model_main_form->ipHasSubscriptionAttempt($ip_address)) {
                            $subscription_token = $this->user->createToken();

                            $subscription_id = $this->model_main_form->addSubscription($user_id, $page_id, $subscription_token, $ip_address);

                            $this->notify->subscriberConfirmation($this->setting->get('notify_format'), $this->request->post['cmtx_name'], $this->request->post['cmtx_email'], $page['reference'], $page['url'], $user_token, $subscription_token);
                        }
                    }

                    if ($this->setting->get('enabled_cookie') && (isset($this->request->post['cmtx_cookie']) || (!isset($this->request->post['cmtx_cookie']) && $this->setting->get('form_cookie')))) {
                        $values = array(
                            $this->security->decode($this->request->post['cmtx_name']),
                            $this->security->decode($this->request->post['cmtx_email']),
                            $this->security->decode($this->request->post['cmtx_website']),
                            $this->security->decode($this->request->post['cmtx_town']),
                            $this->security->decode($this->request->post['cmtx_country']),
                            $this->security->decode($this->request->post['cmtx_state'])
                        );

                        $values = implode('|', $values);

                        $this->cookie->set('Commentics-Form', $values, 60 * 60 * 24 * $this->setting->get('form_cookie_days') + time());
                    }

                    /* Notify admins of comment */
                    if (!$is_admin) {
                        if ($approve) {
                            $this->notify->adminNotifyCommentApprove($comment_id);
                        } else {
                            $this->notify->adminNotifyCommentSuccess($comment_id);
                        }
                    }

                    /* Notify subscribers of comment */
                    if ($this->setting->get('enabled_notify') && ($is_admin || (!$this->setting->get('approve_notifications') && !$approve))) {
                        $this->notify->subscriberNotification($comment_id);
                    }

                    /* Unset that the Captcha is complete so the user has to pass it again */
                    unset($this->session->data['cmtx_captcha_complete_' . $this->page->getId()]);

                    /* Save avatar provided by login information */
                    if ($avatar_login) {
                        $this->user->saveAvatarLogin($user_id, $avatar_login);
                    }

                    if ($approve) {
                        $json['result']['approve'] = true;
                        $json['result']['success'] = $this->data['lang_text_comment_approve'];
                    } else {
                        $json['result']['approve'] = false;
                        $json['result']['success'] = $this->data['lang_text_comment_success'];
                    }
                }
            }

            echo json_encode($json);
        }
    }

    public function edit()
    {
        if ($this->request->isAjax()) {
            $this->loadLanguage('main/form');

            $this->loadModel('main/form_validate');

            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (!$this->setting->get('show_edit') && !$this->user->isAdmin()) { // check if feature enabled
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

                                if (isset($this->request->post['cmtx_comment_id'])) {
                                    $comment_id = $this->request->post['cmtx_comment_id'];
                                } else {
                                    $comment_id = 0;
                                }

                                $comment = $this->comment->getComment($comment_id);

                                if ($comment) {
                                    if ($this->user->ownComment($comment) || $this->user->isAdmin()) {
                                        if ($comment['number_edits'] < $this->setting->get('max_edits')) {
                                            if ($this->user->isBanned($ip_address)) {
                                                $json['result']['error'] = $this->data['lang_error_banned'];
                                            } else {
                                                /* Comment */
                                                $this->model_main_form_validate->validateComment(false);
                                            }
                                        } else {
                                            $json['result']['error'] = $this->data['lang_error_max_edits'];
                                        }
                                    } else {
                                        $json['result']['error'] = $this->data['lang_error_own_comment'];
                                    }
                                } else {
                                    $json['result']['error'] = $this->data['lang_error_no_comment'];
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

                $json = array_merge($json, $this->model_main_form_validate->getJson());

                if ($json && (isset($json['result']['error']) || isset($json['error']))) {
                    if (isset($json['result']['error'])) {
                        $json['error'] = '';
                    } else {
                        $json['result']['error'] = $this->data['lang_error_review'];
                    }
                } else {
                    $user = $this->user->getUserByCommentId($comment_id);

                    /* Determine if the comment needs to be approved by the administrator */
                    $approve = $this->model_main_form_validate->needsApproval($is_admin, $user, $page, $ip_address);

                    $this->comment->editComment($comment_id, $this->request->post['cmtx_original_comment'], $this->request->post['cmtx_comment'], $approve, $this->model_main_form_validate->getNotes());

                    $this->comment->deleteCache($comment_id);

                    /* Notify admins of edit */
                    if (!$is_admin) {
                        $this->notify->adminNotifyCommentEdit($comment_id);
                    }

                    if ($approve) {
                        $json['result']['approve'] = true;
                        $json['result']['success'] = $this->data['lang_text_comment_approve'];
                    } else {
                        $json['result']['approve'] = false;
                        $json['result']['success'] = $this->data['lang_text_comment_edited'];
                    }
                }
            }

            echo json_encode($json);
        }
    }

    public function reply()
    {
        if ($this->request->isAjax()) {
            $this->loadLanguage('main/form');

            $this->loadModel('main/form_validate');

            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (!$this->setting->get('show_reply') || !$this->setting->get('quick_reply')) { // check if feature enabled
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
                                    /* Check for flooding (delay) */
                                    $this->model_main_form_validate->validateFloodingDelay($is_admin, $page_id);

                                    /* Check for flooding (maximum) */
                                    $this->model_main_form_validate->validateFloodingMaximum($is_admin, $page_id);

                                    /* Check referrer */
                                    $this->model_main_form_validate->validateReferrer();

                                    /* Check honeypot */
                                    $this->model_main_form_validate->validateHoneypot();

                                    /* Check time */
                                    $this->model_main_form_validate->validateTime();

                                    /* Comment */
                                    $this->model_main_form_validate->validateComment(false);

                                    /* Name */
                                    $this->model_main_form_validate->validateName($is_admin);

                                    /* Email */
                                    $this->model_main_form_validate->validateEmail($is_admin);

                                    /* User */
                                    $user = $this->model_main_form_validate->validateUser();

                                    /* Reply */
                                    $this->model_main_form_validate->validateReply(true);
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

                $json = array_merge($json, $this->model_main_form_validate->getJson());

                if ($json && (isset($json['result']['error']) || isset($json['error']))) {
                    if (isset($json['result']['error'])) {
                        $json['error'] = '';
                    } else {
                        $json['result']['error'] = $this->data['lang_error_review'];
                    }
                } else {
                    if ($user) {
                        $user_token = $user['token'];

                        $user_id = $user['id'];
                    } else {
                        $user_token = $this->user->createToken();

                        $user_id = $this->user->createUser($this->request->post['cmtx_name'], $this->request->post['cmtx_email'], $user_token, $ip_address);
                    }

                    /* Determine if the comment needs to be approved by the administrator */
                    $approve = $this->model_main_form_validate->needsApproval($is_admin, $user, $page, $ip_address);

                    $comment_id = $this->comment->createComment($user_id, $page_id, '', '', '', 0, 0, $this->request->post['cmtx_reply_to'], '', $this->request->post['cmtx_original_comment'], $this->request->post['cmtx_comment'], $ip_address, $approve, $this->model_main_form_validate->getNotes(), $is_admin, array(), array());

                    $this->comment->deleteCache($comment_id);

                    /* Notify admins of comment */
                    if (!$is_admin) {
                        if ($approve) {
                            $this->notify->adminNotifyCommentApprove($comment_id);
                        } else {
                            $this->notify->adminNotifyCommentSuccess($comment_id);
                        }
                    }

                    /* Notify subscribers of comment */
                    if ($this->setting->get('enabled_notify') && ($is_admin || (!$this->setting->get('approve_notifications') && !$approve))) {
                        $this->notify->subscriberNotification($comment_id);
                    }

                    if ($approve) {
                        $json['result']['approve'] = true;
                        $json['result']['success'] = $this->data['lang_text_comment_approve'];
                    } else {
                        $json['result']['approve'] = false;
                        $json['result']['success'] = $this->data['lang_text_comment_success'];
                    }
                }
            }

            echo json_encode($json);
        }
    }
}
