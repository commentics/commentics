<?php
namespace Commentics;

class EditUserModel extends Model
{
    public function nameExists($name, $id = 0)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "users` WHERE `name` = '" . $this->db->escape($name) . "' AND `id` != '" . (int) $id . "'"))) {
            return true;
        } else {
            return false;
        }
    }

    public function emailExists($email, $id = 0)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "users` WHERE `email` = '" . $this->db->escape($email) . "' AND `id` != '" . (int) $id . "'"))) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `name` = '" . $this->db->escape($data['name']) . "', `email` = '" . $this->db->escape($data['email']) . "', `moderate` = '" . $this->db->escape($data['moderate']) . "', `date_modified` = NOW() WHERE `id` = '" . (int) $id . "'");

        if (isset($data['avatar'])) {
            $user = $this->user->getUser($id);

            if ($user) {
                if ($data['avatar'] == 'approve' && $user['avatar_pending_id']) {
                    $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `avatar_id` = `avatar_pending_id`, `avatar_pending_id` = '0', `date_modified` = NOW() WHERE `id` = '" . (int) $id . "'");
                } else if ($data['avatar'] == 'disapprove' && $user['avatar_pending_id']) {
                    $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `avatar_pending_id` = '0', `date_modified` = NOW() WHERE `id` = '" . (int) $id . "'");
                } else if ($data['avatar'] == 'disapprove' && $user['avatar_id']) {
                    $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `avatar_id` = '0', `avatar_pending_id` = '0', `date_modified` = NOW() WHERE `id` = '" . (int) $id . "'");
                }
            }
        }
    }
}
