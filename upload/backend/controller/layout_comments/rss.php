<?php
namespace Commentics;

class LayoutCommentsRssController extends Controller {
	public function index() {
		$this->loadLanguage('layout_comments/rss');

		$this->loadModel('layout_comments/rss');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->validate()) {
				$this->model_layout_comments_rss->update($this->request->post);
			}
		}

		if (isset($this->request->post['show_rss'])) {
			$this->data['show_rss'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_rss'])) {
			$this->data['show_rss'] = false;
		} else {
			$this->data['show_rss'] = $this->setting->get('show_rss');
		}

		if (isset($this->request->post['rss_new_window'])) {
			$this->data['rss_new_window'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['rss_new_window'])) {
			$this->data['rss_new_window'] = false;
		} else {
			$this->data['rss_new_window'] = $this->setting->get('rss_new_window');
		}

		if (isset($this->request->post['rss_title'])) {
			$this->data['rss_title'] = $this->request->post['rss_title'];
		} else {
			$this->data['rss_title'] = $this->setting->get('rss_title');
		}

		if (isset($this->request->post['rss_link'])) {
			$this->data['rss_link'] = $this->request->post['rss_link'];
		} else {
			$this->data['rss_link'] = $this->setting->get('rss_link');
		}

		if (isset($this->request->post['rss_image_enabled'])) {
			$this->data['rss_image_enabled'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['rss_image_enabled'])) {
			$this->data['rss_image_enabled'] = false;
		} else {
			$this->data['rss_image_enabled'] = $this->setting->get('rss_image_enabled');
		}

		if (isset($this->request->post['rss_image_url'])) {
			$this->data['rss_image_url'] = $this->request->post['rss_image_url'];
		} else {
			$this->data['rss_image_url'] = $this->setting->get('rss_image_url');
		}

		if (isset($this->request->post['rss_image_width'])) {
			$this->data['rss_image_width'] = $this->request->post['rss_image_width'];
		} else {
			$this->data['rss_image_width'] = $this->setting->get('rss_image_width');
		}

		if (isset($this->request->post['rss_image_height'])) {
			$this->data['rss_image_height'] = $this->request->post['rss_image_height'];
		} else {
			$this->data['rss_image_height'] = $this->setting->get('rss_image_height');
		}

		if (isset($this->request->post['rss_limit_enabled'])) {
			$this->data['rss_limit_enabled'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['rss_limit_enabled'])) {
			$this->data['rss_limit_enabled'] = false;
		} else {
			$this->data['rss_limit_enabled'] = $this->setting->get('rss_limit_enabled');
		}

		if (isset($this->request->post['rss_limit_amount'])) {
			$this->data['rss_limit_amount'] = $this->request->post['rss_limit_amount'];
		} else {
			$this->data['rss_limit_amount'] = $this->setting->get('rss_limit_amount');
		}

		if (isset($this->error['rss_title'])) {
			$this->data['error_rss_title'] = $this->error['rss_title'];
		} else {
			$this->data['error_rss_title'] = '';
		}

		if (isset($this->error['rss_link'])) {
			$this->data['error_rss_link'] = $this->error['rss_link'];
		} else {
			$this->data['error_rss_link'] = '';
		}

		if (isset($this->error['rss_image_url'])) {
			$this->data['error_rss_image_url'] = $this->error['rss_image_url'];
		} else {
			$this->data['error_rss_image_url'] = '';
		}

		if (isset($this->error['rss_image_width'])) {
			$this->data['error_rss_image_width'] = $this->error['rss_image_width'];
		} else {
			$this->data['error_rss_image_width'] = '';
		}

		if (isset($this->error['rss_image_height'])) {
			$this->data['error_rss_image_height'] = $this->error['rss_image_height'];
		} else {
			$this->data['error_rss_image_height'] = '';
		}

		if (isset($this->error['rss_limit_amount'])) {
			$this->data['error_rss_limit_amount'] = $this->error['rss_limit_amount'];
		} else {
			$this->data['error_rss_limit_amount'] = '';
		}

		$this->data['link_back'] = $this->url->link('settings/layout_comments');

		$this->components = array('common/header', 'common/footer');

		$this->loadView('layout_comments/rss');
	}

	private function validate() {
		$this->loadModel('common/poster');

		$unpostable = $this->model_common_poster->unpostable($this->data);

		if ($unpostable) {
			$this->data['error'] = $unpostable;

			return false;
		}

		if (!isset($this->request->post['rss_title']) || $this->validation->length($this->request->post['rss_title']) < 1 || $this->validation->length($this->request->post['rss_title']) > 250) {
			$this->error['rss_title'] = sprintf($this->data['lang_error_length'], 1, 250);
		}

		if (!isset($this->request->post['rss_link']) || !$this->validation->isUrl($this->request->post['rss_link'])) {
			$this->error['rss_link'] = $this->data['lang_error_url'];
		}

		if (!isset($this->request->post['rss_link']) || $this->validation->length($this->request->post['rss_link']) < 1 || $this->validation->length($this->request->post['rss_link']) > 250) {
			$this->error['rss_link'] = sprintf($this->data['lang_error_length'], 1, 250);
		}

		if (!isset($this->request->post['rss_image_url']) || !$this->validation->isUrl($this->request->post['rss_image_url'])) {
			$this->error['rss_image_url'] = $this->data['lang_error_url'];
		}

		if (!isset($this->request->post['rss_image_url']) || $this->validation->length($this->request->post['rss_image_url']) < 1 || $this->validation->length($this->request->post['rss_image_url']) > 250) {
			$this->error['rss_image_url'] = sprintf($this->data['lang_error_length'], 1, 250);
		}

		if (!isset($this->request->post['rss_image_width']) || !$this->validation->isInt($this->request->post['rss_image_width']) || $this->request->post['rss_image_width'] < 1 || $this->request->post['rss_image_width'] > 999) {
			$this->error['rss_image_width'] = sprintf($this->data['lang_error_range'], 1, 999);
		}

		if (!isset($this->request->post['rss_image_height']) || !$this->validation->isInt($this->request->post['rss_image_height']) || $this->request->post['rss_image_height'] < 1 || $this->request->post['rss_image_height'] > 999) {
			$this->error['rss_image_height'] = sprintf($this->data['lang_error_range'], 1, 999);
		}

		if (!isset($this->request->post['rss_limit_amount']) || !$this->validation->isInt($this->request->post['rss_limit_amount']) || $this->request->post['rss_limit_amount'] < 1 || $this->request->post['rss_limit_amount'] > 100) {
			$this->error['rss_limit_amount'] = sprintf($this->data['lang_error_range'], 1, 100);
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