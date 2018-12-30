<?php
namespace Commentics;

class MainUpgrade1Model extends Model
{
    public function getInstalledVersion()
    {
        if ($this->db->numRows($this->db->query("SHOW COLUMNS FROM `" . CMTX_DB_PREFIX . "version` LIKE 'dated'"))) {
            /* For users upgrading from versions < v3.0 */
            $query = $this->db->query("SELECT `version` FROM `" . CMTX_DB_PREFIX . "version` ORDER BY `dated` DESC LIMIT 1");
        } else {
            $query = $this->db->query("SELECT `version` FROM `" . CMTX_DB_PREFIX . "version` ORDER BY `date_added` DESC LIMIT 1");
        }

        $result = $this->db->row($query);

        return $result['version'];
    }
}
