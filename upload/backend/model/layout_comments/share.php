<?php
namespace Commentics;

class LayoutCommentsShareModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_share']) ? 1 : 0) . "' WHERE `title` = 'show_share'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['share_new_window']) ? 1 : 0) . "' WHERE `title` = 'share_new_window'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_share_digg']) ? 1 : 0) . "' WHERE `title` = 'show_share_digg'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_share_facebook']) ? 1 : 0) . "' WHERE `title` = 'show_share_facebook'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_share_linkedin']) ? 1 : 0) . "' WHERE `title` = 'show_share_linkedin'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_share_reddit']) ? 1 : 0) . "' WHERE `title` = 'show_share_reddit'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_share_twitter']) ? 1 : 0) . "' WHERE `title` = 'show_share_twitter'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_share_weibo']) ? 1 : 0) . "' WHERE `title` = 'show_share_weibo'");
    }

    public function getShares()
    {
        $shares = array();

        $shares['digg'] = $this->getImage('digg.png');

        $shares['facebook'] = $this->getImage('facebook.png');

        $shares['linkedin'] = $this->getImage('linkedin.png');

        $shares['reddit'] = $this->getImage('reddit.png');

        $shares['twitter'] = $this->getImage('twitter.png');

        $shares['weibo'] = $this->getImage('weibo.png');

        return $shares;
    }

    private function getImage($cmtx_image)
    {
        if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/share/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/share/' . strtolower($cmtx_image);
        } else if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/default/image/share/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/default/image/share/' . strtolower($cmtx_image);
        } else {
            die('<b>Error</b>: Could not load image ' . strtolower($cmtx_image) . '!');
        }
    }
}
