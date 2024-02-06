<?php
namespace Commentics;

class Event
{
    private $db;
    private $has_events = false;

    public function __construct($registry)
    {
        $this->db = $registry->get('db');

        if (count(glob(CMTX_DIR_EVENTS . '*.php'))) {
            $this->has_events = true;
        }
    }

    public function trigger($event, $data = array())
    {
        if ($this->has_events) {
            $comment_id = 0;

            if (isset($data['page_id'])) {
                $page = $this->getPageById($data['page_id']);
            } else if (isset($data['comment_id'])) {
                $page = $this->getPageByCommentId($data['comment_id']);
            }

            if (!empty($page)) {
                $page_id         = $page['id'];
                $page_identifier = $page['identifier'];
                $page_reference  = $page['reference'];
                $page_url        = $page['url'];
            }

            extract($data);

            $event_file = CMTX_DIR_EVENTS . $event . '.php';

            if (file_exists($event_file)) {
                require $event_file;
            }

            $event_file = CMTX_DIR_EVENTS . 'all.php';

            if (file_exists($event_file)) {
                require $event_file;
            }
        }
    }

    private function getPageById($page_id)
    {
        $query = $this->db->query("SELECT *
                                   FROM `" . CMTX_DB_PREFIX . "pages`
                                   WHERE `id` = '" . (int) $page_id . "'");

        $result = $this->db->row($query);

        return $result;
    }

    private function getPageByCommentId($comment_id)
    {
        $query = $this->db->query("SELECT `p`.*
                                   FROM `" . CMTX_DB_PREFIX . "pages` `p`
                                   LEFT JOIN `" . CMTX_DB_PREFIX . "comments` `c` ON `c`.`page_id` = `p`.`id`
                                   WHERE `c`.`id` = '" . (int) $comment_id . "'");

        $result = $this->db->row($query);

        return $result;
    }
}
