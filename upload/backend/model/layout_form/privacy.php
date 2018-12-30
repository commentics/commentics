<?php
namespace Commentics;

class LayoutFormPrivacyModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_privacy']) ? 1 : 0) . "' WHERE `title` = 'enabled_privacy'");
    }
}
