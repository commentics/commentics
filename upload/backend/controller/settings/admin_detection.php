<?php
namespace Commentics;

class SettingsAdminDetectionController extends Controller {
	public function index() {
		$this->loadLanguage('settings/admin_detection');

		$this->loadModel('settings/admin_detection');

		$this->loadModel('common/administrator');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->validate()) {
				$this->model_settings_admin_detection->update($this->request->post, $this->session->data['cmtx_admin_id']);
			}
		}

		$admin = $this->model_common_administrator->getAdmin($this->session->data['cmtx_admin_id']);

		if (isset($this->request->post['detect_admin'])) {
			$this->data['detect_admin'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['detect_admin'])) {
			$this->data['detect_admin'] = false;
		} else {
			$this->data['detect_admin'] = $admin['detect_admin'];
		}

		if (isset($this->request->post['detect_method'])) {
			$this->data['detect_method'] = $this->request->post['detect_method'];
		} else {
			$this->data['detect_method'] = $admin['detect_method'];
		}

		if (isset($this->request->post['ip_address'])) {
			$this->data['ip_address'] = $this->request->post['ip_address'];
		} else {
			$this->data['ip_address'] = $admin['ip_address'];
		}

		if (isset($this->request->post['cookie']) && $this->request->post['cookie'] == '1' && !$this->error) {
			$this->data['value'] = '0';

			$this->data['lang_entry_cookie'] = $this->data['lang_entry_del_cookie'];
		} else if (isset($this->request->post['cookie']) && $this->request->post['cookie'] == '0' && !$this->error) {
			$this->data['value'] = '1';

			$this->data['lang_entry_cookie'] = $this->data['lang_entry_add_cookie'];
		} else if ($this->model_settings_admin_detection->cookieExists()) {
			$this->data['value'] = '0';

			$this->data['lang_entry_cookie'] = $this->data['lang_entry_del_cookie'];
		} else {
			$this->data['value'] = '1';

			$this->data['lang_entry_cookie'] = $this->data['lang_entry_add_cookie'];
		}

		if (isset($this->request->post['cookie']) && $this->error) {
			$this->data['cookie'] = true;
		} else {
			$this->data['cookie'] = false;
		}

		if (isset($this->error['detect_method'])) {
			$this->data['error_detect_method'] = $this->error['detect_method'];
		} else {
			$this->data['error_detect_method'] = '';
		}

		if (isset($this->error['ip_address'])) {
			$this->data['error_ip_address'] = $this->error['ip_address'];
		} else {
			$this->data['error_ip_address'] = '';
		}

		if ($this->setting->get('notice_settings_admin_detection')) {
			$this->data['info'] = sprintf($this->data['lang_notice'], 'https://www.commentics.org/wiki/doku.php?id=admin:settings/admin_detection');
		}

		$this->components = array('common/header', 'common/footer');

		$this->loadView('settings/admin_detection');
	}

	public function dismiss() {
		$this->loadModel('settings/admin_detection');

		$this->model_settings_admin_detection->dismiss();
	}

	private function validate() {
		$this->loadModel('common/poster');

		$unpostable = $this->model_common_poster->unpostable($this->data);

		if ($unpostable) {
			$this->data['error'] = $unpostable;

			return false;
		}

		if (!isset($this->request->post['detect_method']) || !in_array($this->request->post['detect_method'], array('ip_address', 'cookie', 'either', 'both'))) {
			$this->error['detect_method'] = $this->data['lang_error_selection'];
		}

		if (!isset($this->request->post['ip_address']) || !$this->validation->isIpAddress($this->request->post['ip_address'])) {
			$this->error['ip_address'] = $this->data['lang_error_ip_address'];
		}

		if (!isset($this->request->post['ip_address']) || $this->validation->length($this->request->post['ip_address']) < 1 || $this->validation->length($this->request->post['ip_address']) > 250) {
			$this->error['ip_address'] = sprintf($this->data['lang_error_length'], 1, 250);
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