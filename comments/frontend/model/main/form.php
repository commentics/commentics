<?php
namespace Commentics;

class MainFormModel extends Model
{
    public function getFormCookie()
    {
        $cookie = array();

        $cookie['name'] = $cookie['email'] = $cookie['website'] = $cookie['town'] = $cookie['country'] = $cookie['state'] = '';

        if ($this->cookie->exists('Commentics-Form')) {
            $values = $this->cookie->get('Commentics-Form');

            $values = explode('|', $values);

            if (count($values) == 6) {
                $cookie['name']    = $values[0];
                $cookie['email']   = $values[1];
                $cookie['website'] = $values[2];
                $cookie['town']    = $values[3];
                $cookie['country'] = $values[4];
                $cookie['state']   = $values[5];
            }
        }

        return $cookie;
    }

    /* Gets a random question to verify the user is human */
    public function getQuestion()
    {
        $questions = $this->getQuestions();

        if ($questions) {
            $random_key = array_rand($questions, 1);

            return $questions[$random_key];
        } else {
            return false;
        }
    }

    /* Gets all questions */
    private function getQuestions()
    {
        $questions = $this->cache->get('getquestions_' . $this->setting->get('language'));

        if ($questions !== false) {
            return $questions;
        }

        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "questions` WHERE `language` = '" . $this->db->escape($this->setting->get('language')) . "'");

        $questions = $this->db->rows($query);

        if (!$questions) {
            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "questions` WHERE `language` = 'english'");

            $questions = $this->db->rows($query);
        }

        $this->cache->set('getquestions_' . $this->setting->get('language'), $questions);

        return $questions;
    }

    /* Checks if the user has a confirmed subscription for this page */
    public function subscriptionExists($user_id, $page_id)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `user_id` = '" . (int) $user_id . "' AND `page_id` = '" . (int) $page_id . "' AND `is_confirmed` = '1'"))) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks whether the user has any unconfirmed subscriptions */
    public function userHasSubscriptionAttempt($user_id)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `user_id` = '" . (int) $user_id . "' AND `is_confirmed` = '0'"))) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks whether the IP address has any unconfirmed subscriptions */
    public function ipHasSubscriptionAttempt($ip_address)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' AND `is_confirmed` = '0'"))) {
            return true;
        } else {
            return false;
        }
    }

    /* Adds a new subscription in the database */
    public function addSubscription($user_id, $page_id, $token, $ip_address)
    {
        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "subscriptions` SET `user_id` = '" . (int) $user_id . "', `page_id` = '" . (int) $page_id . "', `token` = '" . $this->db->escape($token) . "', `is_confirmed` = '0', `ip_address` = '" . $this->db->escape($ip_address) . "', `date_modified` = NOW(), `date_added` = NOW()");

        return $this->db->insertId();
    }

    /* Checks if the user has previously rated the page (called from two other models) */
    public function hasUserRated($page_id)
    {
        if ($this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `page_id` = '" . (int) $page_id . "' AND `ip_address` = '" . $this->db->escape($this->user->getIpAddress()) . "' AND `rating` != '0'"))) {
            return true;
        }

        if ($this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "ratings` WHERE `page_id` = '" . (int) $page_id . "' AND `ip_address` = '" . $this->db->escape($this->user->getIpAddress()) . "'"))) {
            return true;
        }

        return false;
    }

    public function getExtraField($field_id)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "fields` WHERE `id` = '" . (int) $field_id . "' AND `is_enabled` = '1'");

        $result = $this->db->row($query);

        return $result;
    }

    public function getExtraFields()
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "fields` WHERE `is_enabled` = '1' ORDER BY `sort` ASC");

        $result = $this->db->rows($query);

        return $result;
    }
}
