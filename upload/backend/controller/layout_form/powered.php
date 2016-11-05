<?php
namespace Commentics;

class LayoutFormPoweredController extends Controller {
	public function index() {
		$this->loadLanguage('layout_form/powered');

		$this->loadModel('layout_form/powered');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->validate()) {
				$this->model_layout_form_powered->update($this->request->post);
			}
		}

		if (isset($this->request->post['enabled_powered_by'])) {
			$this->data['enabled_powered_by'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_powered_by'])) {
			$this->data['enabled_powered_by'] = false;
		} else {
			$this->data['enabled_powered_by'] = $this->setting->get('enabled_powered_by');
		}

		if (isset($this->request->post['powered_by_type'])) {
			$this->data['powered_by_type'] = $this->request->post['powered_by_type'];
		} else {
			$this->data['powered_by_type'] = $this->setting->get('powered_by_type');
		}

		if (isset($this->request->post['powered_by_new_window'])) {
			$this->data['powered_by_new_window'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['powered_by_new_window'])) {
			$this->data['powered_by_new_window'] = false;
		} else {
			$this->data['powered_by_new_window'] = $this->setting->get('powered_by_new_window');
		}

		if (isset($this->error['powered_by_type'])) {
			$this->data['error_powered_by_type'] = $this->error['powered_by_type'];
		} else {
			$this->data['error_powered_by_type'] = '';
		}

		$this->data['lang_dialog_confirm_title'] = $this->variable->encodeDouble($this->data['lang_dialog_confirm_title']);

		$this->data['lang_dialog_yes'] = $this->variable->escapeSingle($this->data['lang_text_yes']);

		$this->data['lang_dialog_no'] = $this->variable->escapeSingle($this->data['lang_text_no']);

		$this->data['link_back'] = $this->url->link('settings/layout_form');

		$this->data['info'] = sprintf($this->data['lang_notice'], 'https://www.commentics.org/donate');

		$this->data['lang_dialog_confirm_content'] = sprintf($this->data['lang_dialog_confirm_content'], 'https://www.commentics.org/donate');

		$this->components = array('common/header', 'common/footer');

		$this->loadView('layout_form/powered');
	}

	private function validate() {
		$this->loadModel('common/poster');

		$unpostable = $this->model_common_poster->unpostable($this->data);

		if ($unpostable) {
			$this->data['error'] = $unpostable;

			return false;
		}

		if (!isset($this->request->post['powered_by_type']) || !in_array($this->request->post['powered_by_type'], array('text', 'image'))) {
			$this->error['powered_by_type'] = $this->data['lang_error_selection'];
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