<?php
namespace Commentics;

class MainFormPrepareModel extends Model
{
    public function prepareComment($data)
    {
        $data['lang_tag_bb_code_bold'] = $data['lang_tag_bb_code_bold_start'] . '|' . $data['lang_tag_bb_code_bold_end'];
        $data['lang_tag_bb_code_italic'] = $data['lang_tag_bb_code_italic_start'] . '|' . $data['lang_tag_bb_code_italic_end'];
        $data['lang_tag_bb_code_underline'] = $data['lang_tag_bb_code_underline_start'] . '|' . $data['lang_tag_bb_code_underline_end'];
        $data['lang_tag_bb_code_strike'] = $data['lang_tag_bb_code_strike_start'] . '|' . $data['lang_tag_bb_code_strike_end'];
        $data['lang_tag_bb_code_superscript'] = $data['lang_tag_bb_code_superscript_start'] . '|' . $data['lang_tag_bb_code_superscript_end'];
        $data['lang_tag_bb_code_subscript'] = $data['lang_tag_bb_code_subscript_start'] . '|' . $data['lang_tag_bb_code_subscript_end'];
        $data['lang_tag_bb_code_code'] = $data['lang_tag_bb_code_code_start'] . '|' . $data['lang_tag_bb_code_code_end'];
        $data['lang_tag_bb_code_php'] = $data['lang_tag_bb_code_php_start'] . '|' . $data['lang_tag_bb_code_php_end'];
        $data['lang_tag_bb_code_quote'] = $data['lang_tag_bb_code_quote_start'] . '|' . $data['lang_tag_bb_code_quote_end'];
        $data['lang_tag_bb_code_bullet'] = $data['lang_tag_bb_code_bullet_1'] . '|' . $data['lang_tag_bb_code_bullet_2'] . '|' . $data['lang_tag_bb_code_bullet_3'] . '|' . $data['lang_tag_bb_code_bullet_4'];
        $data['lang_tag_bb_code_numeric'] = $data['lang_tag_bb_code_numeric_1'] . '|' . $data['lang_tag_bb_code_numeric_2'] . '|' . $data['lang_tag_bb_code_numeric_3'] . '|' . $data['lang_tag_bb_code_numeric_4'];
        $data['lang_tag_bb_code_link'] = $data['lang_tag_bb_code_link_1'] . '|' . $data['lang_tag_bb_code_link_2'] . '|' . $data['lang_tag_bb_code_link_3'] . '|' . $data['lang_tag_bb_code_link_4'];
        $data['lang_tag_bb_code_email'] = $data['lang_tag_bb_code_email_1'] . '|' . $data['lang_tag_bb_code_email_2'] . '|' . $data['lang_tag_bb_code_email_3'] . '|' . $data['lang_tag_bb_code_email_4'];
        $data['lang_tag_bb_code_image'] = $data['lang_tag_bb_code_image_1'] . '|' . $data['lang_tag_bb_code_image_2'];
        $data['lang_tag_bb_code_youtube'] = $data['lang_tag_bb_code_youtube_1'] . '|' . $data['lang_tag_bb_code_youtube_2'];

        return $data;
    }

    public function prepareHeading($data)
    {
        $data['headline_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_headline') ? 'cmtx_required' : '');

