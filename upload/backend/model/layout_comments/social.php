<?php
namespace Commentics;

class LayoutCommentsSocialModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_social']) ? 1 : 0) . "' WHERE `title` = 'show_social'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['social_new_window']) ? 1 : 0) . "' WHERE `title` = 'social_new_window'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_social_digg']) ? 1 : 0) . "' WHERE `title` = 'show_social_digg'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_social_facebook']) ? 1 : 0) . "' WHERE `title` = 'show_social_facebook'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_social_linkedin']) ? 1 : 0) . "' WHERE `title` = 'show_social_linkedin'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_social_reddit']) ? 1 : 0) . "' WHERE `title` = 'show_social_reddit'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_social_twitter']) ? 1 : 0) . "' WHERE `title` = 'show_social_twitter'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_social_weibo']) ? 1 : 0) . "' WHERE `title` = 'show_social_weibo'");
    }

    public function getSocials()
    {
        $socials = array();

        $socials['digg'] = $this->getImage('digg.png');

        $socials['facebook'] = $this->getImage('facebook.png');

        $socials['linkedin'] = $this->getImage('linkedin.png');

        $socials['reddit'] = $this->getImage('reddit.png');

        $socials['twitter'] = $this->getImage('twitter.png');

        $socials['weibo'] = $this->getImage('weibo.png');

        return $socials;
    }

    private function getImage($cmtx_image)
    {
        if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/social/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/social/' . strtolower($cmtx_image);
        } else if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/default/image/social/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/default/image/social/' . strtolower($cmtx_image);
        } else {
            die('<b>Error</b>: Could not load image ' . strtolower($cmtx_image) . '!');
        }
    }
}
