<?php
namespace Commentics;

class SettingsViewersModel extends Model {
	public function update($data) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['viewers_enabled']) ? 1 : 0) . "' WHERE `title` = 'viewers_enabled'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int)$data['viewers_timeout'] . "' WHERE `title` = 'viewers_timeout'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['viewers_refresh']) ? 1 : 0) . "' WHERE `title` = 'viewers_refresh'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int)$data['viewers_interval'] . "' WHERE `title` = 'viewers_interval'");

		if (!isset($data['viewers_enabled'])) {
			$this->db->query("TRUNCATE TABLE `" . CMTX_DB_PREFIX . "viewers`");
		}
	}
}
?>