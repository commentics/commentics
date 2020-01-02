<?php
namespace Commentics;

class MainUpgrade2Controller extends Controller
{
    public function index()
    {
        if (!$this->db->isConnected() || !$this->db->isInstalled()) {
            $this->response->redirect('start');
        }

        $this->loadLanguage('main/upgrade_2');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $this->loadModel('main/upgrade_2');

            $valid_upgrade = true;

            $installed_version = $this->model_main_upgrade_2->getInstalledVersion();

            switch ($installed_version) {
                case '3.4':
                    $this->model_main_upgrade_2->upgrade('3.4 -> 4.0');
                    break;
                case '3.3':
                    $this->model_main_upgrade_2->upgrade('3.3 -> 3.4');
                    break;
                case '3.2':
                    $this->model_main_upgrade_2->upgrade('3.2 -> 3.3');
                    break;
                case '3.1':
                    $this->model_main_upgrade_2->upgrade('3.1 -> 3.2');
                    break;
                case '3.0':
                    $this->model_main_upgrade_2->upgrade('3.0 -> 3.1');
                    break;
                case '2.5':
                    $this->model_main_upgrade_2->upgrade('2.5 -> 3.0');
                    break;
                default:
                    $valid_upgrade = false;
            }

            if ($valid_upgrade) {
                $this->model_main_upgrade_2->setVersion();

                if ($this->db->getQueryError()) {
                    $this->data['error'] = $this->db->getQueryError();
                } else {
                    $this->data['lang_info_backend'] = sprintf($this->data['lang_info_backend'], '../' . $this->model_main_upgrade_2->getBackendFolder());
                }
            } else {
                $this->response->redirect('start');
            }
        } else {
            $this->response->redirect('start');
        }

        $this->data['page'] = '6';

        $this->components = array('common/header', 'common/footer');

        $this->loadView('main/upgrade_2');
    }
}
