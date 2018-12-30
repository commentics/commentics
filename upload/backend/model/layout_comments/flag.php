<?php
namespace Commentics;

class LayoutCommentsFlagModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_flag']) ? 1 : 0) . "' WHERE `title` = 'show_flag'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['flag_max_per_user'] . "' WHERE `title` = 'flag_max_per_user'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['flag_min_per_comment'] . "' WHERE `title` = 'flag_min_per_comment'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['flag_disapprove']) ? 1 : 0) . "' WHERE `title` = 'flag_disapprove'");
    }
}
