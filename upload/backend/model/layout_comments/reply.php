<?php
namespace Commentics;

class LayoutCommentsReplyModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_reply']) ? 1 : 0) . "' WHERE `title` = 'show_reply'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['hide_replies']) ? 1 : 0) . "' WHERE `title` = 'hide_replies'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['reply_depth'] . "' WHERE `title` = 'reply_depth'");
    }
}
