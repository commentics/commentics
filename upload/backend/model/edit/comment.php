<?php
namespace Commentics;

class EditCommentModel extends Model
{
    public function update($data, $id)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `page_id` = '" . (int) $data['page_id'] . "', `website` = '" . $this->db->escape($data['website']) . "', `town` = '" . $this->db->escape($data['town']) . "', `state_id` = '" . (int) $data['state_id'] . "', `country_id` = '" . (int) $data['country_id'] . "', `rating` = '" . (int) $data['rating'] . "', `reply_to` = '" . (int) $data['reply_to'] . "', `comment` = '" . $this->db->escape($this->security->decode($data['comment'])) . "', `reply` = '" . $this->db->escape($this->security->decode($data['reply'])) . "', `is_approved` = '" . (int) $data['is_approved'] . "', `notes` = '" . $this->db->escape($data['notes']) . "', `reports` = " . (isset($data['verify']) ? '0' : '`reports`') . ", `is_sticky` = '" . (isset($data['is_sticky']) && $data['is_sticky'] ? 1 : 0) . "', `is_locked` = '" . (int) $data['is_locked'] . "', `is_verified` = " . (isset($data['verify']) ? '1' : '`is_verified`') . ", `date_modified` = NOW() WHERE `id` = '" . (int) $id . "'");

        if (isset($data['send'])) {
            $this->notify->subscriberNotification($id);
        }

        $this->cache->delete('getcomment_commentid' . $id . '_' . $this->setting->get('language_frontend'));

        $this->cache->delete('getcomments_pageid' . $data['page_id'] . '_count0');
        $this->cache->delete('getcomments_pageid' . $data['page_id'] . '_count1');
    }

    public function getStates($id)
    {
        $query = $this->db->query("SELECT `code` FROM `" . CMTX_DB_PREFIX . "countries` WHERE `id` = '" . (int) $id . "'");

        $result = $this->db->row($query);

        $code = $result['code'];

        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "states` WHERE `country_code` = '" . $this->db->escape($code) . "' ORDER BY `name` ASC");

        $results = $this->db->rows($query);

        return $results;
    }

    public function getReplies($id, $page_id)
    {
        $query = $this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `id` != '" . (int) $id . "' AND `page_id` = '" . (int) $page_id . "'");

        $results = $this->db->rows($query);

        $comments = array();

        foreach ($results as $result) {
            $comments[$result['id']] = $this->comment->getComment($result['id']);
        }

        return $comments;
    }

    public function getPages()
    {
        $query = $this->db->query("SELECT `id`, `reference` FROM `" . CMTX_DB_PREFIX . "pages`");

        $results = $this->db->rows($query);

        return $results;
    }

    public function dismiss()
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '0' WHERE `title` = 'notice_edit_comment'");
    }
}
