<?php
namespace Commentics;

class LayoutFormCaptchaModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_captcha']) ? 1 : 0) . "' WHERE `title` = 'enabled_captcha'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['captcha_type']) . "' WHERE `title` = 'captcha_type'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['recaptcha_public_key']) . "' WHERE `title` = 'recaptcha_public_key'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['recaptcha_private_key']) . "' WHERE `title` = 'recaptcha_private_key'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['recaptcha_theme']) . "' WHERE `title` = 'recaptcha_theme'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['recaptcha_size']) . "' WHERE `title` = 'recaptcha_size'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['securimage_width'] . "' WHERE `title` = 'securimage_width'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['securimage_height'] . "' WHERE `title` = 'securimage_height'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['securimage_length'] . "' WHERE `title` = 'securimage_length'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (float) $data['securimage_perturbation'] . "' WHERE `title` = 'securimage_perturbation'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['securimage_lines'] . "' WHERE `title` = 'securimage_lines'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['securimage_noise'] . "' WHERE `title` = 'securimage_noise'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['securimage_text_color']) . "' WHERE `title` = 'securimage_text_color'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['securimage_line_color']) . "' WHERE `title` = 'securimage_line_color'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['securimage_back_color']) . "' WHERE `title` = 'securimage_back_color'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['securimage_noise_color']) . "' WHERE `title` = 'securimage_noise_color'");
    }
}
