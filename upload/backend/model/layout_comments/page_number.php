<?php
namespace Commentics;

class LayoutCommentsPageNumberModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_page_number']) ? 1 : 0) . "' WHERE `title` = 'show_page_number'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['page_number_format']) . "' WHERE `title` = 'page_number_format'");
    }
}
