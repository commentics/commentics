<?php
namespace Commentics;

class MainInstall1Controller extends Controller {
	public function index() {
		if (!$this->db->isConnected()) {
			$this->response->redirect('start');
		}

		$this->loadLanguage('main/install_1');

		$this->loadModel('main/install_1');

		if ($this->db->isInstalled()) {
			$this->data['installed'] = true;
		} else {
			$this->data['installed'] = false;
		}

		$this->data['time_zones'] = $this->model_main_install_1->getTimeZones();

		$this->data['page'] = '5';

		$this->components = array('common/header', 'common/footer');

		$this->loadView('main/install_1');
	}
}
?>