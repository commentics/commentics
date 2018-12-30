<?php
namespace Commentics;

class AddQuestionModel extends Model
{
    public function add($data)
    {
        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "questions` SET `question` = '" . $this->db->escape($data['question']) . "', `answer` = '" . $this->db->escape($data['answer']) . "', `language` = '" . $this->db->escape($data['language']) . "', `date_modified` = NOW(), `date_added` = NOW()");
    }
}
