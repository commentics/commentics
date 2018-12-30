<?php
namespace Commentics;

class LayoutFormPoweredModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_powered_by']) ? 1 : 0) . "' WHERE `title` = 'enabled_powered_by'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['powered_by_type']) . "' WHERE `title` = 'powered_by_type'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['powered_by_new_window']) ? 1 : 0) . "' WHERE `title` = 'powered_by_new_window'");
    }
}
