<?php
namespace Commentics;

class LayoutFormStateModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_state']) ? 1 : 0) . "' WHERE `title` = 'enabled_state'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['required_state']) ? 1 : 0) . "' WHERE `title` = 'required_state'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['default_state'] . "' WHERE `title` = 'default_state'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_state_cookie_action']) . "' WHERE `title` = 'filled_state_cookie_action'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_state_login_action']) . "' WHERE `title` = 'filled_state_login_action'");
    }
}
