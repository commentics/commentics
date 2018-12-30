<?php
namespace Commentics;

class LayoutCommentsNotifyModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_notify']) ? 1 : 0) . "' WHERE `title` = 'show_notify'");
    }
}
