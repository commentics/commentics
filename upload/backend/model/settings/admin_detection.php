<?php
namespace Commentics;

class SettingsAdminDetectionModel extends Model {
	public function cookieExists() {
		return $this->cookie->exists('Commentics-Admin');
	}

	public function update($data, $admin_id) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "admins` SET `detect_admin` = '" . (isset($data['detect_admin']) ? 1 : 0) . "', `detect_method` = '" . $this->db->escape($data['detect_method']) . "', `ip_address` = '" . $this->db->escape($data['ip_address']) . "' WHERE `id` = '" . (int)$admin_id . "'");

		if (isset($data['cookie'])) {
			if ($this->cookie->exists('Commentics-Admin')) {
				$this->cookie->delete('Commentics-Admin');
			} else {
				$this->cookie->set('Commentics-Admin', $this->getCookieKey($admin_id), 60 * 60 * 24 * $this->setting->get('admin_cookie_days') + time());
			}
		}
	}

	public function dismiss() {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '0' WHERE `title` = 'notice_settings_admin_detection'");
	}

	private function getCookieKey($admin_id) {
		$query = $this->db->query("SELECT `cookie_key` FROM `" . CMTX_DB_PREFIX . "admins` WHERE `id` = '" . (int)$admin_id . "'");

		$result = $this->db->row($query);

		return $result['cookie_key'];
	}
}
?>