<?php
namespace Commentics;

abstract class Controller extends Base {
	public function loadView($cmtx_view) {
		foreach ($this->components as $cmtx_component) {
			$this->data[basename($cmtx_component)] = $this->getComponent($cmtx_component);
		}

		if (!isset($this->data['success'])) {
			$this->data['success'] = '';
		}

		if (!isset($this->data['info'])) {
			$this->data['info'] = '';
		}

		if (!isset($this->data['error'])) {
			$this->data['error'] = '';
		}

		if (!isset($this->data['warning'])) {
			$this->data['warning'] = '';
		}

		foreach ($this->data as $cmtx_key => &$cmtx_value) {
			if (substr($cmtx_key, 0, 10) == 'lang_hint_') {
				$cmtx_value = $this->variable->hint($cmtx_value);
			}
		}

		$generated_time = microtime(true) - CMTX_START_TIME;

		$this->data['generated_time'] = round($generated_time, 5);

		$this->data['php_time'] = round($generated_time - $this->db->getQueryTime(), 5);

		$this->data['query_time'] = round($this->db->getQueryTime(), 5);

		$this->data['query_count'] = $this->db->getQueryCount();

		unset($cmtx_component, $cmtx_key, $cmtx_value, $generated_time);

		extract($this->data);

		if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_view) . '.tpl')) {
			require_once(cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_view) . '.tpl'));
		} else if (file_exists(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_view) . '.tpl')) {
			require_once(cmtx_modification(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_view) . '.tpl'));
		} else {
			die('<b>Error</b>: Could not load view ' . strtolower($cmtx_view) . '!');
		}
	}

	public function getComponent($cmtx_component, $cmtx_component_data = array()) {
		if (file_exists(CMTX_DIR_CONTROLLER . strtolower($cmtx_component) . '.php')) {
			require_once(cmtx_modification(CMTX_DIR_CONTROLLER . strtolower($cmtx_component) . '.php'));

			$class = '\Commentics\\' . str_replace('/', '', $cmtx_component) . 'Controller';

			$class = str_replace('_', '', $class);

			$controller = new $class($this->registry);

			$this->data = array_merge($this->data, $controller->index($cmtx_component_data));
		}

		extract($this->data);

		ob_start();

		if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_component) . '.tpl')) {
			require_once(cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_component) . '.tpl'));
		} else if (file_exists(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_component) . '.tpl')) {
			require_once(cmtx_modification(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_component) . '.tpl'));
		} else {
			return;
		}

		return ob_get_clean();
	}

	public function loadLanguage($cmtx_language) {
		if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/general.php')) {
			require(cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/general.php'));
		} else if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/general.php')) {
			require(cmtx_modification(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/general.php'));
		} else if (file_exists(CMTX_DIR_VIEW . 'default/language/english/general.php')) {
			require(cmtx_modification(CMTX_DIR_VIEW . 'default/language/english/general.php'));
		}

		if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php')) {
			require_once(cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php'));
		} else if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php')) {
			require_once(cmtx_modification(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php'));
		} else if (file_exists(CMTX_DIR_VIEW . 'default/language/english/' . strtolower($cmtx_language) . '.php')) {
			require_once(cmtx_modification(CMTX_DIR_VIEW . 'default/language/english/' . strtolower($cmtx_language) . '.php'));
		} else {
			die('<b>Error</b>: Could not load language ' . strtolower($cmtx_language) . '!');
		}

		$this->data = array_merge($this->data, $_);
	}
}
?>