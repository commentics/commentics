<?php
namespace Commentics;

class LayoutFormCaptchaController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/captcha');

        $this->loadModel('layout_form/captcha');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_captcha->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_captcha'])) {
            $this->data['enabled_captcha'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_captcha'])) {
            $this->data['enabled_captcha'] = false;
        } else {
            $this->data['enabled_captcha'] = $this->setting->get('enabled_captcha');
        }

        if (isset($this->request->post['captcha_type'])) {
            $this->data['captcha_type'] = $this->request->post['captcha_type'];
        } else {
            $this->data['captcha_type'] = $this->setting->get('captcha_type');
        }

        if (isset($this->request->post['recaptcha_public_key'])) {
            $this->data['recaptcha_public_key'] = $this->request->post['recaptcha_public_key'];
        } else {
            $this->data['recaptcha_public_key'] = $this->setting->get('recaptcha_public_key');
        }

        if (isset($this->request->post['recaptcha_private_key'])) {
            $this->data['recaptcha_private_key'] = $this->request->post['recaptcha_private_key'];
        } else {
            $this->data['recaptcha_private_key'] = $this->setting->get('recaptcha_private_key');
        }

        if (isset($this->request->post['recaptcha_theme'])) {
            $this->data['recaptcha_theme'] = $this->request->post['recaptcha_theme'];
        } else {
            $this->data['recaptcha_theme'] = $this->setting->get('recaptcha_theme');
        }

        if (isset($this->request->post['recaptcha_size'])) {
            $this->data['recaptcha_size'] = $this->request->post['recaptcha_size'];
        } else {
            $this->data['recaptcha_size'] = $this->setting->get('recaptcha_size');
        }

        if (isset($this->request->post['securimage_width'])) {
            $this->data['securimage_width'] = $this->request->post['securimage_width'];
        } else {
            $this->data['securimage_width'] = $this->setting->get('securimage_width');
        }

        if (isset($this->request->post['securimage_height'])) {
            $this->data['securimage_height'] = $this->request->post['securimage_height'];
        } else {
            $this->data['securimage_height'] = $this->setting->get('securimage_height');
        }

        if (isset($this->request->post['securimage_length'])) {
            $this->data['securimage_length'] = $this->request->post['securimage_length'];
        } else {
            $this->data['securimage_length'] = $this->setting->get('securimage_length');
        }

        if (isset($this->request->post['securimage_perturbation'])) {
            $this->data['securimage_perturbation'] = $this->request->post['securimage_perturbation'];
        } else {
            $this->data['securimage_perturbation'] = $this->setting->get('securimage_perturbation');
        }

        if (isset($this->request->post['securimage_lines'])) {
            $this->data['securimage_lines'] = $this->request->post['securimage_lines'];
        } else {
            $this->data['securimage_lines'] = $this->setting->get('securimage_lines');
        }

        if (isset($this->request->post['securimage_noise'])) {
            $this->data['securimage_noise'] = $this->request->post['securimage_noise'];
        } else {
            $this->data['securimage_noise'] = $this->setting->get('securimage_noise');
        }

        if (isset($this->request->post['securimage_text_color'])) {
            $this->data['securimage_text_color'] = $this->request->post['securimage_text_color'];
        } else {
            $this->data['securimage_text_color'] = $this->setting->get('securimage_text_color');
        }

        if (isset($this->request->post['securimage_line_color'])) {
            $this->data['securimage_line_color'] = $this->request->post['securimage_line_color'];
        } else {
            $this->data['securimage_line_color'] = $this->setting->get('securimage_line_color');
        }

        if (isset($this->request->post['securimage_back_color'])) {
            $this->data['securimage_back_color'] = $this->request->post['securimage_back_color'];
        } else {
            $this->data['securimage_back_color'] = $this->setting->get('securimage_back_color');
        }

        if (isset($this->request->post['securimage_noise_color'])) {
            $this->data['securimage_noise_color'] = $this->request->post['securimage_noise_color'];
        } else {
            $this->data['securimage_noise_color'] = $this->setting->get('securimage_noise_color');
        }

        if (isset($this->error['captcha_type'])) {
            $this->data['error_captcha_type'] = $this->error['captcha_type'];
        } else {
            $this->data['error_captcha_type'] = '';
        }

        if (isset($this->error['recaptcha_public_key'])) {
            $this->data['error_recaptcha_public_key'] = $this->error['recaptcha_public_key'];
        } else {
            $this->data['error_recaptcha_public_key'] = '';
        }

        if (isset($this->error['recaptcha_private_key'])) {
            $this->data['error_recaptcha_private_key'] = $this->error['recaptcha_private_key'];
        } else {
            $this->data['error_recaptcha_private_key'] = '';
        }

        if (isset($this->error['recaptcha_theme'])) {
            $this->data['error_recaptcha_theme'] = $this->error['recaptcha_theme'];
        } else {
            $this->data['error_recaptcha_theme'] = '';
        }

        if (isset($this->error['recaptcha_size'])) {
            $this->data['error_recaptcha_size'] = $this->error['recaptcha_size'];
        } else {
            $this->data['error_recaptcha_size'] = '';
        }

        if (isset($this->error['securimage_width'])) {
            $this->data['error_securimage_width'] = $this->error['securimage_width'];
        } else {
            $this->data['error_securimage_width'] = '';
        }

        if (isset($this->error['securimage_height'])) {
            $this->data['error_securimage_height'] = $this->error['securimage_height'];
        } else {
            $this->data['error_securimage_height'] = '';
        }

        if (isset($this->error['securimage_length'])) {
            $this->data['error_securimage_length'] = $this->error['securimage_length'];
        } else {
            $this->data['error_securimage_length'] = '';
        }

        if (isset($this->error['securimage_perturbation'])) {
            $this->data['error_securimage_perturbation'] = $this->error['securimage_perturbation'];
        } else {
            $this->data['error_securimage_perturbation'] = '';
        }

        if (isset($this->error['securimage_lines'])) {
            $this->data['error_securimage_lines'] = $this->error['securimage_lines'];
        } else {
            $this->data['error_securimage_lines'] = '';
        }

        if (isset($this->error['securimage_noise'])) {
            $this->data['error_securimage_noise'] = $this->error['securimage_noise'];
        } else {
            $this->data['error_securimage_noise'] = '';
        }

        if (isset($this->error['securimage_text_color'])) {
            $this->data['error_securimage_text_color'] = $this->error['securimage_text_color'];
        } else {
            $this->data['error_securimage_text_color'] = '';
        }

        if (isset($this->error['securimage_line_color'])) {
            $this->data['error_securimage_line_color'] = $this->error['securimage_line_color'];
        } else {
            $this->data['error_securimage_line_color'] = '';
        }

        if (isset($this->error['securimage_back_color'])) {
            $this->data['error_securimage_back_color'] = $this->error['securimage_back_color'];
        } else {
            $this->data['error_securimage_back_color'] = '';
        }

        if (isset($this->error['securimage_noise_color'])) {
            $this->data['error_securimage_noise_color'] = $this->error['securimage_noise_color'];
        } else {
            $this->data['error_securimage_noise_color'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/captcha');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (isset($this->request->post['enabled_captcha']) && isset($this->request->post['captcha_type']) && $this->request->post['captcha_type'] == 'recaptcha' && !(bool) ini_get('allow_url_fopen')) {
            $this->data['error'] = $this->data['lang_error_fopen'];

            return false;
        }

        if (!isset($this->request->post['captcha_type']) || !in_array($this->request->post['captcha_type'], array('recaptcha', 'securimage'))) {
            $this->error['captcha_type'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['recaptcha_public_key']) || $this->validation->length($this->request->post['recaptcha_public_key']) > 250) {
            $this->error['recaptcha_public_key'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['recaptcha_private_key']) || $this->validation->length($this->request->post['recaptcha_private_key']) > 250) {
            $this->error['recaptcha_private_key'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['recaptcha_theme']) || !in_array($this->request->post['recaptcha_theme'], array('dark', 'light'))) {
            $this->error['recaptcha_theme'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['recaptcha_size']) || !in_array($this->request->post['recaptcha_size'], array('compact', 'normal'))) {
            $this->error['recaptcha_size'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['securimage_width']) || !$this->validation->isInt($this->request->post['securimage_width']) || $this->request->post['securimage_width'] < 1 || $this->request->post['securimage_width'] > 500) {
            $this->error['securimage_width'] = sprintf($this->data['lang_error_range'], 1, 500);
        }

        if (!isset($this->request->post['securimage_height']) || !$this->validation->isInt($this->request->post['securimage_height']) || $this->request->post['securimage_height'] < 1 || $this->request->post['securimage_height'] > 500) {
            $this->error['securimage_height'] = sprintf($this->data['lang_error_range'], 1, 500);
        }

        if (!isset($this->request->post['securimage_length']) || !$this->validation->isInt($this->request->post['securimage_length']) || $this->request->post['securimage_length'] < 1 || $this->request->post['securimage_length'] > 10) {
            $this->error['securimage_length'] = sprintf($this->data['lang_error_range'], 1, 10);
        }

        if (!isset($this->request->post['securimage_perturbation']) || !preg_match('/^[0|1]{1}\.[0-9]{1,2}$/i', $this->request->post['securimage_perturbation']) || $this->request->post['securimage_perturbation'] < 0 || $this->request->post['securimage_perturbation'] > 1) {
            $this->error['securimage_perturbation'] = sprintf($this->data['lang_error_perturbation'], 0.00, 1.00);
        }

        if (!isset($this->request->post['securimage_lines']) || !$this->validation->isInt($this->request->post['securimage_lines']) || $this->request->post['securimage_lines'] < 0 || $this->request->post['securimage_lines'] > 10) {
            $this->error['securimage_lines'] = sprintf($this->data['lang_error_range'], 0, 10);
        }

        if (!isset($this->request->post['securimage_noise']) || !$this->validation->isInt($this->request->post['securimage_noise']) || $this->request->post['securimage_noise'] < 0 || $this->request->post['securimage_noise'] > 10) {
            $this->error['securimage_noise'] = sprintf($this->data['lang_error_range'], 0, 10);
        }

        if (!isset($this->request->post['securimage_text_color']) || substr($this->request->post['securimage_text_color'], 0, 1) != '#' || !$this->validation->isHex(ltrim($this->request->post['securimage_text_color'], '#'))) {
            $this->error['securimage_text_color'] = $this->data['lang_error_hex_format'];
        }

        if (!isset($this->request->post['securimage_text_color']) || $this->validation->length($this->request->post['securimage_text_color']) != 7) {
            $this->error['securimage_text_color'] = $this->data['lang_error_hex_length'];
        }

        if (!isset($this->request->post['securimage_line_color']) || substr($this->request->post['securimage_line_color'], 0, 1) != '#' || !$this->validation->isHex(ltrim($this->request->post['securimage_line_color'], '#'))) {
            $this->error['securimage_line_color'] = $this->data['lang_error_hex_format'];
        }

        if (!isset($this->request->post['securimage_line_color']) || $this->validation->length($this->request->post['securimage_line_color']) != 7) {
            $this->error['securimage_line_color'] = $this->data['lang_error_hex_length'];
        }

        if (!isset($this->request->post['securimage_back_color']) || substr($this->request->post['securimage_back_color'], 0, 1) != '#' || !$this->validation->isHex(ltrim($this->request->post['securimage_back_color'], '#'))) {
            $this->error['securimage_back_color'] = $this->data['lang_error_hex_format'];
        }

        if (!isset($this->request->post['securimage_back_color']) || $this->validation->length($this->request->post['securimage_back_color']) != 7) {
            $this->error['securimage_back_color'] = $this->data['lang_error_hex_length'];
        }

        if (!isset($this->request->post['securimage_noise_color']) || substr($this->request->post['securimage_noise_color'], 0, 1) != '#' || !$this->validation->isHex(ltrim($this->request->post['securimage_noise_color'], '#'))) {
            $this->error['securimage_noise_color'] = $this->data['lang_error_hex_format'];
        }

        if (!isset($this->request->post['securimage_noise_color']) || $this->validation->length($this->request->post['securimage_noise_color']) != 7) {
            $this->error['securimage_noise_color'] = $this->data['lang_error_hex_length'];
        }

        if ($this->error) {
            $this->data['error'] = $this->data['lang_message_error'];

            return false;
        } else {
            $this->data['success'] = $this->data['lang_message_success'];

            return true;
        }
    }
}
