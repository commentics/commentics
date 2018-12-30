<?php
namespace Commentics;

class LayoutCommentsNameModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_website']) ? 1 : 0) . "' WHERE `title` = 'show_website'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['website_new_window']) ? 1 : 0) . "' WHERE `title` = 'website_new_window'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['website_no_follow']) ? 1 : 0) . "' WHERE `title` = 'website_no_follow'");
    }
}
