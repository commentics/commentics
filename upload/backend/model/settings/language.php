<?php
namespace Commentics;

class SettingsLanguageModel extends Model {
	public function update($data) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['language_frontend']) . "' WHERE `title` = 'language_frontend'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['language_backend']) . "' WHERE `title` = 'language_backend'");
	}
}
?>