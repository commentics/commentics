<?php
namespace Commentics;

class LayoutFormWebsiteModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_website']) ? 1 : 0) . "' WHERE `title` = 'enabled_website'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['required_website']) ? 1 : 0) . "' WHERE `title` = 'required_website'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['default_website']) . "' WHERE `title` = 'default_website'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['maximum_website'] . "' WHERE `title` = 'maximum_website'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_website_cookie_action']) . "' WHERE `title` = 'filled_website_cookie_action'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_website_login_action']) . "' WHERE `title` = 'filled_website_login_action'");
    }
}
