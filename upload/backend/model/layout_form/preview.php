<?php
namespace Commentics;

class LayoutFormPreviewModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_preview']) ? 1 : 0) . "' WHERE `title` = 'enabled_preview'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['agree_to_preview']) ? 1 : 0) . "' WHERE `title` = 'agree_to_preview'");
    }
}
