<?php
namespace Commentics;

class LayoutFormCountryModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_country']) ? 1 : 0) . "' WHERE `title` = 'enabled_country'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['required_country']) ? 1 : 0) . "' WHERE `title` = 'required_country'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['default_country'] . "' WHERE `title` = 'default_country'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_country_cookie_action']) . "' WHERE `title` = 'filled_country_cookie_action'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['filled_country_login_action']) . "' WHERE `title` = 'filled_country_login_action'");
    }
}
