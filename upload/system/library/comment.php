<?php
namespace Commentics;

class Comment
{
    private $cache;
    private $db;
    private $setting;
    private $parents = array();
    private $replies = array();

    public function __construct($registry)
    {
        $this->cache   = $registry->get('cache');
        $this->db      = $registry->get('db');
        $this->setting = $registry->get('setting');
    }

    public function createComment($user_id, $page_id, $website, $town, $state_id, $country_id, $rating, $reply_to, $comment, $ip_address, $approve, $notes, $is_admin, $uploads)
    {
        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "comments` SET `user_id` = '" . (int) $user_id . "', `page_id` = '" . (int) $page_id . "', `website` = '" . $this->db->escape($website) . "', `town` = '" . $this->db->escape($town) . "', `state_id` = '" . (int) $state_id . "', `country_id` = '" . (int) $country_id . "', `rating` = '" . (int) $rating . "', `reply_to` = '" . (int) $reply_to . "', `comment` = '" . $this->db->escape($comment) . "', `reply` = '', `ip_address` = '" . $this->db->escape($ip_address) . "', `is_approved` = '" . ($approve ? 0 : 1) . "', `notes` = '" . $this->db->escape($notes) . "', `is_admin` = '" . (int) $is_admin . "', `is_sent` = '0', `sent_to` = '0', `likes` = '0', `dislikes` = '0', `reports` = '0', `is_sticky` = '0', `is_locked` = '0', `is_verified` = '0', `date_modified` = NOW(), `date_added` = NOW()");

        $comment_id = $this->db->insertId();

