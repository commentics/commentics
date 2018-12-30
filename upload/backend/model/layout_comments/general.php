<?php
namespace Commentics;

class LayoutCommentsGeneralModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_comment_count']) ? 1 : 0) . "' WHERE `title` = 'show_comment_count'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_order']) . "' WHERE `title` = 'comments_order'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_says']) ? 1 : 0) . "' WHERE `title` = 'show_says'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_1']) . "' WHERE `title` = 'comments_position_1'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_2']) . "' WHERE `title` = 'comments_position_2'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_3']) . "' WHERE `title` = 'comments_position_3'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_4']) . "' WHERE `title` = 'comments_position_4'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_5']) . "' WHERE `title` = 'comments_position_5'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_6']) . "' WHERE `title` = 'comments_position_6'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_7']) . "' WHERE `title` = 'comments_position_7'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_8']) . "' WHERE `title` = 'comments_position_8'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_9']) . "' WHERE `title` = 'comments_position_9'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_10']) . "' WHERE `title` = 'comments_position_10'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_11']) . "' WHERE `title` = 'comments_position_11'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['comments_position_12']) . "' WHERE `title` = 'comments_position_12'");
    }
}
