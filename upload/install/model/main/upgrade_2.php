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
            $this->model_main_install_2->createTableCountries();

            /* Data */
            $this->model_main_install_2->createTableData($this->setting->get('site_name'), $this->setting->get('site_url'));

            /* Emails */
            $this->model_main_install_2->createTableEmails($this->setting->get('site_name'), $this->setting->get('site_domain'));

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
            $this->model_main_install_2->createTableSettings($this->setting->get('site_name'), $this->setting->get('site_domain'), $this->setting->get('site_url'), $this->setting->get('security_key'), $this->setting->get('session_key'), $this->variable->random(), $this->variable->random(), $this->setting->get('time_zone'), $this->setting->get('commentics_folder'), $this->setting->get('commentics_url'), $this->setting->get('admin_folder'), 0);
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
            $this->model_main_install_2->createTableViewers();

            /* Voters */
            $this->db->query("DROP TABLE IF EXISTS `" . CMTX_DB_PREFIX . "voters`");
            $this->model_main_install_2->createTableVoters();

            /* Comments */
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
            $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `website` = '' WHERE `website` = 'http://'");
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
