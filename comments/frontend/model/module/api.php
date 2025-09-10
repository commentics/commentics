<?php
namespace Commentics;

class ModuleApiModel extends Model
{
    public function addAttempt($ip_address)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "api_attempts` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "'"))) {
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "api_attempts` SET `amount` = `amount` + 1, `date_added` = NOW() WHERE `ip_address` = '" . $this->db->escape($ip_address) . "'");
        } else {
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "api_attempts` SET `ip_address` = '" . $this->db->escape($ip_address) . "', `amount` = '1', `date_added` = NOW()");
        }
    }

    public function hasMaxAttempts($ip_address)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "api_attempts` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' AND `amount` >= 3"))) {
            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "api_attempts` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' AND `amount` >= 3");

            $result = $this->db->row($query);

            $time = strtotime($result['date_added']);

            $difference = time() - $time;

            if ($difference < 60 * 30) { // seconds * minutes
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function resetAttempts($ip_address)
    {
        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "api_attempts` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "'");
    }

    public function getUserIdByEmail($email)
    {
        $query = $this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "users` WHERE `email` = '" . $this->db->escape($email) . "'");

        $result = $this->db->row($query);

        if ($result) {
            return $result['id'];
        } else {
            return false;
        }
    }
}
