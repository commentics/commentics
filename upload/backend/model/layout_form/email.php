<?php
namespace Commentics;

class LayoutFormEmailModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_email']) ? 1 : 0) . "' WHERE `title` = 'enabled_email'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['required_email']) ? 1 : 0) . "' WHERE `title` = 'required_email'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['default_email']) . "' WHERE `title` = 'default_email'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['maximum_email'] . "' WHERE `title` = 'maximum_email'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_email_cookie_action']) . "' WHERE `title` = 'filled_email_cookie_action'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_email_login_action']) . "' WHERE `title` = 'filled_email_login_action'");
    }
}
