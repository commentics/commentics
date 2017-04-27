<?php
namespace Commentics;

class MainDashboardModel extends Model {
	public function getLatestVersion() {
		$url = 'http://www.commentics.org/version.txt';

		ini_set('user_agent', 'Commentics');

		$latest_version = '';

		if (extension_loaded('curl')) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Commentics');
			curl_setopt($ch, CURLOPT_URL, $url);

			$latest_version = curl_exec($ch);

			curl_close($ch);
		} else if ((bool)ini_get('allow_url_fopen')) {
			$latest_version = file_get_contents($url);
		}

		return $latest_version;
	}

	public function getCurrentVersion() {
		$query = $this->db->query("SELECT `version` FROM `" . CMTX_DB_PREFIX . "version` ORDER BY `date_added` DESC LIMIT 1");

		$result = $this->db->row($query);

		return $result['version'];
	}

	public function getLastLogin() {
		$query = $this->db->query("SELECT `date_modified` FROM `" . CMTX_DB_PREFIX . "logins` ORDER BY `date_modified` ASC LIMIT 1");

		$result = $this->db->row($query);

		return $result['date_modified'];
	}

	public function getNumCommentsApprove() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments` WHERE `is_approved` = '0'"));
	}

	public function getNumCommentsFlagged() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments` WHERE `reports` >= '" . (int)$this->setting->get('flag_min_per_comment') . "'"));
	}

	public function getNumCommentsNew() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments` WHERE `date_added` LIKE '" . $this->db->escape(date('Y-m-d')) . "%'"));
	}

	public function getNumSubscriptionsNew() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `date_added` LIKE '" . $this->db->escape(date('Y-m-d')) . "%'"));
	}

	public function getNumBansNew() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "bans` WHERE `unban` = '0' AND `date_added` LIKE '" . $this->db->escape(date('Y-m-d')) . "%'"));
	}

	public function getNumCommentsTotal() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments`"));
	}

	public function getNumSubscriptionsTotal() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions`"));
	}

	public function getNumBansTotal() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "bans` WHERE `unban` = '0'"));
	}

	public function getNumPagesTotal() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "pages`"));
	}

	public function getNumAdminsTotal() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "admins`"));
	}

	public function getNumUsersTotal() {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "users`"));
	}

	public function getTipOfTheDay() {
		$query = $this->db->query("SELECT `text` FROM `" . CMTX_DB_PREFIX . "data` WHERE `type` = 'admin_tips'");

		$result = $this->db->row($query);

		$tips = $result['text'];

		$tips = explode("\r\n", $tips);

		$amount = count($tips);

		$day = date('z');

		$position = (int)$day % $amount;

		$tip = $tips[$position];

		return $tip;
	}

	public function getNews() {
		$url = 'http://www.commentics.org/news.txt';

		ini_set('user_agent', 'Commentics');

		$news = '';

		if (extension_loaded('curl')) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Commentics');
			curl_setopt($ch, CURLOPT_URL, $url);

			$news = curl_exec($ch);

			curl_close($ch);
		} else if ((bool)ini_get('allow_url_fopen')) {
			$news = file_get_contents($url);
		}

		return $news;
	}

	public function getSponsors() {
		$url = 'http://www.commentics.org/sponsors.php';

		ini_set('user_agent', 'Commentics');

		$sponsors = '';

		if (extension_loaded('curl')) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Commentics');
			curl_setopt($ch, CURLOPT_URL, $url);

			$sponsors = curl_exec($ch);

			curl_close($ch);
		} else if ((bool)ini_get('allow_url_fopen')) {
			$sponsors = file_get_contents($url);
		}

		return $sponsors;
	}

	public function getQuickLinks() {
		$query = $this->db->query("SELECT `page`, COUNT(*) AS `frequency` FROM `" . CMTX_DB_PREFIX . "access` WHERE `page` NOT IN ('main/dashboard', 'extension/modules/install', 'extension/modules/uninstall', 'settings/email_editor', 'data/list', 'spam') AND `page` NOT LIKE 'edit%' GROUP BY `page` ORDER BY `frequency` DESC LIMIT 5");

		if ($this->db->numRows($query) == 5) {
			$result = $this->db->rows($query);

			return $result;
		} else {
			return array();
		}
	}

	public function getChartComments() {
		$chart_comments = array();

		$chart_comments['jan'] = $this->getCommentsByMonth('01');
		$chart_comments['feb'] = $this->getCommentsByMonth('02');
		$chart_comments['mar'] = $this->getCommentsByMonth('03');
		$chart_comments['apr'] = $this->getCommentsByMonth('04');
		$chart_comments['may'] = $this->getCommentsByMonth('05');
		$chart_comments['jun'] = $this->getCommentsByMonth('06');
		$chart_comments['jul'] = $this->getCommentsByMonth('07');
		$chart_comments['aug'] = $this->getCommentsByMonth('08');
		$chart_comments['sep'] = $this->getCommentsByMonth('09');
		$chart_comments['oct'] = $this->getCommentsByMonth('10');
		$chart_comments['nov'] = $this->getCommentsByMonth('11');
		$chart_comments['dec'] = $this->getCommentsByMonth('12');

		return $chart_comments;
	}

	public function getChartSubscriptions() {
		$chart_subscriptions = array();

		$chart_subscriptions['jan'] = $this->getSubscriptionsByMonth('01');
		$chart_subscriptions['feb'] = $this->getSubscriptionsByMonth('02');
		$chart_subscriptions['mar'] = $this->getSubscriptionsByMonth('03');
		$chart_subscriptions['apr'] = $this->getSubscriptionsByMonth('04');
		$chart_subscriptions['may'] = $this->getSubscriptionsByMonth('05');
		$chart_subscriptions['jun'] = $this->getSubscriptionsByMonth('06');
		$chart_subscriptions['jul'] = $this->getSubscriptionsByMonth('07');
		$chart_subscriptions['aug'] = $this->getSubscriptionsByMonth('08');
		$chart_subscriptions['sep'] = $this->getSubscriptionsByMonth('09');
		$chart_subscriptions['oct'] = $this->getSubscriptionsByMonth('10');
		$chart_subscriptions['nov'] = $this->getSubscriptionsByMonth('11');
		$chart_subscriptions['dec'] = $this->getSubscriptionsByMonth('12');

		return $chart_subscriptions;
	}

	/* Sends completely anonymous data to Commentics.org once a day */
	public function callHome() {
		$last_call = $this->setting->get('last_call');

		$date = date('Y-m-d');

		if ($last_call != $date) {
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($date) . "' WHERE `title` = 'last_call'");

			$url = 'http://www.commentics.org/call_home.php';

			$data = array('site_id'          => $this->setting->get('site_id'),
						  'version'          => CMTX_VERSION,
						  'online'           => (in_array($this->user->getIpAddress(), array('127.0.0.1', '::1')) ? 0 : 1),
						  'admins'           => $this->getNumAdminsTotal(),
						  'bans'             => $this->getNumBansTotal(),
						  'comments'         => $this->getNumCommentsTotal(),
						  'pages'            => $this->getNumPagesTotal(),
						  'subscriptions'    => $this->getNumSubscriptionsTotal(),
						  'users'            => $this->getNumUsersTotal(),
						  'akismet_enabled'  => ($this->setting->has('akismet_enabled') && $this->setting->get('akismet_enabled') ? 1 : 0),
						  'chart_enabled'    => ($this->setting->has('chart_enabled') && $this->setting->get('chart_enabled') ? 1 : 0),
						  'snippets_enabled' => ($this->setting->has('rich_snippets_enabled') && $this->setting->get('rich_snippets_enabled') ? 1 : 0),
						  'default_theme'    => ($this->setting->get('theme_frontend') == 'default' ? 1 : 0),
						  'powered'          => $this->setting->get('enabled_powered_by'),
						  'os'               => php_uname('s'),
						  'php'              => PHP_VERSION,
						  'db'               => $this->db->getServerInfo()
						);

			$url .= '?' . http_build_query($data);

			ini_set('user_agent', 'Commentics');

			if (extension_loaded('curl')) {
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Commentics');
				curl_setopt($ch, CURLOPT_URL, $url);

				$result = curl_exec($ch);

				curl_close($ch);
			} else if ((bool)ini_get('allow_url_fopen')) {
				$result = file_get_contents($url);
			}
		}
	}

	public function getNotes() {
		$query = $this->db->query("SELECT `text` FROM `" . CMTX_DB_PREFIX . "data` WHERE `type` = 'admin_notes'");

		$result = $this->db->row($query);

		return $result['text'];
	}

	public function update($data, $username) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "data` SET `text` = '" . $this->db->escape($data['notes']) . "', `modified_by` = '" . $this->db->escape($username) . "', `date_modified` = NOW() WHERE `type` = 'admin_notes'");
	}

	public function hasErrors() {
		if (file_exists(CMTX_DIR_LOGS . 'errors.log') && filesize(CMTX_DIR_LOGS . 'errors.log')) {
			return true;
		} else {
			return false;
		}
	}

	private function getCommentsByMonth($month) {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments` WHERE `date_added` LIKE '" . $this->db->escape(date('Y') . '-' . $month . '-%') . "'"));
	}

	private function getSubscriptionsByMonth($month) {
		return $this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `date_added` LIKE '" . $this->db->escape(date('Y') . '-' . $month . '-%') . "'"));
	}
}
?>