<?php
namespace Commentics;

class LayoutFormCommentModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['default_comment']) . "' WHERE `title` = 'default_comment'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['comment_maximum_characters'] . "' WHERE `title` = 'comment_maximum_characters'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_counter']) ? 1 : 0) . "' WHERE `title` = 'enabled_counter'");
    }
}
