<?php
namespace Commentics;

class LayoutFormNotifyModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_notify']) ? 1 : 0) . "' WHERE `title` = 'enabled_notify'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['default_notify']) ? 1 : 0) . "' WHERE `title` = 'default_notify'");
    }
}
