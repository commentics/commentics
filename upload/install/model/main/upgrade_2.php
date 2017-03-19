<?php
namespace Commentics;

class MainUpgrade2Model extends Model {
	public function upgrade($version) {
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
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int)$this->setting->get('maintenance_mode') . "' WHERE `title` = 'maintenance_mode'");
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('maintenance_message')) . "' WHERE `title` = 'maintenance_message'");
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '1' WHERE `title` = 'checklist_complete'");
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('transport_method')) . "' WHERE `title` = 'transport_method'");
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($this->setting->get('smtp_host')) . "' WHERE `title` = 'smtp_host'");
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int)$this->setting->get('smtp_port') . "' WHERE `title` = 'smtp_port'");
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

				$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "users` SET `date_added` = '" . $this->db->escape($date_added) . "' WHERE `id` = '" . (int)$user_id . "'");

				$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "comments` SET `user_id` = '" . (int)$user_id . "' WHERE `name` = '" . $this->db->escape($name) . "'");
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
	}

	public function getInstalledVersion() {
		if ($this->db->numRows($this->db->query("SHOW COLUMNS FROM `" . CMTX_DB_PREFIX . "version` LIKE 'dated'"))) {
			/* For users upgrading from versions < v3.0 */
			$query = $this->db->query("SELECT `version` FROM `" . CMTX_DB_PREFIX . "version` ORDER BY `dated` DESC LIMIT 1");
		} else {
			$query = $this->db->query("SELECT `version` FROM `" . CMTX_DB_PREFIX . "version` ORDER BY `date_added` DESC LIMIT 1");
		}

		$result = $this->db->row($query);

		return $result['version'];
	}

	public function setVersion() {
		$this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "version` SET `version` = '" . $this->db->escape(CMTX_VERSION) . "', `type` = 'Upgrade', `date_added` = NOW()");
	}

	public function getBackendFolder() {
		$query = $this->db->query("SELECT `value` FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` = 'backend_folder'");

		$result = $this->db->row($query);

		return $result['value'];
	}
}
?>