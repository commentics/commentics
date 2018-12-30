<?php
namespace Commentics;

class LayoutFormNameModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['default_name']) . "' WHERE `title` = 'default_name'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['maximum_name'] . "' WHERE `title` = 'maximum_name'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_name_cookie_action']) . "' WHERE `title` = 'filled_name_cookie_action'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_name_login_action']) . "' WHERE `title` = 'filled_name_login_action'");
    }
}
