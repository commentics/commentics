<?php
namespace Commentics;

class LayoutFormGeneralModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_form']) ? 1 : 0) . "' WHERE `title` = 'enabled_form'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['hide_form']) ? 1 : 0) . "' WHERE `title` = 'hide_form'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['display_javascript_disabled']) ? 1 : 0) . "' WHERE `title` = 'display_javascript_disabled'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['display_required_symbol']) ? 1 : 0) . "' WHERE `title` = 'display_required_symbol'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['display_required_text']) ? 1 : 0) . "' WHERE `title` = 'display_required_text'");
    }
}
