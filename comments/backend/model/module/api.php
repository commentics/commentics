<?php
namespace Commentics;

class ModuleApiModel extends Model
{
    public function update($data)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['api_enabled']) ? 1 : 0) . "' WHERE `title` = 'api_enabled'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['api_key']) . "' WHERE `title` = 'api_key'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['api_ip_address']) . "' WHERE `title` = 'api_ip_address'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['api_check_ip']) . "' WHERE `title` = 'api_check_ip'");

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['api_logging']) ? 1 : 0) . "' WHERE `title` = 'api_logging'");
    }

    public function install()
    {
        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'module', `title` = 'api_enabled', `value` = '0'");

        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'module', `title` = 'api_key', `value` = '" . $this->db->escape($this->variable->random()) . "'");

        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'module', `title` = 'api_ip_address', `value` = '" . $this->db->escape($this->user->getIpAddress()) . "'");

        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'module', `title` = 'api_check_ip', `value` = 'strict'");

        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'module', `title` = 'api_logging', `value` = '0'");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . CMTX_DB_PREFIX . "api_attempts` (
            `id` int(10) unsigned NOT NULL auto_increment,
            `ip_address` varchar(250) NOT NULL default '',
            `amount` int(10) unsigned NOT NULL default '0',
            `date_added` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
    }

    public function uninstall()
    {
        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'api_enabled'");

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'api_key'");

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'api_ip_address'");

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'api_check_ip'");

        $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'api_logging'");

        $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "api_attempts`");
    }
}
