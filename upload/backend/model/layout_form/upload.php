<?php
namespace Commentics;

class LayoutFormUploadModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_upload']) ? 1 : 0) . "' WHERE `title` = 'enabled_upload'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['maximum_upload_size'] . "' WHERE `title` = 'maximum_upload_size'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['maximum_upload_amount'] . "' WHERE `title` = 'maximum_upload_amount'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $data['maximum_upload_total'] . "' WHERE `title` = 'maximum_upload_total'");
    }
}