        return $data;
    }

    public function prepareRating($data)
    {
        if ($this->setting->get('repeat_rating') == 'hide' && $this->model_main_form->hasUserRated($this->page->getId(), $this->user->getIpAddress())) {
            $this->setting->set('enabled_rating', false);
        }

        $data['rating_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_rating') ? 'cmtx_required' : '');

        $default_rating = $this->setting->get('default_rating');

        if ($default_rating == '1') {
            $data['rating_1_checked'] = 'checked';
        } else {
            $data['rating_1_checked'] = '';
        }

        if ($default_rating == '2') {
            $data['rating_2_checked'] = 'checked';
        } else {
            $data['rating_2_checked'] = '';
        }

        if ($default_rating == '3') {
            $data['rating_3_checked'] = 'checked';
        } else {
            $data['rating_3_checked'] = '';
        }

        if ($default_rating == '4') {
            $data['rating_4_checked'] = 'checked';
        } else {
            $data['rating_4_checked'] = '';
        }

        if ($default_rating == '5') {
            $data['rating_5_checked'] = 'checked';
        } else {
            $data['rating_5_checked'] = '';
        }

        return $data;
    }

    public function prepareName($data, $cookie)
    {
        $data['enabled_name'] = true;

        $data['name_is_filled'] = false;

        $data['filled_name_action'] = 'normal';

        /* The precedence is login info, cookie and default */
        if ($this->user->getLogin('name')) {
            $data['name'] = $this->user->getLogin('name');

            $data['name_is_filled'] = true;

            $data['filled_name_action'] = $this->setting->get('filled_name_login_action');
        } else if ($cookie['name']) {
            $data['name'] = $cookie['name'];

            $data['name_is_filled'] = true;

            $data['filled_name_action'] = $this->setting->get('filled_name_cookie_action');
        } else {
            $data['name'] = $this->setting->get('default_name');
        }

        if ($data['name_is_filled'] && $data['filled_name_action'] == 'disable') {
            $data['name_readonly'] = 'readonly';
        } else {
            $data['name_readonly'] = '';
        }

        $data['name_symbol'] = ($this->setting->get('display_required_symbol') ? 'cmtx_required' : '');

        return $data;
    }

    public function prepareEmail($data, $cookie)
    {
        $data['email_is_filled'] = false;

        $data['filled_email_action'] = 'normal';

        if ($this->user->getLogin('email')) {
            $data['email'] = $this->user->getLogin('email');

            $data['email_is_filled'] = true;

            $data['filled_email_action'] = $this->setting->get('filled_email_login_action');
        } else if ($cookie['email']) {
            $data['email'] = $cookie['email'];

            $data['email_is_filled'] = true;

            $data['filled_email_action'] = $this->setting->get('filled_email_cookie_action');
        } else {
            $data['email'] = $this->setting->get('default_email');
        }

        if ($data['email_is_filled'] && $data['filled_email_action'] == 'disable') {
            $data['email_readonly'] = 'readonly';
        } else {
            $data['email_readonly'] = '';
        }

        $data['email_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_email') ? 'cmtx_required' : '');

        return $data;
    }

    public function prepareUser($data)
    {
        if ($data['name_is_filled'] && $data['filled_name_action'] == 'hide') {
            $data['enabled_name'] = false;

            $data['hidden_data'] .= '&cmtx_name=' . $this->url->encode($data['name']);
        }

        if ($data['email_is_filled'] && $data['filled_email_action'] == 'hide') {
            $this->setting->set('enabled_email', false);

            $data['hidden_data'] .= '&cmtx_email=' . $this->url->encode($data['email']);
        }

        $user_columns = (int) $data['enabled_name'] + (int) $this->setting->get('enabled_email');

        if ($user_columns) {
            $user_row_visible = true;
            $data['user_row_visible'] = '';
        } else {
            $user_row_visible = false;
            $data['user_row_visible'] = 'cmtx_hide';
        }

        if ($user_columns == 2) {
            $data['name_spacing'] = 'cmtx_name_spacing';
        } else {
            $data['name_spacing'] = '';
        }

        $data['cmtx_wait_for_comment'] = $data['cmtx_wait_for_user'] = '';

        if ($this->setting->get('hide_form')) {
            $data['cmtx_wait_for_comment'] = 'cmtx_wait_for_comment';

            if ($user_row_visible) {
                $data['cmtx_wait_for_user'] = 'cmtx_wait_for_user';
            }
        }

        /* We don't want the user to have to click into the name/email fields if they're already filled */

        if (($data['enabled_name'] && $data['name_is_filled']) && (!$this->setting->get('enabled_email') || $this->setting->get('enabled_email') && $data['email_is_filled'])) {
            $data['cmtx_wait_for_user'] = '';
        }

        if ((!$data['enabled_name']) && (!$this->setting->get('enabled_email') || $this->setting->get('enabled_email') && $data['email_is_filled'])) {
            $data['cmtx_wait_for_user'] = '';
        }

        switch ($user_columns) {
            case '1':
                $data['user_column_size'] = '12';
                break;
            case '2':
                $data['user_column_size'] = '6';
                break;
            default:
                $data['user_column_size'] = '6';
        }

        return $data;
    }

    public function prepareWebsite($data, $cookie)
    {
        $data['website_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_website') ? 'cmtx_required' : '');

        $data['website_is_filled'] = false;

        $data['filled_website_action'] = 'normal';

        if ($this->user->getLogin('website')) {
            $data['website'] = $this->user->getLogin('website');

            $data['website_is_filled'] = true;

            $data['filled_website_action'] = $this->setting->get('filled_website_login_action');
        } else if ($cookie['website']) {
            $data['website'] = $cookie['website'];

            $data['website_is_filled'] = true;

            $data['filled_website_action'] = $this->setting->get('filled_website_cookie_action');
        } else {
            $data['website'] = $this->setting->get('default_website');
        }

        if ($data['website_is_filled'] && $data['filled_website_action'] == 'disable') {
            $data['website_readonly'] = 'readonly';
        } else {
            $data['website_readonly'] = '';
        }

        if ($data['website_is_filled'] && $data['filled_website_action'] == 'hide') {
            $this->setting->set('enabled_website', false);

            $data['hidden_data'] .= '&cmtx_website=' . $this->url->encode($data['website']);
        }

        return $data;
    }

    public function prepareTown($data, $cookie)
    {
        $data['town_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_town') ? 'cmtx_required' : '');

        $data['town_is_filled'] = false;

        $data['filled_town_action'] = 'normal';

        if ($this->user->getLogin('town')) {
            $data['town'] = $this->user->getLogin('town');

            $data['town_is_filled'] = true;

            $data['filled_town_action'] = $this->setting->get('filled_town_login_action');
        } else if ($cookie['town']) {
            $data['town'] = $cookie['town'];

            $data['town_is_filled'] = true;

            $data['filled_town_action'] = $this->setting->get('filled_town_cookie_action');
        } else {
            $data['town'] = $this->setting->get('default_town');
        }

        if ($data['town_is_filled'] && $data['filled_town_action'] == 'disable') {
            $data['town_readonly'] = 'readonly';
        } else {
            $data['town_readonly'] = '';
        }

        return $data;
    }

    public function prepareCountry($data, $cookie)
    {
        $data['country_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_country') ? 'cmtx_required' : '');

        $data['countries'] = array();

        $data['country_is_filled'] = false;

        $data['filled_country_action'] = 'normal';

        if ($this->user->getLogin('country')) {
            $data['country_id'] = $this->user->getLogin('country');

            $data['country_is_filled'] = true;

            $data['filled_country_action'] = $this->setting->get('filled_country_login_action');
        } else if ($cookie['country']) {
            $data['country_id'] = $cookie['country'];

            $data['country_is_filled'] = true;

            $data['filled_country_action'] = $this->setting->get('filled_country_cookie_action');
        } else {
            $data['country_id'] = $this->setting->get('default_country');
        }

        if ($data['country_is_filled'] && $data['filled_country_action'] == 'disable') {
            $data['country_disabled'] = 'disabled';
        } else {
            $data['country_disabled'] = '';
        }

        return $data;
    }

    public function prepareState($data, $cookie)
    {
        $data['state_symbol'] = ($this->setting->get('display_required_symbol') && $this->setting->get('required_state') ? 'cmtx_required' : '');

        $data['states'] = array();

        $data['state_is_filled'] = false;

        $data['filled_state_action'] = 'normal';

        if ($this->user->getLogin('state')) {
            $data['state_id'] = $this->user->getLogin('state');

            $data['state_is_filled'] = true;

            $data['filled_state_action'] = $this->setting->get('filled_state_login_action');
        } else if ($cookie['state']) {
            $data['state_id'] = $cookie['state'];

            $data['state_is_filled'] = true;

            $data['filled_state_action'] = $this->setting->get('filled_state_cookie_action');
        } else {
            $data['state_id'] = $this->setting->get('default_state');
        }

        if ($data['state_is_filled'] && $data['filled_state_action'] == 'disable') {
            $data['state_disabled'] = 'disabled';
        } else {
            $data['state_disabled'] = '';
        }

        return $data;
    }

    public function prepareGeo($data)
    {
        if ($this->setting->get('enabled_town') && $data['town_is_filled'] && $data['filled_town_action'] == 'hide') {
            $this->setting->set('enabled_town', false);

            $data['hidden_data'] .= '&cmtx_town=' . $this->url->encode($data['town']);
        }

        if ($this->setting->get('enabled_country') && $data['country_is_filled'] && $data['filled_country_action'] == 'hide') {
            $this->setting->set('enabled_country', false);

            $data['hidden_data'] .= '&cmtx_country=' . $this->url->encode($data['country_id']);
        }

        if ($this->setting->get('enabled_state') && $data['state_is_filled'] && $data['filled_state_action'] == 'hide') {
            $this->setting->set('enabled_state', false);

            $data['hidden_data'] .= '&cmtx_state=' . $this->url->encode($data['state_id']);
        }

        $geo_columns = (int) $this->setting->get('enabled_town') + (int) $this->setting->get('enabled_country') + (int) $this->setting->get('enabled_state');

        if ($geo_columns) {
            $geo_row_visible = true;
        } else {
            $geo_row_visible = false;
        }

        if (!$geo_row_visible) {
            $data['geo_row_visible'] = 'cmtx_hide';
        } else {
            $data['geo_row_visible'] = $data['cmtx_wait_for_user'];
        }

        switch ($geo_columns) {
            case '1':
                $data['geo_column_size'] = '12';
                break;
            case '2':
                $data['geo_column_size'] = '6';
                break;
            case '3':
                $data['geo_column_size'] = '4';
                break;
            default:
                $data['geo_column_size'] = '4';
        }

        return $data;
    }

    public function prepareQuestion($data)
    {
        $data['question'] = false;

        if ($this->setting->get('enabled_question')) {
            $question = $this->model_main_form->getQuestion();

            if ($question) {
                $this->session->data['cmtx_question_id_' . $this->page->getId()] = $question['id'];

                $data['question'] = $question['question'];
            }
        }

        return $data;
    }

    public function prepareExtraFields($data)
    {
        $data['fields'] = array();

        $fields = explode(',', $this->setting->get('order_fields'));

        foreach ($fields as $field) {
            /* Try to extract ID portion in case it's an extra field (such as field_1, field_2 etc) */
            $field_id = $this->variable->substr($field, 6, strlen($field));

            /* If we found an ID and it's an int then it's an extra field and we need to add more info to it */
            if ($field_id && $this->validation->isInt($field_id)) {
                $field_info = $this->model_main_form->getExtraField($field_id);

                if ($field_info) {
                    $field_info['template'] = 'extra';
                    $field_info['values'] = explode(',', $field_info['values']);
                    $field_info['symbol'] = ($this->setting->get('display_required_symbol') && $field_info['is_required'] ? 'cmtx_required' : '');

                    $data['fields'][$field] = $field_info;
                }
            } else {
                $data['fields'][$field] = array('template' => $field);
            }
        }

        return $data;
    }

    public function prepareReCaptcha($data)
    {
        if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'recaptcha' && (bool) ini_get('allow_url_fopen')) {
            $data['recaptcha'] = true;
        } else {
            $data['recaptcha'] = false;
        }

        return $data;
    }

    public function prepareCaptcha($data)
    {
        if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'image' && extension_loaded('gd') && function_exists('imagettftext') && is_callable('imagettftext')) {
            $data['captcha'] = true;

            $data['captcha_url'] = $this->setting->get('commentics_url') . 'frontend/index.php?route=main/form/captcha&page_id=' . $this->page->getId();
        } else {
            $data['captcha'] = false;

            $data['captcha_url'] = '';
        }

        return $data;
    }

    public function prepareNotify($data)
    {
        $this->setting->get('default_notify') ? $data['notify_checked'] = 'checked' : $data['notify_checked'] = '';

        return $data;
    }

    public function prepareCookie($data)
    {
        $this->setting->get('default_cookie') ? $data['cookie_checked'] = 'checked' : $data['cookie_checked'] = '';

        return $data;
    }

    public function preparePoweredBy($data)
    {
        if ($this->setting->get('enabled_powered_by')) {
            if ($this->setting->get('powered_by_type') == 'text') {
                $data['powered_by'] = sprintf($data['lang_text_powered_by'], 'https://commentics.com', $this->setting->get('powered_by_new_window') ? 'target="_blank"' : '');
            } else {
                $data['powered_by'] = '<a href="https://commentics.com" title="Commentics" ' . ($this->setting->get('powered_by_new_window') ? 'target="_blank"' : '') . '><img src="' . $this->loadImage('commentics/powered_by.png') . '"></a>';
            }
        }

        return $data;
    }
}