        foreach ($uploads as $upload) {
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "uploads` SET `user_id` = '" . (int) $user_id . "', `comment_id` = '" . (int) $comment_id . "', `folder` = '" . $this->db->escape($upload['folder']) . "', `filename` = '" . $this->db->escape($upload['filename']) . "', `extension` = '" . $this->db->escape($upload['extension']) . "', `mime_type` = '" . $this->db->escape($upload['mime_type']) . "', `file_size` = '" . $this->db->escape($upload['file_size']) . "', `date_added` = NOW()");
        }

        return $comment_id;
    }

    public function commentExists($id)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments` WHERE `id` = '" . (int) $id . "'"))) {
            return true;
        } else {
            return false;
        }
    }

    public function getComment($id)
    {
        $query = $this->db->query(" SELECT `p`.*, `u`.*, `u`.`date_added` AS `date_added_user`, `c`.*, `states`.`name` AS `state_name`, `g`.`name` AS `country_name`
                                    FROM `" . CMTX_DB_PREFIX . "comments` `c`
                                    RIGHT JOIN `" . CMTX_DB_PREFIX . "pages` `p` ON `c`.`page_id` = `p`.`id`
                                    RIGHT JOIN `" . CMTX_DB_PREFIX . "users` `u` ON `c`.`user_id` = `u`.`id`
                                    LEFT JOIN `" . CMTX_DB_PREFIX . "states` `states` ON `c`.`state_id` = `states`.`id`
                                    LEFT JOIN `" . CMTX_DB_PREFIX . "countries` `countries` ON `c`.`country_id` = `countries`.`id`
                                    LEFT JOIN `" . CMTX_DB_PREFIX . "geo` `g` ON `g`.`country_code` = `countries`.`code`
                                    WHERE `c`.`id` = '" . (int) $id . "'
                                    AND (`g`.`language` IS NULL OR `g`.`language` = '" . $this->db->escape($this->setting->get('language')) . "')
                                    ");

        if ($this->db->numRows($query)) {
            $comment = $this->db->row($query);

            $uploads = $this->getUploads($id);

            return array(
                'id'              => $comment['id'],
                'user_id'         => $comment['user_id'],
                'page_id'         => $comment['page_id'],
                'name'            => $comment['name'],
                'email'           => $comment['email'],
                'page_reference'  => $comment['reference'],
                'page_url'        => $comment['url'],
                'website'         => $comment['website'],
                'town'            => $comment['town'],
                'state_id'        => $comment['state_id'],
                'state'           => $comment['state_name'],
                'country_id'      => $comment['country_id'],
                'country'         => $comment['country_name'],
                'rating'          => $comment['rating'],
                'reply_to'        => $comment['reply_to'],
                'comment'         => $comment['comment'],
                'reply'           => $comment['reply'],
                'ip_address'      => $comment['ip_address'],
                'is_approved'     => $comment['is_approved'],
                'notes'           => $comment['notes'],
                'is_admin'        => $comment['is_admin'],
                'is_sent'         => $comment['is_sent'],
                'sent_to'         => $comment['sent_to'],
                'likes'           => $comment['likes'],
                'dislikes'        => $comment['dislikes'],
                'reports'         => $comment['reports'],
                'is_sticky'       => $comment['is_sticky'],
                'is_locked'       => $comment['is_locked'],
                'is_verified'     => $comment['is_verified'],
                'date_modified'   => $comment['date_modified'],
                'date_added'      => $comment['date_added'],
                'token'           => $comment['token'],
                'format'          => $comment['format'],
                'to_approve'      => $comment['to_approve'],
                'date_added_user' => $comment['date_added_user'],
                'uploads'         => $uploads
            );
        } else {
            return false;
        }
    }

    public function getPageIdByCommentId($id)
    {
        $query = $this->db->query("SELECT `page_id` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `id` = '" . (int) $id . "'");

        $result = $this->db->row($query);

        $page_id = $result['page_id'];

        return $page_id;
    }

    public function getComments()
    {
        $query = $this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "comments`");

        $results = $this->db->rows($query);

        $comments = array();

        foreach ($results as $result) {
            $comments[$result['id']] = $this->getComment($result['id']);
        }

        return $comments;
    }

    public function deleteComment($id)
    {
        if ($this->setting->get('cache_type')) {
            $page_id = $this->getPageIdByCommentId($id);

            $this->cache->delete('getcomments_pageid' . $page_id . '_count0');
            $this->cache->delete('getcomments_pageid' . $page_id . '_count1');
        }

        $this->deleteReplies($id);

        $this->deleteUploads($id);

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "reporters` WHERE `comment_id` = '" . (int) $id . "'");

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "voters` WHERE `comment_id` = '" . (int) $id . "'");

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "comments` WHERE `id` = '" . (int) $id . "'");

        if ($this->db->affectedRows()) {
            return true;
        } else {
            return false;
        }
    }

    public function unapproveComment($id)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `is_approved` = '0' WHERE `id` = '" . (int) $id . "'");

        // TODO: unapprove replies
    }

    public function getParents($id)
    {
        $query = $this->db->query("SELECT `reply_to` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `id` = '" . (int) $id . "'");

        $result = $this->db->row($query);

        if ($result['reply_to']) {
            $this->parents[] = $result['reply_to'];

            $this->getParents($result['reply_to']);
        }

        return $this->parents;
    }

    public function getReplies($id)
    {
        $query = $this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `reply_to` = '" . (int) $id . "'");

        $results = $this->db->rows($query);

        foreach ($results as $result) {
            $this->replies[] = $result['id'];

            $this->getReplies($result['id']);
        }

        return $this->replies;
    }

    public function getTopParent($id)
    {
        $query = $this->db->query("SELECT `reply_to` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `id` = '" . (int) $id . "'");

        $result = $this->db->row($query);

        if ($result['reply_to']) {
            $this->getTopParent($result['reply_to']);
        } else {
            return $id;
        }
    }

    public function buildCommentUrl($id, $url)
    {
        if (strstr($url, '?') && strstr($url, '=')) {
            $url .= '&cmtx_perm=' . $id . '#cmtx_perm_' . $id;
        } else {
            $url .= '?cmtx_perm=' . $id . '#cmtx_perm_' . $id;
        }

        return $url;
    }

    private function deleteReplies($id)
    {
        $replies = $this->getReplies($id);

        foreach ($replies as $id) {
            $this->deleteUploads($id);

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "reporters` WHERE `comment_id` = '" . (int) $id . "'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "voters` WHERE `comment_id` = '" . (int) $id . "'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "comments` WHERE `id` = '" . (int) $id . "'");
        }
    }

    private function getUploads($comment_id)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "uploads` WHERE `comment_id` = '" . (int) $comment_id . "'");

        $results = $this->db->rows($query);

        return $results;
    }

    private function deleteUploads($comment_id)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "uploads` WHERE `comment_id` = '" . (int) $comment_id . "'");

        $results = $this->db->rows($query);

        foreach ($results as $result) {
            $location = CMTX_DIR_UPLOAD . $result['folder'] . '/' . $result['filename'] . '.' . $result['extension'];

            if (file_exists($location)) {
                @unlink($location);
            }
        }

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "uploads` WHERE `comment_id` = '" . (int) $comment_id . "'");
    }
}
