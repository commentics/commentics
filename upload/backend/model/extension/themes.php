<?php
namespace Commentics;

class ExtensionThemesModel extends Model {
	public function update($data) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['theme_frontend']) . "' WHERE `title` = 'theme_frontend'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['theme_backend']) . "' WHERE `title` = 'theme_backend'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['jquery_source']) . "' WHERE `title` = 'jquery_source'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['jquery_ui_source']) . "' WHERE `title` = 'jquery_ui_source'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['font_awesome_source']) . "' WHERE `title` = 'font_awesome_source'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['colorbox_source']) . "' WHERE `title` = 'colorbox_source'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['order_parts']) . "' WHERE `title` = 'order_parts'");
	}

	public function getFrontendThemes() {
		$themes = array();

		foreach (glob(CMTX_DIR_ROOT . 'frontend/view/*', GLOB_ONLYDIR) as $directory) {
			$theme = basename($directory);

			$theme_name = $this->getFriendlyThemeName($theme);

			$themes[$theme_name] = $this->variable->strtolower($theme);
		}

		return $themes;
	}

	public function getBackendThemes() {
		$themes = array();

		foreach (glob(CMTX_DIR_VIEW . '*', GLOB_ONLYDIR) as $directory) {
			$theme = basename($directory);

			$theme_name = $this->getFriendlyThemeName($theme);

			$themes[$theme_name] = $this->variable->strtolower($theme);
		}

		return $themes;
	}

	private function getFriendlyThemeName($theme) {
		$theme = str_replace('_', ' ', $theme);

		$theme = $this->variable->fixCase($theme);

		return $theme;
	}
}
?>