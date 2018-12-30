<?php
namespace Commentics;

class LayoutFormNotifyController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/notify');

        $this->loadModel('layout_form/notify');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_notify->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_notify'])) {
            $this->data['enabled_notify'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_notify'])) {
            $this->data['enabled_notify'] = false;
        } else {
            $this->data['enabled_notify'] = $this->setting->get('enabled_notify');
        }

        if (isset($this->request->post['default_notify'])) {
            $this->data['default_notify'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['default_notify'])) {
            $this->data['default_notify'] = false;
        } else {
            $this->data['default_notify'] = $this->setting->get('default_notify');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/notify');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
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
