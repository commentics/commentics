<?php
namespace Commentics;

class LayoutFormRatingModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_rating']) ? 1 : 0) . "' WHERE `title` = 'enabled_rating'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['required_rating']) ? 1 : 0) . "' WHERE `title` = 'required_rating'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['default_rating'] . "' WHERE `title` = 'default_rating'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['repeat_rating']) . "' WHERE `title` = 'repeat_rating'");
    }
}
