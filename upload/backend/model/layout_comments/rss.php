<?php
namespace Commentics;

class LayoutCommentsRssModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_rss']) ? 1 : 0) . "' WHERE `title` = 'show_rss'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['rss_new_window']) ? 1 : 0) . "' WHERE `title` = 'rss_new_window'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['rss_limit_enabled']) ? 1 : 0) . "' WHERE `title` = 'rss_limit_enabled'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['rss_limit_amount'] . "' WHERE `title` = 'rss_limit_amount'");
    }
}
