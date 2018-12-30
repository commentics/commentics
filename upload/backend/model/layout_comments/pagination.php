<?php
namespace Commentics;

class LayoutCommentsPaginationModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_pagination']) ? 1 : 0) . "' WHERE `title` = 'show_pagination'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['pagination_type']) . "' WHERE `title` = 'pagination_type'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['pagination_amount'] . "' WHERE `title` = 'pagination_amount'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['pagination_range'] . "' WHERE `title` = 'pagination_range'");
    }
}
