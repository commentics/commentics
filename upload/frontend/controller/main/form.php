<?php
namespace Commentics;

class MainFormController extends Controller
{
    public function index()
    {
        $this->loadLanguage('main/form');

        $this->loadModel('main/form');

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
            $ip_address = $this->user->getIpAddress();

            $this->data['commentics_url'] = $this->url->getCommenticsUrl();

            $hidden_data = '';

            $this->data['display_javascript_disabled'] = $this->setting->get('display_javascript_disabled');

            $this->data['display_required_text'] = $this->setting->get('display_required_text');

            $this->data['display_required_symbol'] = $this->setting->get('display_required_symbol');

            $cookie = array();

            $cookie['name'] = $cookie['email'] = $cookie['website'] = $cookie['town'] = $cookie['country'] = $cookie['state'] = '';

            if ($this->cookie->exists('Commentics-Form')) {
                $values = $this->cookie->get('Commentics-Form');

                $values = explode('|', $values);

                if (count($values) == 6) {
                    $cookie['name']    = $this->security->encode($values[0]);
                    $cookie['email']   = $this->security->encode($values[1]);
                    $cookie['website'] = $this->security->encode($values[2]);
                    $cookie['town']    = $this->security->encode($values[3]);
                    $cookie['country'] = $this->security->encode($values[4]);
                    $cookie['state']   = $this->security->encode($values[5]);
                }
            }

            /* BB Code */

            $this->data['enabled_bb_code'] = $this->setting->get('enabled_bb_code');

            if ($this->data['enabled_bb_code']) {
                $this->data['enabled_bb_code_bold']        = $this->setting->get('enabled_bb_code_bold');
                $this->data['enabled_bb_code_italic']      = $this->setting->get('enabled_bb_code_italic');
                $this->data['enabled_bb_code_underline']   = $this->setting->get('enabled_bb_code_underline');
                $this->data['enabled_bb_code_strike']      = $this->setting->get('enabled_bb_code_strike');
                $this->data['enabled_bb_code_superscript'] = $this->setting->get('enabled_bb_code_superscript');
                $this->data['enabled_bb_code_subscript']   = $this->setting->get('enabled_bb_code_subscript');
                $this->data['enabled_bb_code_code']        = $this->setting->get('enabled_bb_code_code');
                $this->data['enabled_bb_code_php']         = $this->setting->get('enabled_bb_code_php');
                $this->data['enabled_bb_code_quote']       = $this->setting->get('enabled_bb_code_quote');
                $this->data['enabled_bb_code_line']        = $this->setting->get('enabled_bb_code_line');
                $this->data['enabled_bb_code_bullet']      = $this->setting->get('enabled_bb_code_bullet');
                $this->data['enabled_bb_code_numeric']     = $this->setting->get('enabled_bb_code_numeric');
                $this->data['enabled_bb_code_link']        = $this->setting->get('enabled_bb_code_link');
                $this->data['enabled_bb_code_email']       = $this->setting->get('enabled_bb_code_email');
                $this->data['enabled_bb_code_image']       = $this->setting->get('enabled_bb_code_image');
                $this->data['enabled_bb_code_youtube']     = $this->setting->get('enabled_bb_code_youtube');
            } else {
                $this->data['enabled_bb_code_bullet']  = false;
                $this->data['enabled_bb_code_numeric'] = false;
                $this->data['enabled_bb_code_link']    = false;
                $this->data['enabled_bb_code_email']   = false;
                $this->data['enabled_bb_code_image']   = false;
                $this->data['enabled_bb_code_youtube'] = false;
            }

            /* Smilies */

            $this->data['enabled_smilies'] = $this->setting->get('enabled_smilies');

            if ($this->data['enabled_smilies']) {
                $this->data['enabled_smilies_smile']    = $this->setting->get('enabled_smilies_smile');
                $this->data['enabled_smilies_sad']      = $this->setting->get('enabled_smilies_sad');
                $this->data['enabled_smilies_huh']      = $this->setting->get('enabled_smilies_huh');
                $this->data['enabled_smilies_laugh']    = $this->setting->get('enabled_smilies_laugh');
                $this->data['enabled_smilies_mad']      = $this->setting->get('enabled_smilies_mad');
                $this->data['enabled_smilies_tongue']   = $this->setting->get('enabled_smilies_tongue');
                $this->data['enabled_smilies_cry']      = $this->setting->get('enabled_smilies_cry');
                $this->data['enabled_smilies_grin']     = $this->setting->get('enabled_smilies_grin');
                $this->data['enabled_smilies_wink']     = $this->setting->get('enabled_smilies_wink');
                $this->data['enabled_smilies_scared']   = $this->setting->get('enabled_smilies_scared');
                $this->data['enabled_smilies_cool']     = $this->setting->get('enabled_smilies_cool');
                $this->data['enabled_smilies_sleep']    = $this->setting->get('enabled_smilies_sleep');
                $this->data['enabled_smilies_blush']    = $this->setting->get('enabled_smilies_blush');
                $this->data['enabled_smilies_confused'] = $this->setting->get('enabled_smilies_confused');
                $this->data['enabled_smilies_shocked']  = $this->setting->get('enabled_smilies_shocked');
            }

            /* Comment */

            $this->data['comment'] = $this->setting->get('default_comment');

            $this->data['comment_symbol'] = ($this->setting->get('display_required_symbol') ? 'cmtx_required' : '');

            $this->data['comment_maximum_characters'] = $this->setting->get('comment_maximum_characters');

            $this->data['enabled_counter'] = $this->setting->get('enabled_counter');

            /* Upload */

            $this->data['enabled_upload'] = $this->setting->get('enabled_upload');

            /* Name */

            $this->data['enabled_name'] = true;

            $this->data['name_is_filled'] = false;

            $this->data['filled_name_action'] = 'normal';

            /* The precedence is login info, cookie and default */
            if ($this->user->getLogin('name')) {
                $this->data['name'] = $this->user->getLogin('name');

                $this->data['name_is_filled'] = true;

                $this->data['filled_name_action'] = $this->setting->get('filled_name_login_action');
            } else if ($cookie['name']) {
                $this->data['name'] = $cookie['name'];

                $this->data['name_is_filled'] = true;

                $this->data['filled_name_action'] = $this->setting->get('filled_name_cookie_action');
            } else {
                $this->data['name'] = $this->setting->get('default_name');
            }

            if ($this->data['name_is_filled'] && $this->data['filled_name_action'] == 'disable') {
                $this->data['name_readonly'] = 'readonly';
            } else {
                $this->data['name_readonly'] = '';
            }

            $this->data['name_symbol'] = ($this->setting->get('display_required_symbol') ? 'cmtx_required' : '');

            $this->data['maximum_name'] = $this->setting->get('maximum_name');

            /* Email */

            $this->data['enabled_email'] = $this->setting->get('enabled_email');

            $this->data['email_is_filled'] = false;

            $this->data['filled_email_action'] = 'normal';

            if ($this->user->getLogin('email')) {
                $this->data['email'] = $this->user->getLogin('email');

                $this->data['email_is_filled'] = true;

                $this->data['filled_email_action'] = $this->setting->get('filled_email_login_action');
            } else if ($cookie['email']) {
                $this->data['email'] = $cookie['email'];

                $this->data['email_is_filled'] = true;

                $this->data['filled_email_action'] = $this->setting->get('filled_email_cookie_action');
            } else {
                $this->data['email'] = $this->setting->get('default_email');
            }

            if ($this->data['email_is_filled'] && $this->data['filled_email_action'] == 'disable') {
                $this->data['email_readonly'] = 'readonly';
            } else {
                $this->data['email_readonly'] = '';
            }

            $this->data['email_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_email') ? 'cmtx_required' : '');

