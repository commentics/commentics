<?php
namespace Commentics;

class ModuleApiController extends Controller
{
    public function index()
    {
        if (!$this->setting->has('api_enabled')) {
            $this->response->redirect('extension/modules');
        }

        $this->loadLanguage('module/api');

        $this->loadModel('module/api');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_module_api->update($this->request->post);
            }
        }

        if (isset($this->request->post['api_enabled'])) {
            $this->data['api_enabled'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['api_enabled'])) {
            $this->data['api_enabled'] = false;
        } else {
            $this->data['api_enabled'] = $this->setting->get('api_enabled');
        }

        if (isset($this->request->post['api_key'])) {
            $this->data['api_key'] = $this->request->post['api_key'];
        } else {
            $this->data['api_key'] = $this->setting->get('api_key');
        }

        if (isset($this->request->post['api_ip_address'])) {
            $this->data['api_ip_address'] = $this->request->post['api_ip_address'];
        } else {
            $this->data['api_ip_address'] = $this->setting->get('api_ip_address');
        }

        if (isset($this->request->post['api_check_ip'])) {
            $this->data['api_check_ip'] = $this->request->post['api_check_ip'];
        } else {
            $this->data['api_check_ip'] = $this->setting->get('api_check_ip');
        }

        if (isset($this->request->post['api_logging'])) {
            $this->data['api_logging'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['api_logging'])) {
            $this->data['api_logging'] = false;
        } else {
            $this->data['api_logging'] = $this->setting->get('api_logging');
        }

        $this->data['link_back'] = $this->url->link('extension/modules');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('module/api');
    }

    public function install()
    {
        $this->loadModel('module/api');

        $this->model_module_api->install();
    }

    public function uninstall()
    {
        $this->loadModel('module/api');

        $this->model_module_api->uninstall();
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['api_key']) || $this->validation->length($this->request->post['api_key']) < 5 || $this->validation->length($this->request->post['api_key']) > 250) {
            $this->error['api_key'] = sprintf($this->data['lang_error_length'], 5, 250);
        }

        if (!isset($this->request->post['api_ip_address']) || $this->validation->length($this->request->post['api_ip_address']) < 1 || $this->validation->length($this->request->post['api_ip_address']) > 250) {
            $this->error['api_ip_address'] = sprintf($this->data['lang_error_length'], 1, 250);
        }

        if (!isset($this->request->post['api_check_ip']) || !in_array($this->request->post['api_check_ip'], array('', 'loose', 'strict'))) {
            $this->error['api_check_ip'] = $this->data['lang_error_selection'];
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
