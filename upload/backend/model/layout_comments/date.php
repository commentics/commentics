<?php
namespace Commentics;

class LayoutCommentsDateModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_date']) ? 1 : 0) . "' WHERE `title` = 'show_date'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['date_auto']) ? 1 : 0) . "' WHERE `title` = 'date_auto'");
    }
}
