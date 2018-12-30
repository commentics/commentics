<?php
namespace Commentics;

class LayoutFormCookieModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_cookie']) ? 1 : 0) . "' WHERE `title` = 'enabled_cookie'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['default_cookie']) ? 1 : 0) . "' WHERE `title` = 'default_cookie'");
    }
}
