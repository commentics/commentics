<?php
namespace Commentics;

class LayoutFormQuestionModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_question']) ? 1 : 0) . "' WHERE `title` = 'enabled_question'");
    }
}
