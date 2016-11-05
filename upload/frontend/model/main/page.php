<?php
namespace Commentics;

class MainPageModel extends Model {
	public function addViewer() {
		$viewer = $this->identifyViewer();
		$ip_address = $this->user->getIpAddress();
		$page_reference = $this->page->getReference();
		$page_url = $this->url->getPageUrl();
		$timestamp = time();

		$timeout = $timestamp - $this->setting->get('viewers_timeout');

		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "viewers` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' OR `time_added` < '" . (int)$timeout . "'");

		$this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "viewers` SET `viewer` = '" . $this->db->escape($viewer['viewer']) . "', `type` = '" . $this->db->escape($viewer['type']) . "', `ip_address` = '" . $this->db->escape($ip_address) . "', `page_reference` = '" . $this->db->escape($page_reference) . "', `page_url` = '" . $this->db->escape($page_url) . "', `time_added` = '" . (int)$timestamp . "'");
	}

	private function identifyViewer() {
		$user_agent = $this->user->getUserAgent();

		if (stristr($user_agent, 'ia_archiver')) {
			$viewer = 'alexa.png';
			$type = 'Alexa Internet';
		} else if (stristr($user_agent, 'AOL')) {
			$viewer = 'aol.png';
			$type = 'AOL';
		} else if (stristr($user_agent, 'Ask Jeeves')) {
			$viewer = 'ask.png';
			$type = 'Ask Jeeves';
		} else if (stristr($user_agent, 'Baidu')) {
			$viewer = 'baidu.png';
			$type = 'Baidu';
		} else if (stristr($user_agent, 'Bingbot')) {
			$viewer = 'bing.png';
			$type = 'Bing';
		} else if (stristr($user_agent, 'Googlebot')) {
			$viewer = 'google.png';
			$type = 'Google';
		} else if (stristr($user_agent, 'Yahoo')) {
			$viewer = 'yahoo.png';
			$type = 'Yahoo';
		} else if (stristr($user_agent, 'Yandex')) {
			$viewer = 'yandex.png';
			$type = 'Yandex';
		} else {
			$viewer = 'person.png';
			$type = 'Person';
		}

		$viewer = array(
			'viewer'	=> $viewer,
			'type'		=> $type
		);

		return $viewer;
	}
}
?>