<?php
namespace Commentics;

class LayoutCommentsCommentController extends Controller {
	public function index() {
		$this->loadLanguage('layout_comments/comment');

		$this->loadModel('layout_comments/comment');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->validate()) {
				$this->model_layout_comments_comment->update($this->request->post);
			}
		}

		if (isset($this->request->post['show_read_more'])) {
			$this->data['show_read_more'] = true;
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_read_more'])) {
			$this->data['show_read_more'] = false;
		} else {
			$this->data['show_read_more'] = $this->setting->get('show_read_more');
		}

		if (isset($this->request->post['read_more_limit'])) {
			$this->data['read_more_limit'] = $this->request->post['read_more_limit'];
		} else {
			$this->data['read_more_limit'] = $this->setting->get('read_more_limit');
		}

		if (isset($this->error['read_more_limit'])) {
			$this->data['error_read_more_limit'] = $this->error['read_more_limit'];
		} else {
			$this->data['error_read_more_limit'] = '';
		}

		$this->data['link_back'] = $this->url->link('settings/layout_comments');

		$this->components = array('common/header', 'common/footer');

		$this->loadView('layout_comments/comment');
	}

	private function validate() {
		$this->loadModel('common/poster');

		$unpostable = $this->model_common_poster->unpostable($this->data);

		if ($unpostable) {
			$this->data['error'] = $unpostable;

			return false;
		}

		if (!isset($this->request->post['read_more_limit']) || !$this->validation->isInt($this->request->post['read_more_limit']) || $this->request->post['read_more_limit'] < 10 || $this->request->post['read_more_limit'] > 10000) {
			$this->error['read_more_limit'] = sprintf($this->data['lang_error_range'], 10, 10000);
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