<?php
namespace Commentics;

class LayoutFormBbCodeModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_bold']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_bold'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_italic']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_italic'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_underline']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_underline'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_strike']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_strike'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_superscript']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_superscript'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_subscript']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_subscript'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_code']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_code'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_php']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_php'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_quote']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_quote'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_line']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_line'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_bullet']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_bullet'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_numeric']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_numeric'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_link']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_link'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_email']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_email'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_image']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_image'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_bb_code_youtube']) ? 1 : 0) . "' WHERE `title` = 'enabled_bb_code_youtube'");
    }

    public function getBbCode()
    {
        $bb_code = array();

        $bb_code['bold'] = $this->getImage('bold.png');

        $bb_code['italic'] = $this->getImage('italic.png');

        $bb_code['underline'] = $this->getImage('underline.png');

        $bb_code['strike'] = $this->getImage('strike.png');

        $bb_code['superscript'] = $this->getImage('superscript.png');

        $bb_code['subscript'] = $this->getImage('subscript.png');

        $bb_code['code'] = $this->getImage('code.png');

        $bb_code['php'] = $this->getImage('php.png');

        $bb_code['quote'] = $this->getImage('quote.png');

        $bb_code['line'] = $this->getImage('line.png');

        $bb_code['bullet'] = $this->getImage('bullet.png');

        $bb_code['numeric'] = $this->getImage('numeric.png');

        $bb_code['link'] = $this->getImage('link.png');

        $bb_code['email'] = $this->getImage('email.png');

        $bb_code['image'] = $this->getImage('image.png');

        $bb_code['youtube'] = $this->getImage('youtube.png');

        return $bb_code;
    }

    private function getImage($cmtx_image)
    {
        if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/bb_code/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/bb_code/' . strtolower($cmtx_image);
        } else if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/default/image/bb_code/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/default/image/bb_code/' . strtolower($cmtx_image);
        } else {
            die('<b>Error</b>: Could not load image ' . strtolower($cmtx_image) . '!');
        }
    }
}
