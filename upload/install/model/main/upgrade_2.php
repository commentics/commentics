<?php
namespace Commentics;

class MainUpgrade2Model extends Model
{
    public function upgrade($version)
    {
        if ($version == '2.5 -> 3.0') {
            $this->loadModel('main/install_2');

            /* Access */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "access`");
            $this->model_main_install_2->createTableAccess();

            /* Admins */
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` ADD `viewable_pages` text NOT NULL");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` ADD `modifiable_pages` text NOT NULL");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` ADD `format` varchar(250) NOT NULL default 'html'");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` ADD `date_modified` datetime NOT NULL");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` DROP COLUMN `allowed_pages`");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` CHANGE `receive_email_new_ban` `receive_email_ban` tinyint(1) unsigned NOT NULL default '1'");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` CHANGE `receive_email_new_comment_approve` `receive_email_comment_approve` tinyint(1) unsigned NOT NULL default '1'");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` CHANGE `receive_email_new_comment_okay` `receive_email_comment_success` tinyint(1) unsigned NOT NULL default '1'");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` CHANGE `receive_email_new_flag` `receive_email_flag` tinyint(1) unsigned NOT NULL default '1'");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` CHANGE `dated` `date_added` datetime NOT NULL");

            /* Attempts */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "attempts`");
            $this->model_main_install_2->createTableAttempts();

            /* Backups */
            $this->model_main_install_2->createTableBackups();

            /* Bans */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "bans`");
            $this->model_main_install_2->createTableBans();

            /* Countries */
            $this->db->query("CREATE TABLE IF NOT EXISTS `" . CMTX_DB_PREFIX . "countries` (
                `id` int(10) unsigned NOT NULL auto_increment,
                `name` varchar(250) NOT NULL default '',
                `code` varchar(3) NOT NULL default '',
                `top` tinyint(1) unsigned NOT NULL default '0',
                `enabled` tinyint(1) unsigned NOT NULL default '1',
                `date_modified` datetime NOT NULL default NOW(),
                `date_added` datetime NOT NULL default NOW(),
                PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Afghanistan', `code` = 'AFG', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Albania', `code` = 'ALB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Algeria', `code` = 'DZA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Andorra', `code` = 'AND', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Angola', `code` = 'AGO', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Argentina', `code` = 'ARG', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Armenia', `code` = 'ARM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Australia', `code` = 'AUS', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Austria', `code` = 'AUT', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Azerbaijan', `code` = 'AZE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Bahrain', `code` = 'BHR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Bangladesh', `code` = 'BGD', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Belarus', `code` = 'BLR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Belgium', `code` = 'BEL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Belize', `code` = 'BLZ', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Benin', `code` = 'BEN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Bermuda', `code` = 'BMU', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Bhutan', `code` = 'BTN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Bolivia', `code` = 'BOL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Bosnia and Herzegovina', `code` = 'BIH', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Botswana', `code` = 'BWA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Brazil', `code` = 'BRA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Brunei', `code` = 'BRN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Bulgaria', `code` = 'BGR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Burkina Faso', `code` = 'BFA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Burundi', `code` = 'BDI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Cambodia', `code` = 'KHM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Cameroon', `code` = 'CMR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Canada', `code` = 'CAN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Central African Republic', `code` = 'CAF', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Chad', `code` = 'TCD', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Chile', `code` = 'CHL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'China', `code` = 'CHN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Colombia', `code` = 'COL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Congo', `code` = 'COG', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Costa Rica', `code` = 'CRI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Croatia', `code` = 'HRV', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Cuba', `code` = 'CUB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Cyprus', `code` = 'CYP', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Czech Republic', `code` = 'CZE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Denmark', `code` = 'DNK', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Djibouti', `code` = 'DJI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Dominican Republic', `code` = 'DOM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Ecuador', `code` = 'ECU', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Egypt', `code` = 'EGY', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'El Salvador', `code` = 'SLV', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Equatorial Guinea', `code` = 'GNQ', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Eritrea', `code` = 'ERI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Estonia', `code` = 'EST', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Ethiopia', `code` = 'ETH', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Falklands', `code` = 'FLK', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Finland', `code` = 'FIN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'France', `code` = 'FRA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Gabon', `code` = 'GAB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Gambia', `code` = 'GMB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Georgia', `code` = 'GEO', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Germany', `code` = 'DEU', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Ghana', `code` = 'GHA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Greece', `code` = 'GRC', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Greenland', `code` = 'GRL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Guatemala', `code` = 'GTM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Guinea', `code` = 'GIN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Guinea-Bissau', `code` = 'GNB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Guyana', `code` = 'GUY', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Haiti', `code` = 'HTI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Honduras', `code` = 'HND', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Hong Kong', `code` = 'HKG', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Hungary', `code` = 'HUN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Iceland', `code` = 'ISL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'India', `code` = 'IND', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Indonesia', `code` = 'IDN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Iran', `code` = 'IRN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Iraq', `code` = 'IRQ', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Ireland', `code` = 'IRL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Israel', `code` = 'ISR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Italy', `code` = 'ITA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Ivory Coast', `code` = 'CIV', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Jamaica', `code` = 'JAM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Japan', `code` = 'JPN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Jordan', `code` = 'JOR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Kazakhstan', `code` = 'KAZ', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Kenya', `code` = 'KEN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Kosovo', `code` = 'UNK', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Kuwait', `code` = 'KWT', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Kyrgyzstan', `code` = 'KGZ', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Laos', `code` = 'LAO', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Latvia', `code` = 'LVA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Lebanon', `code` = 'LBN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Lesotho', `code` = 'LSO', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Liberia', `code` = 'LBR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Libya', `code` = 'LBY', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Liechtenstein', `code` = 'LIE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Lithuania', `code` = 'LTU', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Madagascar', `code` = 'MDG', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Malawi', `code` = 'MWI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Malaysia', `code` = 'MYS', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Mali', `code` = 'MLI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Mauritania', `code` = 'MRT', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Mexico', `code` = 'MEX', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Moldova', `code` = 'MDA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Monaco', `code` = 'MCO', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Mongolia', `code` = 'MNG', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Montenegro', `code` = 'MNE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Morocco', `code` = 'MAR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Mozambique', `code` = 'MOZ', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Myanmar', `code` = 'MMR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Namibia', `code` = 'NAM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Nepal', `code` = 'NPL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Netherlands', `code` = 'NLD', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'New Zealand', `code` = 'NZL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Nicaragua', `code` = 'NIC', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Niger', `code` = 'NER', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Nigeria', `code` = 'NGA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'North Korea', `code` = 'PRK', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Norway', `code` = 'NOR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Oman', `code` = 'OMN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Pakistan', `code` = 'PAK', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Palestine', `code` = 'PSE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Panama', `code` = 'PAN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Papua New Guinea', `code` = 'PNG', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Paraguay', `code` = 'PRY', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Peru', `code` = 'PER', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Philippines', `code` = 'PHL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Poland', `code` = 'POL', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Portugal', `code` = 'PRT', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Puerto Rico', `code` = 'PRI', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Qatar', `code` = 'QAT', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Romania', `code` = 'ROM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Russia', `code` = 'RUS', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Rwanda', `code` = 'RWA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'San Marino', `code` = 'SMR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Saudi Arabia', `code` = 'SAU', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Senegal', `code` = 'SEN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Serbia', `code` = 'SRB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Sierra Leone', `code` = 'SLE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Singapore', `code` = 'SGP', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Slovakia', `code` = 'SVK', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Slovenia', `code` = 'SVN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Somalia', `code` = 'SOM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'South Africa', `code` = 'ZAF', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'South Korea', `code` = 'KOR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'South Sudan', `code` = 'SSD', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Spain', `code` = 'ESP', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Sri Lanka', `code` = 'LKA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Sudan', `code` = 'SDN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Suriname', `code` = 'SUR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Swaziland', `code` = 'SWZ', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Sweden', `code` = 'SWE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Switzerland', `code` = 'CHE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Syria', `code` = 'SYR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Taiwan', `code` = 'TWN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Tajikistan', `code` = 'TJK', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Tanzania', `code` = 'TZA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Thailand', `code` = 'THA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Togo', `code` = 'TGO', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Trinidad and Tobago', `code` = 'TTO', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Tunisia', `code` = 'TUN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Turkey', `code` = 'TUR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Turkmenistan', `code` = 'TKM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Uganda', `code` = 'UGA', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Ukraine', `code` = 'UKR', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'United Arab Emirates', `code` = 'ARE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'UK', `code` = 'GBR', `top` = '1', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'US', `code` = 'USA', `top` = '1', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Uruguay', `code` = 'URY', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Uzbekistan', `code` = 'UZB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Venezuela', `code` = 'VEN', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Vietnam', `code` = 'VNM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Western Sahara', `code` = 'ESH', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Yemen', `code` = 'YEM', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Zambia', `code` = 'ZMB', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = 'Zimbabwe', `code` = 'ZWE', `top` = '0', `enabled` = '1', `date_modified` = NOW(), `date_added` = NOW()");

            /* Data */
            $this->model_main_install_2->createTableData();

            /* Emails */
            $this->db->query("CREATE TABLE IF NOT EXISTS `" . CMTX_DB_PREFIX . "emails` (
                `id` int(10) unsigned NOT NULL auto_increment,
                `type` varchar(250) NOT NULL default '',
                `subject` varchar(250) NOT NULL default '',
                `from_name` varchar(250) NOT NULL default '',
                `from_email` varchar(250) NOT NULL default '',
                `reply_to` varchar(250) NOT NULL default '',
                `text` text NOT NULL,
                `html` text NOT NULL,
                `language` varchar(250) NOT NULL default '',
                `date_modified` datetime NOT NULL default NOW(),
                PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

            $site_name = $this->setting->get('site_name');
            $site_domain = $this->setting->get('site_domain');

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'ban', `subject` = '[username], there&#039;s a new ban!', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [username],\r\n\r\nA new user, with the IP address [ip address], has been banned for the following reason:\r\n- [reason]\r\n\r\nHere is the link to your admin panel:\r\n[admin link]\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [username],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">A new user, with the IP address [ip address], has been banned for the following reason:</td>\r\n</tr>\r\n<tr>\r\n<td>- [reason]</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Here is the link to your admin panel:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[admin link]\">[admin link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'comment_approve', `subject` = 'Comment Approve', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [username],\r\n\r\nA new comment has been posted on the page [page reference], located at the following address:\r\n[comment url]\r\n\r\nThe comment was made by [poster] and was as follows:\r\n\r\n************************\r\n\r\n[comment]\r\n\r\n************************\r\n\r\nThis comment requires approval due to the following reason(s):\r\n[reason]\r\n\r\nHere is the link to your admin panel:\r\n[admin link]\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [username],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">A new comment has been posted on the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[comment url]\">[comment url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The comment was made by [poster] and was as follows:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">[comment]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">This comment requires approval due to the following reason(s):</td>\r\n</tr>\r\n<tr>\r\n<td>[reason]</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Here is the link to your admin panel:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[admin link]\">[admin link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'comment_success', `subject` = 'Comment Success', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [username],\r\n\r\nA new comment has been posted on the page [page reference], located at the following address:\r\n[comment url]\r\n\r\nThe comment was made by [poster] and was as follows:\r\n\r\n************************\r\n\r\n[comment]\r\n\r\n************************\r\n\r\nThis comment does not require approval.\r\n\r\nHere is the link to your admin panel:\r\n[admin link]\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [username],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">A new comment has been posted on the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[comment url]\">[comment url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The comment was made by [poster] and was as follows:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">[comment]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">This comment does not require approval.</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Here is the link to your admin panel:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[admin link]\">[admin link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'flag', `subject` = '[username], a comment is flagged!', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [username],\r\n\r\nA new comment has been flagged on the page [page reference], located at the following address:\r\n[comment url]\r\n\r\nThe flagged comment was made by [poster] and was as follows:\r\n\r\n************************\r\n\r\n[comment]\r\n\r\n************************\r\n\r\nHere is the link to your admin panel:\r\n[admin link]\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [username],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">A new comment has been flagged on the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[comment url]\">[comment url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The flagged comment was made by [poster] and was as follows:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">[comment]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Here is the link to your admin panel:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[admin link]\">[admin link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'password_reset', `subject` = 'Password Reset', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [username],\r\n\r\nYour login details are listed below:\r\n\r\nUsername: [username]\r\nPassword: [password]\r\n\r\nHere is the link to your admin panel:\r\n[admin link]\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [username],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Your login details are listed below:</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\"><b>Username:</b></td><td style=\"padding-top:15px; padding-left:5px\">[username]</td>\r\n</tr>\r\n<tr>\r\n<td><b>Password:</b></td><td style=\"padding-left:5px\">[password]</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Here is the link to your admin panel:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[admin link]\">[admin link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'setup_test', `subject` = 'Setup Test', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [username],\r\n\r\nThis is a test email generated by the \'Settings -> Email -> Setup\' page.\r\n\r\nIf you have received this email, you have the correct email settings.\r\n\r\nHere is the link to your admin panel:\r\n[admin link]\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [username],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">This is a test email generated by the \'Settings -> Email -> Setup\' page.</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">If you have received this email, you have the correct email settings.</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Here is the link to your admin panel:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[admin link]\">[admin link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'subscriber_confirmation', `subject` = 'Subscription Confirmation', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [name],\r\n\r\nYou have requested a subscription to the page [page reference], located at the following address:\r\n[page url]\r\n\r\nPlease confirm this subscription by clicking the link below:\r\n[confirmation link]\r\n\r\nIf you did not request this subscription, there is nothing that you need to do.\r\n\r\nYou will not receive anymore emails of this type.\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [name],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">You have requested a subscription to the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[page url]\">[page url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Please confirm this subscription by clicking the link below:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[confirmation link]\">[confirmation link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">If you did not request this subscription, there is nothing that you need to do.</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">You will not receive anymore emails of this type.</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'subscriber_notification_admin', `subject` = '[name], the Admin has posted!', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [name],\r\n\r\nThe admin has posted a comment on the page [page reference], located at the following address:\r\n[comment url]\r\n\r\nThe comment was made by [poster] and was as follows:\r\n\r\n************************\r\n\r\n[comment]\r\n\r\n************************\r\n\r\nRegards,\r\n\r\n[signature]\r\n\r\nTo manage your subscription, click the link below:\r\n[user url]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [name],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The admin has posted a comment on the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[comment url]\">[comment url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The comment was made by [poster] and was as follows:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">[comment]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">To manage your subscription, click the link below:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[user url]\">[user url]</a></td>\r\n</tr>\r\n</table>', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'subscriber_notification_basic', `subject` = '[name], there\'s a new comment!', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [name],\r\n\r\nA new comment has been posted on the page [page reference], located at the following address:\r\n[comment url]\r\n\r\nThe comment was made by [poster] and was as follows:\r\n\r\n************************\r\n\r\n[comment]\r\n\r\n************************\r\n\r\nRegards,\r\n\r\n[signature]\r\n\r\nTo manage your subscription, click the link below:\r\n[user url]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [name],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">A new comment has been posted on the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[comment url]\">[comment url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The comment was made by [poster] and was as follows:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">[comment]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">To manage your subscription, click the link below:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[user url]\">[user url]</a></td>\r\n</tr>\r\n</table>', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'subscriber_notification_reply', `subject` = '[name], you have a reply!', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [name],\r\n\r\nYou have a reply on the page [page reference], located at the following address:\r\n[comment url]\r\n\r\nThe comment was made by [poster] and was as follows:\r\n\r\n************************\r\n\r\n[comment]\r\n\r\n************************\r\n\r\nRegards,\r\n\r\n[signature]\r\n\r\nTo manage your subscription, click the link below:\r\n[user url]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [name],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">You have a reply on the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[comment url]\">[comment url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The comment was made by [poster] and was as follows:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">[comment]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">To manage your subscription, click the link below:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[user url]\">[user url]</a></td>\r\n</tr>\r\n</table>', `language` = 'english', `date_modified` = NOW()");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'user_comment_approved', `subject` = '[name], your comment is approved!', `from_name` = '" . $this->db->escape($site_name) . "', `from_email` = 'comments@" . $this->db->escape($site_domain) . "', `reply_to` = 'no-reply@" . $this->db->escape($site_domain) . "', `text` = 'Hello [name],\r\n\r\nYour comment is now approved on the page [page reference], located at the following address:\r\n[comment url]\r\n\r\nThe comment that you posted was as follows:\r\n\r\n************************\r\n\r\n[comment]\r\n\r\n************************\r\n\r\nRegards,\r\n\r\n[signature]\r\n\r\nTo manage your preferences, click the link below:\r\n[user url]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [name],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Your comment is now approved on the page [page reference], located at the following address:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[comment url]\">[comment url]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">The comment that you posted was as follows:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">[comment]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding-top:15px\">************************</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">To manage your preferences, click the link below:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[user url]\">[user url]</a></td>\r\n</tr>\r\n</table>', `language` = 'english', `date_modified` = NOW()");

            /* Logins */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "logins`");
            $this->model_main_install_2->createTableLogins();

            /* Modules */
            $this->model_main_install_2->createTableModules();

            /* Pages */
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "pages` ADD `moderate` varchar(250) NOT NULL default 'default'");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "pages` ADD `date_modified` datetime NOT NULL");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "pages` CHANGE `dated` `date_added` datetime NOT NULL");

            /* Questions */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "questions`");
            $this->model_main_install_2->createTableQuestions();

            /* Ratings */
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "ratings` CHANGE `dated` `date_added` datetime NOT NULL");

            /* Reporters */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "reporters`");
            $this->model_main_install_2->createTableReporters();

            /* Settings */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "settings`");
            $this->model_main_install_2->createTableSettings($this->setting->get('site_name'), $this->setting->get('site_domain'), $this->setting->get('site_url'), $this->setting->get('security_key'), $this->setting->get('session_key'), $this->variable->random(), $this->variable->random(), $this->setting->get('time_zone'), $this->setting->get('commentics_folder'), $this->setting->get('commentics_url'), $this->setting->get('admin_folder'), 0, 'comment');
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $this->setting->get('maintenance_mode') . "' WHERE `title` = 'maintenance_mode'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('maintenance_message')) . "' WHERE `title` = 'maintenance_message'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '1' WHERE `title` = 'checklist_complete'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('transport_method')) . "' WHERE `title` = 'transport_method'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('smtp_host')) . "' WHERE `title` = 'smtp_host'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int) $this->setting->get('smtp_port') . "' WHERE `title` = 'smtp_port'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('smtp_encrypt')) . "' WHERE `title` = 'smtp_encrypt'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('smtp_username')) . "' WHERE `title` = 'smtp_username'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('smtp_password')) . "' WHERE `title` = 'smtp_password'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('sendmail_path')) . "' WHERE `title` = 'sendmail_path'");
            $this->setting->set('notify_format', 'html');
            $this->setting->set('notify_type', 'all');
            $this->setting->set('notify_approve', '1');

            /* States */
            $this->model_main_install_2->createTableStates();

            /* Subscriptions */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "subscribers`");
            $this->model_main_install_2->createTableSubscriptions();

            /* Uploads */
            $this->model_main_install_2->createTableUploads();

            /* Users */
            $this->model_main_install_2->createTableUsers();

            /* Version */
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "version` CHANGE `dated` `date_added` datetime NOT NULL");

            /* Viewers */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "viewers`");

            $this->db->query("CREATE TABLE IF NOT EXISTS `" . CMTX_DB_PREFIX . "viewers` (
                `id` int(10) unsigned NOT NULL auto_increment,
                `viewer` varchar(250) NOT NULL default '',
                `type` varchar(250) NOT NULL default '',
                `ip_address` varchar(250) NOT NULL default '',
                `page_reference` varchar(250) NOT NULL default '',
                `page_url` varchar(1000) NOT NULL default '',
                `time_added` int(50) unsigned NOT NULL default '0',
                PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

            /* Voters */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "voters`");
            $this->model_main_install_2->createTableVoters();

            /* Comments */
            if ($this->setting->get('enabled_smilies')) {
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/smile.gif\" title=\"Smile\" alt=\"Smile\" style=\"border-style: none; vertical-align: bottom;\" />', ':smile:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/sad.gif\" title=\"Sad\" alt=\"Sad\" style=\"border-style: none; vertical-align: bottom;\" />', ':sad:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/huh.gif\" title=\"Huh\" alt=\"Huh\" style=\"border-style: none; vertical-align: bottom;\" />', ':huh:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/laugh.gif\" title=\"Laugh\" alt=\"Laugh\" style=\"border-style: none; vertical-align: bottom;\" />', ':laugh:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/mad.gif\" title=\"Mad\" alt=\"Mad\" style=\"border-style: none; vertical-align: bottom;\" />', ':mad:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/tongue.gif\" title=\"Tongue\" alt=\"Tongue\" style=\"border-style: none; vertical-align: bottom;\" />', ':tongue:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/crying.gif\" title=\"Crying\" alt=\"Crying\" style=\"border-style: none; vertical-align: bottom;\" />', ':cry:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/grin.gif\" title=\"Grin\" alt=\"Grin\" style=\"border-style: none; vertical-align: bottom;\" />', ':grin:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/wink.gif\" title=\"Wink\" alt=\"Wink\" style=\"border-style: none; vertical-align: bottom;\" />', ':wink:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/scared.gif\" title=\"Scared\" alt=\"Scared\" style=\"border-style: none; vertical-align: bottom;\" />', ':scared:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/cool.gif\" title=\"Cool\" alt=\"Cool\" style=\"border-style: none; vertical-align: bottom;\" />', ':cool:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/sleep.gif\" title=\"Sleep\" alt=\"Sleep\" style=\"border-style: none; vertical-align: bottom;\" />', ':sleep:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/blush.gif\" title=\"Blush\" alt=\"Blush\" style=\"border-style: none; vertical-align: bottom;\" />', ':blush:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/unsure.gif\" title=\"Unsure\" alt=\"Unsure\" style=\"border-style: none; vertical-align: bottom;\" />', ':confused:')");
                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `comment` = REPLACE(`comment`, '<img src=\"" . $this->db->escape($this->setting->get('commentics_url')) . "images/smilies/shocked.gif\" title=\"Shocked\" alt=\"Shocked\" style=\"border-style: none; vertical-align: bottom;\" />', ':shocked:')");
            }

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` CHANGE `dated` `date_added` datetime NOT NULL");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` ADD `user_id` int(10) unsigned NOT NULL default '0'");

            $query = $this->db->query("SELECT DISTINCT(`name`) FROM `" . CMTX_DB_PREFIX . "comments` ORDER BY `name` ASC");

            $names = $this->db->rows($query);

            foreach ($names as $name) {
                $name = $name['name'];

                /* Get most commonly used email address for this name */
                $query = $this->db->query("SELECT `email`, COUNT(*) AS `frequency`
                                          FROM `" . CMTX_DB_PREFIX . "comments`
                                          WHERE `name` = '" . $this->db->escape($name) . "'
                                          GROUP BY `email`
                                          ORDER BY `frequency` DESC
                                          LIMIT 1
                                          ");

                $result = $this->db->row($query);

                $email = $result['email'];

                /* Get date of first comment by this name */
                $query = $this->db->query("SELECT `date_added`
                                          FROM `" . CMTX_DB_PREFIX . "comments`
                                          WHERE `name` = '" . $this->db->escape($name) . "'
                                          ORDER BY `date_added` ASC
                                          LIMIT 1
                                          ");

                $result = $this->db->row($query);

                $date_added = $result['date_added'];

                /* Get IP address of most recent comment by this name */
                $query = $this->db->query("SELECT `ip_address`
                                          FROM `" . CMTX_DB_PREFIX . "comments`
                                          WHERE `name` = '" . $this->db->escape($name) . "'
                                          ORDER BY `date_added` DESC
                                          LIMIT 1
                                          ");

                $result = $this->db->row($query);

                $ip_address = $result['ip_address'];

                $user_id = $this->user->createUser($name, $email, $this->variable->random(), $ip_address);

                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `date_added` = '" . $this->db->escape($date_added) . "' WHERE `id` = '" . (int) $user_id . "'");

                $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `user_id` = '" . (int) $user_id . "' WHERE `name` = '" . $this->db->escape($name) . "'");
            }

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` DROP COLUMN `name`, DROP COLUMN `email`, DROP COLUMN `country`");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` CHANGE `approval_reasoning` `notes` text NOT NULL");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` ADD `date_modified` datetime NOT NULL");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` ADD `state_id` int(10) NOT NULL default '0'");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` ADD `country_id` int(10) NOT NULL default '0'");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `website` = '' WHERE `website` = 'http://'");
        }

        if ($version == '3.0 -> 3.1') {
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'hide_replies', `value` = '1'");
        }

        if ($version == '3.1 -> 3.2') {
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'security', `title` = 'check_csrf', `value` = '1'");
        }

        if ($version == '3.2 -> 3.3') {
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'licence', `title` = 'licence', `value` = ''");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'licence', `title` = 'forum_user', `value` = ''");
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '1' WHERE `title` = 'enabled_powered_by'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'show_badge_top_poster', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'show_badge_most_likes', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'show_badge_first_poster', `value` = '1'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'form', `title` = 'enabled_email', `value` = '1'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'unique_name_enabled', `value` = '0'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'check_csrf'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'mysqldump_path'");

            if (file_exists(CMTX_DIR_ROOT . 'frontend/php.ini')) {
                @unlink(CMTX_DIR_ROOT . 'frontend/php.ini');
            }
        }

        if ($version == '3.3 -> 3.4') {
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'colorbox_source'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'font_awesome_source'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'notice', `title` = 'notice_tool_upgrade', `value` = '1'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'system', `title` = 'last_task', `value` = ''");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'system', `title` = 'new_version_notified', `value` = '0'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'theme', `title` = 'auto_detect', `value` = '0'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'theme', `title` = 'optimize', `value` = '1'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'pagination_type', `value` = 'multiple'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'show_social_google'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'show_social_stumbleupon'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'show_social_weibo', `value` = '0'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'show_share_google'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'show_share_stumbleupon'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'reply_indent'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'show_share_weibo', `value` = '0'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "emails` SET `type` = 'new_version', `subject` = 'New Version', `from_name` = '" . $this->db->escape($this->setting->get('site_name')) . "', `from_email` = 'comments@" . $this->db->escape($this->setting->get('site_domain')) . "', `reply_to` = 'no-reply@" . $this->db->escape($this->setting->get('site_domain')) . "', `text` = 'Hello [username],\r\n\r\nA newer version of Commentics is available.\r\n\r\nYour installed version is [installed version]. The newest version is [newest version].\r\n\r\nPlease upgrade at your earliest convenience.\r\n\r\nHere is the link to your admin panel:\r\n[admin link]\r\n\r\nRegards,\r\n\r\n[signature]', `html` = '<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td>Hello [username],</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">A newer version of Commentics is available.</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Your installed version is [installed version]. The newest version is [newest version].</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Please upgrade at your earliest convenience.</td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Here is the link to your admin panel:</td>\r\n</tr>\r\n<tr>\r\n<td><a href=\"[admin link]\">[admin link]</a></td>\r\n</tr>\r\n</table>\r\n\r\n<table style=\"border-collapse:collapse\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr>\r\n<td style=\"padding-top:15px\">Regards,</td>\r\n</tr>\r\n</table>\r\n\r\n[signature]', `language` = 'english', `date_modified` = NOW()");

            $this->db->query("CREATE TABLE IF NOT EXISTS `" . CMTX_DB_PREFIX . "geo` (
                `id` int(10) unsigned NOT NULL auto_increment,
                `name` varchar(250) NOT NULL default '',
                `country_code` varchar(3) NOT NULL default '',
                `language` varchar(250) NOT NULL default '',
                `date_added` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "countries`");

            $countries = $this->db->rows($query);

            foreach ($countries as $country) {
                $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "geo` SET `name` = '" . $country['name'] . "', `country_code` = '" . $country['code'] . "', `language` = 'english', `date_added` = NOW()");
            }

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "countries` DROP `name`");
        }

        if ($version == '3.4 -> 4.0') {
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'maximum_upload_total', `value` = '5'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'jquery_ui_source'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'notice_settings_admin_detection'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'recaptcha_type'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'recaptcha_language'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'cache', `title` = 'cache_type', `value` = ''");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'cache', `title` = 'cache_time', `value` = '86400'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'cache', `title` = 'cache_host', `value` = '127.0.0.1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'cache', `title` = 'cache_port', `value` = '11211'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'notice', `title` = 'notice_layout_comments_online', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'notice', `title` = 'notice_settings_viewers', `value` = '1'");

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` DROP `detect_admin`");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "admins` DROP `detect_method`");

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "viewers` ADD `page_id` int(10) unsigned NOT NULL default '0'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'show_online', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'online_refresh_enabled', `value` = '0'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'online_refresh_interval', `value` = '60'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'viewers_refresh'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'viewers_interval'");

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "pages` ADD `site_id` int(10) unsigned NOT NULL default '1'");

            $query = $this->db->query("SELECT `value` FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'site_name'");
            $result = $this->db->row($query);
            $site_name = $result['value'];

            $query = $this->db->query("SELECT `value` FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'site_domain'");
            $result = $this->db->row($query);
            $site_domain = $result['value'];

            $query = $this->db->query("SELECT `value` FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'site_url'");
            $result = $this->db->row($query);
            $site_url = $result['value'];

            $this->db->query("CREATE TABLE IF NOT EXISTS `" . CMTX_DB_PREFIX . "sites` (
                `id` int(10) unsigned NOT NULL auto_increment,
                `name` varchar(250) NOT NULL default '',
                `domain` varchar(250) NOT NULL default '',
                `url` varchar(250) NOT NULL default '',
                `iframe_enabled` tinyint(1) unsigned NOT NULL default '1',
                `new_pages` tinyint(1) unsigned NOT NULL default '1',
                `from_name` varchar(250) NOT NULL default '',
                `from_email` varchar(250) NOT NULL default '',
                `reply_email` varchar(250) NOT NULL default '',
                `date_modified` datetime NOT NULL,
                `date_added` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "sites` SET `id` = '1', `name` = '" . $this->db->escape($site_name) . "', `domain` = '" . $this->db->escape($site_domain) . "', `url` = '" . $this->db->escape($site_url) . "', `iframe_enabled` = '0', `new_pages` = '1', `date_modified` = NOW(), `date_added` = NOW()");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'rss_title'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'rss_link'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'rss_image_enabled'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'rss_image_url'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'rss_image_width'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'rss_image_height'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'scroll_reply'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'scroll_speed'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'show_read_more'");
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'read_more_limit'");

            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "emails` WHERE `type` = 'comment_success'");
            $result = $this->db->row($query);
            $from_name = $result['from_name'];
            $from_email = $result['from_email'];
            $reply_to = $result['reply_to'];

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'email', `title` = 'from_name', `value` = '" . $this->db->escape($from_name) . "'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'email', `title` = 'from_email', `value` = '" . $this->db->escape($from_email) . "'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'email', `title` = 'reply_email', `value` = '" . $this->db->escape($reply_to) . "'");

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "emails` DROP `from_name`");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "emails` DROP `from_email`");
            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "emails` DROP `reply_to`");

            /* Move any XML files from /system/modification/xml/ to /system/modification/ */
            if (file_exists(CMTX_DIR_MODIFICATION . 'xml/')) {
                $files = glob(CMTX_DIR_MODIFICATION . 'xml/*.xml');

                if ($files) {
                    foreach ($files as $file) {
                        @rename($file, CMTX_DIR_MODIFICATION . pathinfo($file, PATHINFO_BASENAME));
                    }
                }
            }

            /* Delete /system/modification/ folders */
            remove_directory(CMTX_DIR_MODIFICATION . 'cache/');
            remove_directory(CMTX_DIR_MODIFICATION . 'xml/');

            remove_directory(CMTX_DIR_3RDPARTY . 'filer/');
            remove_directory(CMTX_DIR_3RDPARTY . 'read_more/');

            remove_directory(CMTX_DIR_SYSTEM . 'database/');

            @unlink(CMTX_DIR_ROOT . 'frontend/view/default/javascript/common-jqui.min.js');
            @unlink(CMTX_DIR_ROOT . 'frontend/view/default/javascript/common-jq-jqui.min.js');
            @unlink(CMTX_DIR_ROOT . 'frontend/view/default/javascript/jquery/jquery-ui.min.js');
            @unlink(CMTX_DIR_ROOT . 'frontend/view/default/stylesheet/sass/partial/_jfiler.scss');

            $backend_folder = $this->getBackendFolder();
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/controller/layout_comments/comment.php');
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/controller/settings/admin_detection.php');
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/model/layout_comments/comment.php');
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/model/settings/admin_detection.php');
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/view/default/language/english/layout_comments/comment.php');
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/view/default/language/english/settings/admin_detection.php');
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/view/default/template/layout_comments/comment.tpl');
            @unlink(CMTX_DIR_ROOT . $backend_folder . '/view/default/template/settings/admin_detection.tpl');

            @unlink(CMTX_DIR_LIBRARY . 'db.php');
            @unlink(CMTX_DIR_CACHE . 'common_footer.tpl');
            @unlink(CMTX_DIR_CACHE . 'common_header.tpl');
            @unlink(CMTX_DIR_CACHE . 'main_comment.tpl');
            @unlink(CMTX_DIR_CACHE . 'main_comments.tpl');
            @unlink(CMTX_DIR_CACHE . 'main_form.tpl');
            @unlink(CMTX_DIR_CACHE . 'main_page.tpl');
            @unlink(CMTX_DIR_CACHE . 'main_user.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_average_rating.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_notify.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_page_number.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_pagination.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_rss.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_search.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_social.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_sort_by.tpl');
            @unlink(CMTX_DIR_CACHE . 'part_topic.tpl');
        }

        if ($version == '4.0 -> 4.1') {
            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'notice_layout_comments_online'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'notice', `title` = 'notice_manage_countries', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'notice', `title` = 'notice_add_question', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'notice', `title` = 'notice_edit_question', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'system', `title` = 'purpose', `value` = 'comment'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'average_rating_guest', `value` = '1'");

            $this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "data` WHERE `type` = 'admin_tips'");

            $this->db->query("ALTER TABLE `" . CMTX_DB_PREFIX . "comments` ADD `headline` varchar(250) NOT NULL default ''");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'form', `title` = 'enabled_headline', `value` = '0'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'form', `title` = 'default_headline', `value` = ''");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'form', `title` = 'required_headline', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'comments', `title` = 'show_headline', `value` = '0'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'headline_minimum_characters', `value` = '2'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'headline_minimum_words', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'headline_maximum_characters', `value` = '50'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'detect_link_in_headline_enabled', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'link_in_headline_action', `value` = 'approve'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'banned_websites_as_headline_enabled', `value` = '1'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'processor', `title` = 'banned_websites_as_headline_action', `value` = 'approve'");

            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'admin_panel', `title` = 'admin_detect', `value` = '0'");
            $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "settings` SET `category` = 'admin_panel', `title` = 'system_detect', `value` = '1'");            

            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `title` = 'gravatar_audience' WHERE `title` = 'gravatar_rating'");

            $backend_folder = $this->getBackendFolder();
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/controller/layout_comments/');
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/controller/layout_form/');
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/model/layout_comments/');
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/model/layout_form/');
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/view/default/language/english/layout_comments/');
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/view/default/language/english/layout_form/');
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/view/default/template/layout_comments/');
            remove_directory(CMTX_DIR_ROOT . $backend_folder . '/view/default/template/layout_form/');
        }
    }

    public function getInstalledVersion()
    {
        if ($this->db->numRows($this->db->query("SHOW COLUMNS FROM `" . CMTX_DB_PREFIX . "version` LIKE 'dated'"))) {
            /* For users upgrading from versions < v3.0 */
            $query = $this->db->query("SELECT `version` FROM `" . CMTX_DB_PREFIX . "version` ORDER BY `dated` DESC LIMIT 1");
        } else {
            $query = $this->db->query("SELECT `version` FROM `" . CMTX_DB_PREFIX . "version` ORDER BY `date_added` DESC LIMIT 1");
        }

        $result = $this->db->row($query);

        return $result['version'];
    }

    public function setVersion()
    {
        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "version` SET `version` = '" . $this->db->escape(CMTX_VERSION) . "', `type` = 'Upgrade', `date_added` = NOW()");

        if (version_compare(CMTX_VERSION, 3.4, '>')) {
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '0' WHERE `title` = 'new_version_notified'");
        }
    }

    public function getBackendFolder()
    {
        $query = $this->db->query("SELECT `value` FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'backend_folder'");

        $result = $this->db->row($query);

        return $result['value'];
    }
}
