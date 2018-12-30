<?php
namespace Commentics;

class LayoutFormTermsModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_terms']) ? 1 : 0) . "' WHERE `title` = 'enabled_terms'");
    }
}