            $this->data['maximum_email'] = $this->setting->get('maximum_email');

            /* User */

            if ($this->data['name_is_filled'] && $this->data['filled_name_action'] == 'hide') {
                $this->data['enabled_name'] = false;

                $hidden_data .= '&cmtx_name=' . $this->url->encode($this->data['name']);
            }

            if ($this->data['email_is_filled'] && $this->data['filled_email_action'] == 'hide') {
                $this->data['enabled_email'] = false;

                $hidden_data .= '&cmtx_email=' . $this->url->encode($this->data['email']);
            }

            $user_columns = (int) $this->data['enabled_name'] + (int) $this->data['enabled_email'];

            if ($user_columns) {
                $user_row_visible = true;
                $this->data['user_row_visible'] = '';
            } else {
                $user_row_visible = false;
                $this->data['user_row_visible'] = 'cmtx_hide';
            }

            if ($user_row_visible && $this->setting->get('hide_form')) {
                $this->data['cmtx_wait_for_comment'] = 'cmtx_wait_for_comment';
                $this->data['cmtx_wait_for_user'] = 'cmtx_wait_for_user';
            } else {
                $this->data['cmtx_wait_for_comment'] = '';
                $this->data['cmtx_wait_for_user'] = '';
            }

            switch ($user_columns) {
                case '1':
                    $this->data['user_column_size'] = '12';
                    break;
                case '2':
                    $this->data['user_column_size'] = '6';
                    break;
                default:
                    $this->data['user_column_size'] = '6';
            }

            /* Rating */

            if ($this->setting->get('repeat_rating') == 'hide' && $this->model_main_form->hasUserRated($this->page->getId(), $ip_address)) {
                $this->data['enabled_rating'] = false;
            } else {
                $this->data['enabled_rating'] = $this->setting->get('enabled_rating');
            }

