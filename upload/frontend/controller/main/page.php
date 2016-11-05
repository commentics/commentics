<?php
namespace Commentics;

class MainPageController extends Controller {
	public function index() {
		$this->loadLanguage('main/page');

		$this->loadModel('main/page');

		/* Is this an administrator? */
		$this->data['is_admin'] = $this->user->isAdmin();

		/* Add viewer */
		if ($this->setting->get('viewers_enabled') && !$this->data['is_admin']) {
			$this->model_main_page->addViewer();
		}

		/* Check maintenance */
		if ($this->setting->get('maintenance_mode') && !$this->data['is_admin']) {
			$this->data['maintenance_mode'] = true;

			$this->data['maintenance_message'] = $this->setting->get('maintenance_message');
		} else {
			$this->data['maintenance_mode'] = false;
		}

		/* Parsing information */
		if ($this->setting->get('display_parsing') && $this->data['is_admin']) {
			$this->data['display_parsing'] = true;
		} else {
			$this->data['display_parsing'] = false;
		}

		/* Display order */
		$this->data['order_parts'] = $this->setting->get('order_parts');

		$this->components = array('common/header', 'common/footer', 'main/form', 'main/comments');

		$this->loadView('main/page');
	}
}
?>