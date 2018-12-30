<?php
namespace Commentics;

class LayoutFormTownModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_town']) ? 1 : 0) . "' WHERE `title` = 'enabled_town'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['required_town']) ? 1 : 0) . "' WHERE `title` = 'required_town'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['default_town']) . "' WHERE `title` = 'default_town'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['maximum_town'] . "' WHERE `title` = 'maximum_town'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_town_cookie_action']) . "' WHERE `title` = 'filled_town_cookie_action'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_town_login_action']) . "' WHERE `title` = 'filled_town_login_action'");
    }
}
