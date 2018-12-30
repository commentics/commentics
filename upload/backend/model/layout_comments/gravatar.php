<?php
namespace Commentics;

class LayoutCommentsGravatarModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_gravatar']) ? 1 : 0) . "' WHERE `title` = 'show_gravatar'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['gravatar_default']) . "' WHERE `title` = 'gravatar_default'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['gravatar_custom']) . "' WHERE `title` = 'gravatar_custom'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['gravatar_size'] . "' WHERE `title` = 'gravatar_size'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['gravatar_rating']) . "' WHERE `title` = 'gravatar_rating'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_level']) ? 1 : 0) . "' WHERE `title` = 'show_level'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['level_5'] . "' WHERE `title` = 'level_5'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['level_4'] . "' WHERE `title` = 'level_4'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['level_3'] . "' WHERE `title` = 'level_3'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['level_2'] . "' WHERE `title` = 'level_2'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['level_1'] . "' WHERE `title` = 'level_1'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['level_0'] . "' WHERE `title` = 'level_0'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_bio']) ? 1 : 0) . "' WHERE `title` = 'show_bio'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_badge_top_poster']) ? 1 : 0) . "' WHERE `title` = 'show_badge_top_poster'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_badge_most_likes']) ? 1 : 0) . "' WHERE `title` = 'show_badge_most_likes'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_badge_first_poster']) ? 1 : 0) . "' WHERE `title` = 'show_badge_first_poster'");
    }
}
