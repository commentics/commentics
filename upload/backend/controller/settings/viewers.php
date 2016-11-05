<?php
namespace Commentics;

class SettingsViewersController extends Controller {
	public function index() {
		$this->loadLanguage('settings/viewers');

		$this->loadModel('settings/viewers');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->validate()) {
				$this->model_settings_viewers->update($this->request->post);
			}
		}

		if (isset($this->request->post['viewers_enabled'])) {
			$this->data['viewers_enabled'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['viewers_enabled'])) {
			$this->data['viewers_enabled'] = false;
		} else {
			$this->data['viewers_enabled'] = $this->setting->get('viewers_enabled');
		}

		if (isset($this->request->post['viewers_timeout'])) {
			$this->data['viewers_timeout'] = $this->request->post['viewers_timeout'];
		} else {
			$this->data['viewers_timeout'] = $this->setting->get('viewers_timeout');
		}

		if (isset($this->request->post['viewers_refresh'])) {
			$this->data['viewers_refresh'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['viewers_refresh'])) {
			$this->data['viewers_refresh'] = false;
		} else {
			$this->data['viewers_refresh'] = $this->setting->get('viewers_refresh');
		}

		if (isset($this->request->post['viewers_interval'])) {
			$this->data['viewers_interval'] = $this->request->post['viewers_interval'];
		} else {
			$this->data['viewers_interval'] = $this->setting->get('viewers_interval');
		}

		if (isset($this->error['viewers_timeout'])) {
			$this->data['error_viewers_timeout'] = $this->error['viewers_timeout'];
		} else {
			$this->data['error_viewers_timeout'] = '';
		}

		if (isset($this->error['viewers_interval'])) {
			$this->data['error_viewers_interval'] = $this->error['viewers_interval'];
		} else {
			$this->data['error_viewers_interval'] = '';
		}

		$this->components = array('common/header', 'common/footer');

		$this->loadView('settings/viewers');
	}

	private function validate() {
		$this->loadModel('common/poster');

		$unpostable = $this->model_common_poster->unpostable($this->data);

		if ($unpostable) {
			$this->data['error'] = $unpostable;

			return false;
		}

		if (!isset($this->request->post['viewers_timeout']) || !$this->validation->isInt($this->request->post['viewers_timeout']) || $this->request->post['viewers_timeout'] < 1 || $this->request->post['viewers_timeout'] > 10000) {
			$this->error['viewers_timeout'] = sprintf($this->data['lang_error_range'], 1, 10000);
		}

		if (!isset($this->request->post['viewers_interval']) || !$this->validation->isInt($this->request->post['viewers_interval']) || $this->request->post['viewers_interval'] < 10 || $this->request->post['viewers_interval'] > 1000) {
			$this->error['viewers_interval'] = sprintf($this->data['lang_error_range'], 10, 1000);
		}

		if ($this->error) {
			$this->data['error'] = $this->data['lang_message_error'];

			return false;
		} else {
			$this->data['success'] = $this->data['lang_message_success'];

			return true;
		}
	}
}
?>