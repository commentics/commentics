<?php
namespace Commentics;

class LayoutCommentsOnlineModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_online']) ? 1 : 0) . "' WHERE `title` = 'show_online'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['online_refresh_enabled']) ? 1 : 0) . "' WHERE `title` = 'online_refresh_enabled'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['online_refresh_interval'] . "' WHERE `title` = 'online_refresh_interval'");
    }

    public function dismiss()
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '0' WHERE `title` = 'notice_layout_comments_online'");
    }
}
