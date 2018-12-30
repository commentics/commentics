<?php
namespace Commentics;

class LayoutCommentsAverageRatingModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_average_rating']) ? 1 : 0) . "' WHERE `title` = 'show_average_rating'");
    }
}
