<?php
namespace Commentics;

class LayoutCommentsSortByModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_sort_by']) ? 1 : 0) . "' WHERE `title` = 'show_sort_by'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_sort_by_1']) ? 1 : 0) . "' WHERE `title` = 'show_sort_by_1'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_sort_by_2']) ? 1 : 0) . "' WHERE `title` = 'show_sort_by_2'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_sort_by_3']) ? 1 : 0) . "' WHERE `title` = 'show_sort_by_3'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_sort_by_4']) ? 1 : 0) . "' WHERE `title` = 'show_sort_by_4'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_sort_by_5']) ? 1 : 0) . "' WHERE `title` = 'show_sort_by_5'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_sort_by_6']) ? 1 : 0) . "' WHERE `title` = 'show_sort_by_6'");
    }
}
