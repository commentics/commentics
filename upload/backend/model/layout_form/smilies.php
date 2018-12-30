<?php
namespace Commentics;

class LayoutFormSmiliesModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_smile']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_smile'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_sad']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_sad'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_huh']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_huh'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_laugh']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_laugh'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_mad']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_mad'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_tongue']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_tongue'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_cry']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_cry'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_grin']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_grin'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_wink']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_wink'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_scared']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_scared'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_cool']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_cool'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_sleep']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_sleep'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_blush']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_blush'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_confused']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_confused'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['enabled_smilies_shocked']) ? 1 : 0) . "' WHERE `title` = 'enabled_smilies_shocked'");
    }

    public function getSmilies()
    {
        $smilies = array();

        $smilies['smile'] = $this->getImage('smile.png');

        $smilies['sad'] = $this->getImage('sad.png');

        $smilies['huh'] = $this->getImage('huh.png');

        $smilies['laugh'] = $this->getImage('laugh.png');

        $smilies['mad'] = $this->getImage('mad.png');

        $smilies['tongue'] = $this->getImage('tongue.png');

        $smilies['cry'] = $this->getImage('cry.png');

        $smilies['grin'] = $this->getImage('grin.png');

        $smilies['wink'] = $this->getImage('wink.png');

        $smilies['scared'] = $this->getImage('scared.png');

        $smilies['cool'] = $this->getImage('cool.png');

        $smilies['sleep'] = $this->getImage('sleep.png');

        $smilies['blush'] = $this->getImage('blush.png');

        $smilies['confused'] = $this->getImage('confused.png');

        $smilies['shocked'] = $this->getImage('shocked.png');

        return $smilies;
    }

    private function getImage($cmtx_image)
    {
        if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/smilies/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/image/smilies/' . strtolower($cmtx_image);
        } else if (file_exists(CMTX_HTTP_ROOT . 'frontend/view/default/image/smilies/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_ROOT . 'frontend/view/default/image/smilies/' . strtolower($cmtx_image);
        } else {
            die('<b>Error</b>: Could not load image ' . strtolower($cmtx_image) . '!');
        }
    }
}