            $this->data['rating_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_rating') ? 'cmtx_required' : '');

            $default_rating = $this->setting->get('default_rating');

            if ($default_rating == '1') {
                $this->data['rating_1_checked'] = 'checked';
            } else {
                $this->data['rating_1_checked'] = '';
            }

            if ($default_rating == '2') {
                $this->data['rating_2_checked'] = 'checked';
            } else {
                $this->data['rating_2_checked'] = '';
            }

            if ($default_rating == '3') {
                $this->data['rating_3_checked'] = 'checked';
            } else {
                $this->data['rating_3_checked'] = '';
            }

            if ($default_rating == '4') {
                $this->data['rating_4_checked'] = 'checked';
            } else {
                $this->data['rating_4_checked'] = '';
            }

            if ($default_rating == '5') {
                $this->data['rating_5_checked'] = 'checked';
            } else {
                $this->data['rating_5_checked'] = '';
            }

            /* Website */

            $this->data['enabled_website'] = $this->setting->get('enabled_website');

            $this->data['website_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_website') ? 'cmtx_required' : '');

            $this->data['website_is_filled'] = false;

            $this->data['filled_website_action'] = 'normal';

            if ($this->user->getLogin('website')) {
                $this->data['website'] = $this->user->getLogin('website');

                $this->data['website_is_filled'] = true;

                $this->data['filled_website_action'] = $this->setting->get('filled_website_login_action');
            } else if ($cookie['website']) {
                $this->data['website'] = $cookie['website'];

                $this->data['website_is_filled'] = true;

                $this->data['filled_website_action'] = $this->setting->get('filled_website_cookie_action');
            } else {
                $this->data['website'] = $this->setting->get('default_website');
            }

            if ($this->data['website_is_filled'] && $this->data['filled_website_action'] == 'disable') {
                $this->data['website_readonly'] = 'readonly';
            } else {
                $this->data['website_readonly'] = '';
            }

            $this->data['maximum_website'] = $this->setting->get('maximum_website');

            if ($this->data['website_is_filled'] && $this->data['filled_website_action'] == 'hide') {
                $this->data['enabled_website'] = false;

                $hidden_data .= '&cmtx_website=' . $this->url->encode($this->data['website']);
            }

            /* Town */

            $this->data['enabled_town'] = $this->setting->get('enabled_town');

            $this->data['town_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_town') ? 'cmtx_required' : '');

            $this->data['town_is_filled'] = false;

            $this->data['filled_town_action'] = 'normal';

            if ($this->user->getLogin('town')) {
                $this->data['town'] = $this->user->getLogin('town');

                $this->data['town_is_filled'] = true;

                $this->data['filled_town_action'] = $this->setting->get('filled_town_login_action');
            } else if ($cookie['town']) {
                $this->data['town'] = $cookie['town'];

                $this->data['town_is_filled'] = true;

                $this->data['filled_town_action'] = $this->setting->get('filled_town_cookie_action');
            } else {
                $this->data['town'] = $this->setting->get('default_town');
            }

            if ($this->data['town_is_filled'] && $this->data['filled_town_action'] == 'disable') {
                $this->data['town_readonly'] = 'readonly';
            } else {
                $this->data['town_readonly'] = '';
            }

            $this->data['maximum_town'] = $this->setting->get('maximum_town');

            /* Country */

            $this->data['enabled_country'] = $this->setting->get('enabled_country');

            $this->data['country_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_country') ? 'cmtx_required' : '');

            $this->data['countries'] = $this->geo->getCountries();

            $this->data['country_is_filled'] = false;

            $this->data['filled_country_action'] = 'normal';

            if ($this->user->getLogin('country')) {
                $this->data['country_id'] = $this->user->getLogin('country');

                $this->data['country_is_filled'] = true;

                $this->data['filled_country_action'] = $this->setting->get('filled_country_login_action');
            } else if ($cookie['country']) {
                $this->data['country_id'] = $cookie['country'];

                $this->data['country_is_filled'] = true;

                $this->data['filled_country_action'] = $this->setting->get('filled_country_cookie_action');
            } else {
                $this->data['country_id'] = $this->setting->get('default_country');
            }

            if ($this->data['country_is_filled'] && $this->data['filled_country_action'] == 'disable') {
                $this->data['country_disabled'] = 'disabled';
            } else {
                $this->data['country_disabled'] = '';
            }

            /* State */

            $this->data['enabled_state'] = $this->setting->get('enabled_state');

            $this->data['state_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_state') ? 'cmtx_required' : '');

            $this->data['states'] = array();

            if (!$this->setting->get('enabled_country')) {
                if ($this->setting->get('default_country')) {
                    $this->data['states'] = $this->geo->getStatesByCountryId($this->setting->get('default_country'));
                } else {
                    $this->data['states'] = $this->geo->getStatesByCountryId('164'); // United States
                }
            }

            $this->data['state_is_filled'] = false;

            $this->data['filled_state_action'] = 'normal';

            if ($this->user->getLogin('state')) {
                $this->data['state_id'] = $this->user->getLogin('state');

                $this->data['state_is_filled'] = true;

                $this->data['filled_state_action'] = $this->setting->get('filled_state_login_action');
            } else if ($cookie['state']) {
                $this->data['state_id'] = $cookie['state'];

                $this->data['state_is_filled'] = true;

                $this->data['filled_state_action'] = $this->setting->get('filled_state_cookie_action');
            } else {
                $this->data['state_id'] = $this->setting->get('default_state');
            }

            if ($this->data['state_is_filled'] && $this->data['filled_state_action'] == 'disable') {
                $this->data['state_disabled'] = 'disabled';
            } else {
                $this->data['state_disabled'] = '';
            }

            /* Question */

            $this->data['question'] = false;

            $this->data['answer_symbol'] = ($this->setting->get('display_required_symbol') ? 'cmtx_required' : '');

            if ($this->setting->get('enabled_question')) {
                $question = $this->model_main_form->getQuestion();

                if ($question) {
                    $this->session->data['cmtx_question_id_' . $this->page->getId()] = $question['id'];

                    $this->data['question'] = $question['question'];
                }
            }

            /* ReCaptcha */

            $this->data['recaptcha'] = false;

            if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'recaptcha' && (bool) ini_get('allow_url_fopen')) {
                $this->data['recaptcha'] = true;

                $this->data['recaptcha_public_key'] = $this->setting->get('recaptcha_public_key');

                $this->data['recaptcha_theme'] = $this->setting->get('recaptcha_theme');

                $this->data['recaptcha_size'] = $this->setting->get('recaptcha_size');
            }

            /* Securimage */

            $this->data['securimage'] = false;

            $this->data['securimage_url'] = CMTX_HTTP_3RDPARTY . 'securimage/securimage_show.php?namespace=cmtx_' . $this->page->getId();

            if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'securimage' && extension_loaded('gd') && function_exists('imagettftext') && is_callable('imagettftext')) {
                $this->data['securimage'] = true;

                $this->data['maximum_securimage'] = $this->setting->get('securimage_length');
            }

            /* Notify */

            $this->data['enabled_notify'] = $this->setting->get('enabled_notify');

            $default_notify = $this->setting->get('default_notify');

            if ($default_notify) {
                $this->data['notify_checked'] = 'checked';
            } else {
                $this->data['notify_checked'] = '';
            }

            /* Cookie */

            $this->data['enabled_cookie'] = $this->setting->get('enabled_cookie');

            $default_cookie = $this->setting->get('default_cookie');

            if ($default_cookie) {
                $this->data['cookie_checked'] = 'checked';
            } else {
                $this->data['cookie_checked'] = '';
            }

            /* Privacy */

            $this->data['enabled_privacy'] = $this->setting->get('enabled_privacy');

            /* Terms */

            $this->data['enabled_terms'] = $this->setting->get('enabled_terms');

            /* Preview */

            $this->data['enabled_preview'] = $this->setting->get('enabled_preview');

            /* Powered By */

            $this->data['enabled_powered_by'] = $this->setting->get('enabled_powered_by');

            if ($this->data['enabled_powered_by']) {
                if ($this->setting->get('powered_by_type') == 'text') {
                    $this->data['powered_by'] = sprintf($this->data['lang_text_powered_by'], 'https://www.commentics.org', $this->setting->get('powered_by_new_window') ? 'target="_blank"' : '');
                } else {
                    $this->data['powered_by'] = '<a href="https://www.commentics.org" title="Commentics" ' . ($this->setting->get('powered_by_new_window') ? 'target="_blank"' : '') . '><img src="' . $this->loadImage('commentics/powered_by.png') . '"></a>';
                }
            }

            /* Misc */

            /* Maintenance mode */
            if ($this->setting->get('maintenance_mode')) {
                $this->data['maintenance_mode_admin'] = true;
            } else {
                $this->data['maintenance_mode_admin'] = false;
            }

            /* Is this an administrator? */
            $is_admin = $this->user->isAdmin();

            if ($is_admin) {
                $this->data['cmtx_admin_button'] = 'cmtx_admin_button';
            } else {
                $this->data['cmtx_admin_button'] = '';
            }

            $this->data['page_id'] = $this->page->getId();

            $this->data['time'] = time();

            /* Unset that the Captcha is complete */
            unset($this->session->data['cmtx_captcha_complete_' . $this->page->getId()]);

            if ($this->setting->get('enabled_town') && $this->data['town_is_filled'] && $this->data['filled_town_action'] == 'hide') {
                $this->data['enabled_town'] = false;

                $hidden_data .= '&cmtx_town=' . $this->url->encode($this->data['town']);
            }

            if ($this->setting->get('enabled_country') && $this->data['country_is_filled'] && $this->data['filled_country_action'] == 'hide') {
                $this->data['enabled_country'] = false;

                $hidden_data .= '&cmtx_country=' . $this->url->encode($this->data['country_id']);
            }

            if ($this->setting->get('enabled_state') && $this->data['state_is_filled'] && $this->data['filled_state_action'] == 'hide') {
                $this->data['enabled_state'] = false;

                $hidden_data .= '&cmtx_state=' . $this->url->encode($this->data['state_id']);
            }

            $geo_columns = (int) $this->data['enabled_town'] + (int) $this->data['enabled_country'] + (int) $this->data['enabled_state'];

            if ($geo_columns) {
                $geo_row_visible = true;
            } else {
                $geo_row_visible = false;
            }

            if (!$geo_row_visible) {
                $this->data['geo_row_visible'] = 'cmtx_hide';
            } else if ($this->setting->get('hide_form')) {
                $this->data['geo_row_visible'] = 'cmtx_wait_for_user';
            } else {
                $this->data['geo_row_visible'] = '';
            }

            switch ($geo_columns) {
                case '1':
                    $this->data['geo_column_size'] = '12';
                    break;
                case '2':
                    $this->data['geo_column_size'] = '6';
                    break;
                case '3':
                    $this->data['geo_column_size'] = '4';
                    break;
                default:
                    $this->data['geo_column_size'] = '4';
            }

            $this->data['lang_tag_bb_code_bold']        = $this->data['lang_tag_bb_code_bold_start'] . '|' . $this->data['lang_tag_bb_code_bold_end'];
            $this->data['lang_tag_bb_code_italic']      = $this->data['lang_tag_bb_code_italic_start'] . '|' . $this->data['lang_tag_bb_code_italic_end'];
            $this->data['lang_tag_bb_code_underline']   = $this->data['lang_tag_bb_code_underline_start'] . '|' . $this->data['lang_tag_bb_code_underline_end'];
            $this->data['lang_tag_bb_code_strike']      = $this->data['lang_tag_bb_code_strike_start'] . '|' . $this->data['lang_tag_bb_code_strike_end'];
            $this->data['lang_tag_bb_code_superscript'] = $this->data['lang_tag_bb_code_superscript_start'] . '|' . $this->data['lang_tag_bb_code_superscript_end'];
            $this->data['lang_tag_bb_code_subscript']   = $this->data['lang_tag_bb_code_subscript_start'] . '|' . $this->data['lang_tag_bb_code_subscript_end'];
            $this->data['lang_tag_bb_code_code']        = $this->data['lang_tag_bb_code_code_start'] . '|' . $this->data['lang_tag_bb_code_code_end'];
            $this->data['lang_tag_bb_code_php']         = $this->data['lang_tag_bb_code_php_start'] . '|' . $this->data['lang_tag_bb_code_php_end'];
            $this->data['lang_tag_bb_code_quote']       = $this->data['lang_tag_bb_code_quote_start'] . '|' . $this->data['lang_tag_bb_code_quote_end'];
            $this->data['lang_tag_bb_code_bullet']      = $this->data['lang_tag_bb_code_bullet_1'] . '|' . $this->data['lang_tag_bb_code_bullet_2'] . '|' . $this->data['lang_tag_bb_code_bullet_3'] . '|' . $this->data['lang_tag_bb_code_bullet_4'];
            $this->data['lang_tag_bb_code_numeric']     = $this->data['lang_tag_bb_code_numeric_1'] . '|' . $this->data['lang_tag_bb_code_numeric_2'] . '|' . $this->data['lang_tag_bb_code_numeric_3'] . '|' . $this->data['lang_tag_bb_code_numeric_4'];
            $this->data['lang_tag_bb_code_link']        = $this->data['lang_tag_bb_code_link_1'] . '|' . $this->data['lang_tag_bb_code_link_2'] . '|' . $this->data['lang_tag_bb_code_link_3'] . '|' . $this->data['lang_tag_bb_code_link_4'];
            $this->data['lang_tag_bb_code_email']       = $this->data['lang_tag_bb_code_email_1'] . '|' . $this->data['lang_tag_bb_code_email_2'] . '|' . $this->data['lang_tag_bb_code_email_3'] . '|' . $this->data['lang_tag_bb_code_email_4'];
            $this->data['lang_tag_bb_code_image']       = $this->data['lang_tag_bb_code_image_1'] . '|' . $this->data['lang_tag_bb_code_image_2'];
            $this->data['lang_tag_bb_code_youtube']     = $this->data['lang_tag_bb_code_youtube_1'] . '|' . $this->data['lang_tag_bb_code_youtube_2'];

            $this->data['lang_text_drag_and_drop']      = sprintf($this->data['lang_text_drag_and_drop'], $this->setting->get('maximum_upload_amount'));

            $this->data['hidden_data'] = str_replace('&', '&amp;', $hidden_data);

            /* These are passed to common.js via the template */
            $this->data['cmtx_js_settings_form'] = array(
                'commentics_url'           => $this->url->getCommenticsUrl(),
                'page_id'                  => (int) $this->page->getId(),
                'enabled_country'          => (bool) $this->data['enabled_country'],
                'enabled_state'            => (bool) $this->data['enabled_state'],
                'state_id'                 => (int) $this->data['state_id'],
                'enabled_upload'           => (bool) $this->data['enabled_upload'],
                'maximum_upload_amount'    => (int) $this->setting->get('maximum_upload_amount'),
                'maximum_upload_size'      => (int) $this->setting->get('maximum_upload_size'),
                'maximum_upload_total'     => (int) $this->setting->get('maximum_upload_total'),
                'securimage'               => (bool) $this->data['securimage'],
                'securimage_url'           => $this->data['securimage_url'],
                'lang_error_file_num'      => $this->data['lang_error_file_num'],
                'lang_error_file_size'     => $this->data['lang_error_file_size'],
                'lang_error_file_total'    => $this->data['lang_error_file_total'],
                'lang_error_file_type'     => $this->data['lang_error_file_type'],
                'lang_text_loading'        => $this->data['lang_text_loading'],
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

    public function getStates()
    {
        if ($this->request->isAjax()) {
            $this->response->addHeader('Content-Type: application/json');

            $json = array();

            if (isset($this->request->post['country_id']) && $this->request->post['country_id']) {
                $states = $this->geo->getStatesByCountryId($this->request->post['country_id']);

                foreach ($states as $state) {
                    $json[] = array(
                        'id' => $state['id'],
                        'name' => $state['name']
                    );
                }
            }

            echo json_encode($json);
        }
    }

    public function submit()
    {
        if ($this->request->isAjax()) {
            $this->loadLanguage('main/form');

            $this->loadModel('main/form');

            $this->response->addHeader('Content-Type: application/json');

            $json = array();

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
                                /* Initialise some variables */
                                $approve = $notes = '';
                                $country = 0;
                                $user = false;
                                $uploads = array();

                                /* Is this a preview? */
                                if ($this->setting->get('enabled_preview') && isset($this->request->post['cmtx_type']) && $this->request->post['cmtx_type'] == 'preview') {
                                    $is_preview = true;
                                } else {
                                    $is_preview = false;
                                }

                                /* Check for flooding (delay) */
                                if ($this->setting->get('flood_control_delay_enabled') && !$is_admin) {
                                    if ($this->model_main_form->isFloodingDelay($ip_address, $page_id)) {
                                        $json['result']['error'] = $this->data['lang_error_flooding_delay'];
                                    }
                                }

                                /* Check for flooding (maximum) */
                                if ($this->setting->get('flood_control_maximum_enabled') && !$is_admin) {
                                    if ($this->model_main_form->isFloodingMaximum($ip_address, $page_id)) {
                                        $json['result']['error'] = $this->data['lang_error_flooding_maximum'];
                                    }
                                }

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

                                /* Comment */
                                if (isset($this->request->post['cmtx_comment']) && $this->request->post['cmtx_comment'] != '') {
                                    $comment = $this->security->decode($this->request->post['cmtx_comment']);

                                    /* Check comment length does not exceed maximum */
                                    if ($this->validation->length($this->request->post['cmtx_comment']) > $this->setting->get('comment_maximum_characters')) {
                                        $json['error']['comment'] = $this->data['lang_error_comment_max_length'];
                                    }

                                    /* Check repeats */
                                    if ($this->setting->get('check_repeats_enabled') && $this->model_main_form->hasRepeats($comment)) {
                                        if ($this->setting->get('check_repeats_action') == 'error') {
                                            $json['error']['comment'] = $this->data['lang_error_comment_has_repeats'];
                                        } else if ($this->setting->get('check_repeats_action') == 'approve') {
                                            $approve .= $this->data['lang_error_comment_has_repeats'] . "\r\n";
                                        } else {
                                            $json['result']['error'] = $this->data['lang_error_ban'];

                                            $this->user->ban($ip_address, $this->data['lang_error_comment_has_repeats']);
                                        }
                                    }

                                    /* Check for long word */
                                    if ($this->model_main_form->hasLongWord($comment)) {
                                        $json['error']['comment'] = $this->data['lang_error_comment_has_long_word'];
                                    }

                                    /* Check maximum lines */
                                    if ($this->model_main_form->countLines($comment) > $this->setting->get('comment_maximum_lines')) {
                                        $json['error']['comment'] = $this->data['lang_error_comment_max_lines'];
                                    }

                                    /* Check minimum words */
                                    if ($this->model_main_form->countWords($comment) < $this->setting->get('comment_minimum_words')) {
                                        $json['error']['comment'] = $this->data['lang_error_comment_min_words'];
                                    }

                                    /* Check for mild swear words */
                                    if ($this->setting->get('mild_swear_words_enabled')) {
                                        if ($this->model_main_form->hasWord($comment, 'mild_swear_words')) {
                                            if ($this->setting->get('mild_swear_words_action') == 'mask') {
                                                if (!$is_preview) {
                                                    $this->request->post['cmtx_comment'] = $this->model_main_form->maskWord($comment, 'mild_swear_words');
                                                }
                                            } else if ($this->setting->get('mild_swear_words_action') == 'mask_approve') {
                                                if (!$is_preview) {
                                                    $this->request->post['cmtx_comment'] = $this->model_main_form->maskWord($comment, 'mild_swear_words');

                                                    $approve .= $this->data['lang_error_comment_mild_swearing'] . "\r\n";
                                                }
                                            } else if ($this->setting->get('mild_swear_words_action') == 'error') {
                                                $json['error']['comment'] = $this->data['lang_error_comment_mild_swearing'];
                                            } else if ($this->setting->get('mild_swear_words_action') == 'approve') {
                                                $approve .= $this->data['lang_error_comment_mild_swearing'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_comment_mild_swearing']);
                                            }
                                        }
                                    }

                                    /* Check for strong swear words */
                                    if ($this->setting->get('strong_swear_words_enabled')) {
                                        if ($this->model_main_form->hasWord($comment, 'strong_swear_words')) {
                                            if ($this->setting->get('strong_swear_words_action') == 'mask') {
                                                if (!$is_preview) {
                                                    $this->request->post['cmtx_comment'] = $this->model_main_form->maskWord($comment, 'strong_swear_words');
                                                }
                                            } else if ($this->setting->get('strong_swear_words_action') == 'mask_approve') {
                                                if (!$is_preview) {
                                                    $this->request->post['cmtx_comment'] = $this->model_main_form->maskWord($comment, 'strong_swear_words');

                                                    $approve .= $this->data['lang_error_comment_strong_swearing'] . "\r\n";
                                                }
                                            } else if ($this->setting->get('strong_swear_words_action') == 'error') {
                                                $json['error']['comment'] = $this->data['lang_error_comment_strong_swearing'];
                                            } else if ($this->setting->get('strong_swear_words_action') == 'approve') {
                                                $approve .= $this->data['lang_error_comment_strong_swearing'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_comment_strong_swearing']);
                                            }
                                        }
                                    }

                                    /* Check for spam words */
                                    if ($this->setting->get('spam_words_enabled')) {
                                        if ($this->model_main_form->hasWord($comment, 'spam_words')) {
                                            if ($this->setting->get('spam_words_action') == 'error') {
                                                $json['error']['comment'] = $this->data['lang_error_comment_spam'];
                                            } else if ($this->setting->get('spam_words_action') == 'approve') {
                                                $approve .= $this->data['lang_error_comment_spam'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_comment_spam']);
                                            }
                                        }
                                    }

                                    /* Check for banned website */
                                    if ($this->setting->get('banned_websites_as_comment_enabled') && $this->model_main_form->hasWord($comment, 'banned_websites', false)) {
                                        if ($this->setting->get('banned_websites_as_comment_action') == 'error') {
                                            $json['error']['comment'] = $this->data['lang_error_website_banned'];
                                        } else if ($this->setting->get('banned_websites_as_comment_action') == 'approve') {
                                            $approve .= $this->data['lang_error_website_banned'] . "\r\n";
                                        } else {
                                            $json['result']['error'] = $this->data['lang_error_ban'];

                                            $this->user->ban($ip_address, $this->data['lang_error_website_banned']);
                                        }
                                    }

                                    /* Check for link */
                                    if ($this->setting->get('detect_link_in_comment_enabled') && $this->model_main_form->hasLink($comment)) {
                                        if ($this->setting->get('link_in_comment_action') == 'error') {
                                            $json['error']['comment'] = $this->data['lang_error_comment_has_link'];
                                        } else if ($this->setting->get('link_in_comment_action') == 'approve') {
                                            $approve .= $this->data['lang_error_comment_has_link'] . "\r\n";
                                        } else {
                                            $json['result']['error'] = $this->data['lang_error_ban'];

                                            $this->user->ban($ip_address, $this->data['lang_error_comment_has_link']);
                                        }
                                    }

                                    /* Check for image */
                                    if ($this->setting->get('approve_images') && $this->model_main_form->hasImage($comment)) {
                                        $approve .= $this->data['lang_error_comment_has_image'] . "\r\n";
                                    }

                                    /* Check for video */
                                    if ($this->setting->get('approve_videos') && $this->model_main_form->hasVideo($comment)) {
                                        $approve .= $this->data['lang_error_comment_has_video'] . "\r\n";
                                    }

                                    /* Check maximum smilies */
                                    if ($this->setting->get('enabled_smilies')) {
                                        if ($this->model_main_form->countSmilies($comment) > $this->setting->get('comment_maximum_smilies')) {
                                            $json['error']['comment'] = sprintf($this->data['lang_error_comment_max_smilies'], $this->setting->get('comment_maximum_smilies'));
                                        }
                                    }

                                    /* Convert BB code to HTML */
                                    if ($this->setting->get('enabled_bb_code')) {
                                        $this->request->post['cmtx_comment'] = $this->model_main_form->addBBCode($this->request->post['cmtx_comment']);

                                        if ($this->variable->strpos($this->request->post['cmtx_comment'], 'cmtx-invalid-bb-code-link') !== false) {
                                            $json['error']['comment'] = $this->data['lang_error_comment_invalid_link'];
                                        }
                                    }

                                    /* Check capitals (after BB Code because we don't want to include tags) */
                                    if ($this->setting->get('check_capitals_enabled') && $this->model_main_form->hasCapitals($this->request->post['cmtx_comment'])) {
                                        if ($this->setting->get('check_capitals_action') == 'error') {
                                            $json['error']['comment'] = $this->data['lang_error_comment_has_capitals'];
                                        } else if ($this->setting->get('check_capitals_action') == 'approve') {
                                            $approve .= $this->data['lang_error_comment_has_capitals'] . "\r\n";
                                        } else {
                                            $json['result']['error'] = $this->data['lang_error_ban'];

                                            $this->user->ban($ip_address, $this->data['lang_error_comment_has_capitals']);
                                        }
                                    }

                                    /* Convert web links (non-BB code) to HTML */
                                    if ($this->setting->get('comment_convert_links')) {
                                        $this->request->post['cmtx_comment'] = $this->model_main_form->convertLinks($this->request->post['cmtx_comment']);
                                    }

                                    /* Convert email links (non-BB code) to HTML */
                                    if ($this->setting->get('comment_convert_emails')) {
                                        $this->request->post['cmtx_comment'] = $this->model_main_form->convertEmails($this->request->post['cmtx_comment']);
                                    }

                                    /* Wrap each line in a paragraph tag */
                                    if ($this->setting->get('comment_line_breaks')) {
                                        $this->request->post['cmtx_comment'] = $this->model_main_form->addLineBreaks($this->request->post['cmtx_comment']);
                                    } else {
                                        $this->request->post['cmtx_comment'] = $this->model_main_form->removeLineBreaks($this->request->post['cmtx_comment']);
                                    }

                                    /* Purify the comment. Ensures properly balanced tags and neutralizes attacks. */
                                    $this->request->post['cmtx_comment'] = $this->model_main_form->purifyComment($this->request->post['cmtx_comment']);

                                    /* Finally remove any space at beginning and end */
                                    $this->request->post['cmtx_comment'] = trim($this->request->post['cmtx_comment']);

                                    /* Check comment length exceeds minimum */
                                    if ($this->model_main_form->getCommentDisplayLength($this->request->post['cmtx_comment']) < $this->setting->get('comment_minimum_characters')) {
                                        $json['error']['comment'] = $this->data['lang_error_comment_min_length'];
                                    }
                                } else {
                                    $json['error']['comment'] = $this->data['lang_error_comment_empty'];
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
                                if ($this->setting->get('enabled_email')) {
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
                                    } else if ($this->setting->get('required_email')) {
                                        $json['error']['email'] = $this->data['lang_error_email_empty'];
                                    } else {
                                        $this->request->post['cmtx_email'] = '';
                                    }
                                } else {
                                    $this->request->post['cmtx_email'] = '';
                                }

                                /* User */
                                if (isset($this->request->post['cmtx_name']) && $this->request->post['cmtx_name'] != '') {
                                    if (isset($this->request->post['cmtx_email']) && $this->request->post['cmtx_email'] != '') {
                                        $user = $this->user->getUserByNameAndEmail($this->request->post['cmtx_name'], $this->request->post['cmtx_email']);

                                        if (!$user) {
                                            if ($this->user->userExistsByEmail($this->request->post['cmtx_email'])) {
                                                $json['error']['email'] = $this->data['lang_error_email_partial'];
                                            }
                                        }
                                    } else {
                                        $user = $this->user->getUserByNameAndNoEmail($this->request->post['cmtx_name']);
                                    }

                                    if (!$user) {
                                        if ($this->setting->get('unique_name_enabled')) {
                                            if ($this->user->userExistsByName($this->request->post['cmtx_name'])) {
                                                $json['error']['name'] = $this->data['lang_error_name_partial'];
                                            }
                                        }
                                    }
                                }

                                /* Rating */
                                if ($this->setting->get('enabled_rating')) {
                                    if ($this->setting->get('repeat_rating') == 'hide' && $this->model_main_form->hasUserRated($page_id, $ip_address)) {
                                        $this->request->post['cmtx_rating'] = 0;

                                        $json['hide_rating'] = true;
                                    } else {
                                        if (isset($this->request->post['cmtx_rating']) && $this->request->post['cmtx_rating'] != '') {
                                            $rating = $this->security->decode($this->request->post['cmtx_rating']);

                                            if (!$this->model_main_form->isRatingValid($rating)) {
                                                $json['error']['rating'] = $this->data['lang_error_rating_invalid'];
                                            } else if ($this->setting->get('repeat_rating') == 'hide') {
                                                $json['hide_rating'] = true;
                                            }
                                        } else if ($this->setting->get('required_rating')) {
                                            $json['error']['rating'] = $this->data['lang_error_rating_empty'];
                                        } else {
                                            $this->request->post['cmtx_rating'] = 0;
                                        }
                                    }
                                } else {
                                    $this->request->post['cmtx_rating'] = 0;
                                }

                                /* Website */
                                if ($this->setting->get('enabled_website')) {
                                    if (isset($this->request->post['cmtx_website']) && $this->request->post['cmtx_website'] != '') {
                                        $scheme = parse_url($this->request->post['cmtx_website'], PHP_URL_SCHEME);

                                        if ($scheme != 'http' && $scheme != 'https') {
                                            $this->request->post['cmtx_website'] = 'http://' . $this->request->post['cmtx_website'];
                                        }

                                        $website = $this->security->decode($this->request->post['cmtx_website']);

                                        if ($this->setting->get('approve_websites')) {
                                            $approve .= $this->data['lang_error_website_approve'] . "\r\n";
                                        }

                                        if (!$this->validation->isUrl($website)) {
                                            $json['error']['website'] = $this->data['lang_error_website_invalid'];
                                        } else if ($this->setting->get('validate_website_ping') && !$this->model_main_form->canPingWebsite($website)) {
                                            $json['error']['website'] = $this->data['lang_error_website_ping'];
                                        }

                                        if ($this->validation->length($website) < 1 || $this->validation->length($website) > $this->setting->get('maximum_website')) {
                                            $json['error']['website'] = sprintf($this->data['lang_error_length'], 1, $this->setting->get('maximum_website'));
                                        }

                                        if ($this->setting->get('reserved_websites_enabled') && !$is_admin && $this->model_main_form->hasWord($website, 'reserved_websites', false)) {
                                            if ($this->setting->get('reserved_websites_action') == 'error') {
                                                $json['error']['website'] = $this->data['lang_error_website_reserved'];
                                            } else if ($this->setting->get('reserved_websites_action') == 'approve') {
                                                $approve .= $this->data['lang_error_website_reserved'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_website_reserved']);
                                            }
                                        }

                                        if ($this->setting->get('dummy_websites_enabled') && $this->model_main_form->hasWord($website, 'dummy_websites', false)) {
                                            if ($this->setting->get('dummy_websites_action') == 'error') {
                                                $json['error']['website'] = $this->data['lang_error_website_dummy'];
                                            } else if ($this->setting->get('dummy_websites_action') == 'approve') {
                                                $approve .= $this->data['lang_error_website_dummy'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_website_dummy']);
                                            }
                                        }

                                        if ($this->setting->get('banned_websites_as_website_enabled') && $this->model_main_form->hasWord($website, 'banned_websites', false)) {
                                            if ($this->setting->get('banned_websites_as_website_action') == 'error') {
                                                $json['error']['website'] = $this->data['lang_error_website_banned'];
                                            } else if ($this->setting->get('banned_websites_as_website_action') == 'approve') {
                                                $approve .= $this->data['lang_error_website_banned'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_website_banned']);
                                            }
                                        }
                                    } else if ($this->setting->get('required_website')) {
                                        $json['error']['website'] = $this->data['lang_error_website_empty'];
                                    } else {
                                        $this->request->post['cmtx_website'] = '';
                                    }
                                } else {
                                    $this->request->post['cmtx_website'] = '';
                                }

                                /* Town */
                                if ($this->setting->get('enabled_town')) {
                                    if (isset($this->request->post['cmtx_town']) && $this->request->post['cmtx_town'] != '') {
                                        $town = $this->security->decode($this->request->post['cmtx_town']);

                                        if (!$this->model_main_form->isTownValid($town)) {
                                            $json['error']['town'] = $this->data['lang_error_town_invalid'];
                                        }

                                        if (!$this->model_main_form->startsWithLetter($town)) {
                                            $json['error']['town'] = $this->data['lang_error_town_start'];
                                        }

                                        if ($this->validation->length($town) < 1 || $this->validation->length($town) > $this->setting->get('maximum_town')) {
                                            $json['error']['town'] = sprintf($this->data['lang_error_length'], 1, $this->setting->get('maximum_town'));
                                        }

                                        if ($this->setting->get('fix_town_enabled')) {
                                            $this->request->post['cmtx_town'] = $this->variable->fixCase($this->request->post['cmtx_town']);
                                        }

                                        if ($this->setting->get('detect_link_in_town_enabled') && $this->model_main_form->hasLink($town)) {
                                            if ($this->setting->get('link_in_town_action') == 'error') {
                                                $json['error']['town'] = $this->data['lang_error_town_has_link'];
                                            } else if ($this->setting->get('link_in_town_action') == 'approve') {
                                                $approve .= $this->data['lang_error_town_has_link'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_town_has_link']);
                                            }
                                        }

                                        if ($this->setting->get('reserved_towns_enabled') && !$is_admin && $this->model_main_form->hasWord($town, 'reserved_towns')) {
                                            if ($this->setting->get('reserved_towns_action') == 'error') {
                                                $json['error']['town'] = $this->data['lang_error_town_reserved'];
                                            } else if ($this->setting->get('reserved_towns_action') == 'approve') {
                                                $approve .= $this->data['lang_error_town_reserved'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_town_reserved']);
                                            }
                                        }

                                        if ($this->setting->get('dummy_towns_enabled') && $this->model_main_form->hasWord($town, 'dummy_towns')) {
                                            if ($this->setting->get('dummy_towns_action') == 'error') {
                                                $json['error']['town'] = $this->data['lang_error_town_dummy'];
                                            } else if ($this->setting->get('dummy_towns_action') == 'approve') {
                                                $approve .= $this->data['lang_error_town_dummy'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_town_dummy']);
                                            }
                                        }

                                        if ($this->setting->get('banned_towns_enabled') && $this->model_main_form->hasWord($town, 'banned_towns')) {
                                            if ($this->setting->get('banned_towns_action') == 'error') {
                                                $json['error']['town'] = $this->data['lang_error_town_banned'];
                                            } else if ($this->setting->get('banned_towns_action') == 'approve') {
                                                $approve .= $this->data['lang_error_town_banned'] . "\r\n";
                                            } else {
                                                $json['result']['error'] = $this->data['lang_error_ban'];

                                                $this->user->ban($ip_address, $this->data['lang_error_town_banned']);
                                            }
                                        }
                                    } else if ($this->setting->get('required_town')) {
                                        $json['error']['town'] = $this->data['lang_error_town_empty'];
                                    } else {
                                        $this->request->post['cmtx_town'] = '';
                                    }
                                } else {
                                    $this->request->post['cmtx_town'] = '';
                                }

                                /* Country */
                                if ($this->setting->get('enabled_country')) {
                                    if (isset($this->request->post['cmtx_country']) && $this->request->post['cmtx_country'] != '') {
                                        $country = $this->security->decode($this->request->post['cmtx_country']);

                                        if (!$this->geo->countryValid($country)) {
                                            $json['error']['country'] = $this->data['lang_error_country_invalid'];
                                        }
                                    } else if ($this->setting->get('required_country')) {
                                        $json['error']['country'] = $this->data['lang_error_country_empty'];
                                    } else {
                                        $this->request->post['cmtx_country'] = 0;
                                    }
                                } else {
                                    $this->request->post['cmtx_country'] = 0;
                                }

                                /* State */
                                if ($this->setting->get('enabled_state')) {
                                    if (isset($this->request->post['cmtx_state']) && $this->request->post['cmtx_state'] != '') {
                                        $state = $this->security->decode($this->request->post['cmtx_state']);

                                        if (!$this->geo->stateValid($state, $country)) {
                                            $json['error']['state'] = $this->data['lang_error_state_invalid'];
                                        }
                                    } else if ($this->setting->get('required_state')) {
                                        $json['error']['state'] = $this->data['lang_error_state_empty'];
                                    } else {
                                        $this->request->post['cmtx_state'] = 0;
                                    }
                                } else {
                                    $this->request->post['cmtx_state'] = 0;
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

                                /* Privacy */
                                if ($this->setting->get('enabled_privacy') && !isset($this->request->post['cmtx_privacy'])) {
                                    if (!$is_preview || ($is_preview && $this->setting->get('agree_to_preview'))) {
                                        $json['result']['error'] = $this->data['lang_error_agree_privacy'];
                                    }
                                }

                                /* Terms */
                                if ($this->setting->get('enabled_terms') && !isset($this->request->post['cmtx_terms'])) {
                                    if (!$is_preview || ($is_preview && $this->setting->get('agree_to_preview'))) {
                                        $json['result']['error'] = $this->data['lang_error_agree_terms'];
                                    }
                                }

                                /* Reply */
                                if ($this->setting->get('show_reply') && isset($this->request->post['cmtx_reply_to']) && $this->request->post['cmtx_reply_to']) {
                                    if (!$this->comment->commentExists($this->request->post['cmtx_reply_to'])) {
                                        $json['result']['error'] = $this->data['lang_error_reply_invalid'];
                                    }
                                } else {
                                    $this->request->post['cmtx_reply_to'] = 0;
                                }

                                /* Uploads */
                                if ($this->setting->get('enabled_upload') && isset($this->request->post['cmtx_upload']) && is_array($this->request->post['cmtx_upload'])) {
                                    if (!$json || ($json && (!isset($json['result']['error']) && !isset($json['error'])))) {
                                        if (count($this->request->post['cmtx_upload']) > $this->setting->get('maximum_upload_amount')) {
                                            $json['result']['error'] = sprintf($this->data['lang_error_image_amount'], $this->setting->get('maximum_upload_amount'));
                                        } else if (!$is_preview) { // don't upload if only a preview
                                            foreach ($this->request->post['cmtx_upload'] as $base64) {
                                                $result = $this->model_main_form->createImageFromBase64($base64);

                                                if (is_array($result)) {
                                                    $uploads[] = $result;
                                                } else {
                                                    $json['result']['error'] = $result;
                                                }
                                            }

                                            if ($this->setting->get('approve_uploads') && $uploads) {
                                                $approve .= $this->data['lang_error_comment_has_upload'] . "\r\n";
                                            }
                                        }
                                    }
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

            if ($json && (isset($json['result']['error']) || isset($json['error']))) {
                if (isset($json['result']['error'])) {
                    $json['error'] = '';
                } else {
                    $json['result']['error'] = $this->data['lang_error_review'];
                }
            } else {
                if ($is_preview) {
                    $this->loadLanguage('main/comments');

                    $this->loadModel('main/comments');

                    $reply_depth = 0;

                    $show_bio = false;

                    $show_gravatar      = $this->setting->get('show_gravatar');
                    $show_level         = $this->setting->get('show_level');
                    $show_rating        = $this->setting->get('show_rating');
                    $show_website       = $this->setting->get('show_website');
                    $website_new_window = $this->setting->get('website_new_window');
                    $website_no_follow  = $this->setting->get('website_no_follow');
                    $show_says          = $this->setting->get('show_says');
                    $show_date          = $this->setting->get('show_date');
                    $date_auto          = $this->setting->get('date_auto');

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

                    $comment_post = $this->model_main_comments->purifyComment($comment_post);

                    $date_added = $this->data['lang_text_today'];

                    if ($this->setting->get('date_auto')) {
                        $date_added_title = $this->data['lang_text_timeago_second'] . ' ' . $this->data['lang_text_timeago_ago'];
                    } else {
                        $date_added_title = '';
                    }

                    $comment = array(
                        'id'               => 0,
                        'gravatar'         => '//www.gravatar.com/avatar/' . md5(strtolower(trim($this->request->post['cmtx_email']))) . '?d=' . ($this->setting->get('gravatar_default') == 'custom' ? $this->url->encode($this->setting->get('gravatar_custom')) : $this->setting->get('gravatar_default')) . '&amp;r=' . $this->setting->get('gravatar_rating') . '&amp;s=' . $this->setting->get('gravatar_size'),
                        'level'            => $this->data['lang_text_preview'],
                        'name'             => $this->request->post['cmtx_name'],
                        'website'          => $this->request->post['cmtx_website'],
                        'location'         => $location,
                        'is_sticky'        => false,
                        'rating'           => $this->request->post['cmtx_rating'],
                        'comment'          => $comment_post,
                        'is_admin'         => $is_admin,
                        'date_added'       => $date_added,
                        'date_added_title' => $date_added_title,
                        'uploads'          => false,
                        'reply'            => false,
                        'reply_id'         => array()
                    );

                    extract($this->data);

                    ob_start();

                    require $this->loadTemplate('main/comment');

                    $json['result']['preview'] = ob_get_clean();
                } else {
                    if ($user) {
                        $user_token = $user['token'];

                        $user_id = $user['id'];
                    } else {
                        $user_token = $this->variable->random();

                        $user_id = $this->user->createUser($this->request->post['cmtx_name'], $this->request->post['cmtx_email'], $user_token, $ip_address);
                    }

                    /* Determine if the comment needs to be approved by the administrator */
                    if ($is_admin) { // admin comments don't need to be approved
                        $approve = '';

                        $notes = $this->data['lang_text_moderate_admin'];
                    } else if ($user && $user['moderate'] == 'always') { // the user's moderation setting has secondary precedence
                        $approve = $this->data['lang_text_moderate_user_y'];
                    } else if ($user && $user['moderate'] == 'never') {
                        $approve = '';

                        $notes = $this->data['lang_text_moderate_user_n'];
                    } else if ($page['moderate'] == 'always') {
                        $approve = $this->data['lang_text_moderate_page_y'];
                    } else if ($page['moderate'] == 'never') {
                        $approve = '';

                        $notes = $this->data['lang_text_moderate_page_n'];
                    } else if ($approve) {

                    } else if ($this->setting->get('approve_comments')) {
                        if ($user && $this->setting->get('trust_previous_users')) {
                            if ($this->model_main_form->hasUserPreviouslyPostedApprovedComment($user['id'])) {
                                $approve = '';

                                $notes = $this->data['lang_text_moderate_user_previous'];
                            } else {
                                $approve = $this->data['lang_text_moderate_all'];
                            }
                        } else {
                            $approve = $this->data['lang_text_moderate_all'];
                        }
                    } else if ($this->setting->has('akismet_enabled') && $this->setting->get('akismet_enabled') && extension_loaded('curl')) {
                        if ($this->model_main_form->isAkismetSpam($ip_address, $page['url'], $this->request->post['cmtx_name'], $this->request->post['cmtx_email'], $this->request->post['cmtx_website'], $this->request->post['cmtx_comment'])) {
                            $approve = $this->data['lang_text_moderate_akismet_y'];
                        } else {
                            $approve = '';

                            $notes = $this->data['lang_text_moderate_akismet_n'];
                        }
                    }

                    if ($approve) {
                        $notes = rtrim($approve, "\r\n");
                    }

                    $comment_id = $this->comment->createComment($user_id, $page_id, $this->request->post['cmtx_website'], $this->request->post['cmtx_town'], $this->request->post['cmtx_state'], $this->request->post['cmtx_country'], $this->request->post['cmtx_rating'], $this->request->post['cmtx_reply_to'], $this->request->post['cmtx_comment'], $ip_address, $approve, $notes, $is_admin, $uploads);

                    if ($this->setting->get('cache_type')) {
                        $this->cache->delete('getcomments_pageid' . $page_id . '_count0');
                        $this->cache->delete('getcomments_pageid' . $page_id . '_count1');

                        /* If the comment is a reply, we need to clear the cache of the parent comments */
                        if ($this->request->post['cmtx_reply_to']) {
                            $parent_ids = $this->comment->getParents($comment_id);

                            foreach ($parent_ids as $parent_id) {
                                $this->cache->delete('getcomment_commentid' . $parent_id . '_' . $this->setting->get('language'));
                            }
                        }

                        if ($this->request->post['cmtx_rating']) {
                            $this->cache->delete('getaveragerating_pageid' . $page_id);
                        }
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
                            $subscription_token = $this->variable->random();

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

                    if ($approve) {
                        $json['result']['success'] = $this->data['lang_text_comment_approve'];
                    } else {
                        $json['result']['success'] = $this->data['lang_text_comment_success'];
                    }
                }
            }

            echo json_encode($json);
        }
    }
}
