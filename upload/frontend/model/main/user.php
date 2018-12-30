<?php
namespace Commentics;

class MainUserModel extends Model
{
    /* Get the user */
    public function getUser($user_token)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "users` WHERE `token` = '" . $this->db->escape($user_token) . "'");

        $result = $this->db->row($query);

        return $result;
    }

    /* Get the user's subscription */
    public function getSubscription($user_token, $subscription_token)
    {
        $query = $this->db->query(" SELECT *
                                    FROM `" . CMTX_DB_PREFIX . "subscriptions` `s`
                                    RIGHT JOIN `" . CMTX_DB_PREFIX . "users` `u` ON `s`.`user_id` = `u`.`id`
                                    WHERE `s`.`token` = '" . $this->db->escape($subscription_token) . "'
                                    AND `u`.`token` = '" . $this->db->escape($user_token) . "'");

        $result = $this->db->row($query);

        return $result;
    }

    /* Get the user's subscriptions */
    public function getSubscriptions($user_token)
    {
        $query = $this->db->query(" SELECT `s`.*, `p`.`reference`, `p`.`url`
                                    FROM `" . CMTX_DB_PREFIX . "subscriptions` `s`
                                    RIGHT JOIN `" . CMTX_DB_PREFIX . "users` `u` ON `s`.`user_id` = `u`.`id`
                                    RIGHT JOIN `" . CMTX_DB_PREFIX . "pages` `p` ON `s`.`page_id` = `p`.`id`
                                    WHERE `u`.`token` = '" . $this->db->escape($user_token) . "'
                                    ORDER BY `s`.`date_added` DESC");

        $results = $this->db->rows($query);

        return $results;
    }

    /* Confirm the user's subscription */
    public function confirmSubscription($subscription_token)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "subscriptions` SET `is_confirmed` = '1' WHERE `token` = '" . $this->db->escape($subscription_token) . "'");
    }

    /* Delete the user's subscription */
    public function deleteSubscription($subscription_token)
    {
        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `token` = '" . $this->db->escape($subscription_token) . "'");
    }

    /* Delete all of the user's subscriptions */
    public function deleteAllSubscriptions($user_id)
    {
        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `user_id` = '" . (int) $user_id . "'");
    }

    /* Save the user's settings */
    public function save($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `to_all` = '" . ((isset($data['to_all']) && $data['to_all']) ? 1 : 0) . "', `to_admin` = '" . ((isset($data['to_admin']) && $data['to_admin']) ? 1 : 0) . "', `to_reply` = '" . ((isset($data['to_reply']) && $data['to_reply']) ? 1 : 0) . "', `to_approve` = '" . ((isset($data['to_approve']) && $data['to_approve']) ? 1 : 0) . "', `format` = '" . ((isset($data['format']) && $data['format'] == 'html') ? 'html' : 'text') . "' WHERE `token` = '" . $this->db->escape($data['u-t']) . "'");
    }
}
