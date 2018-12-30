<?php
namespace Commentics;

class LayoutFormPrivacyController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/privacy');

        $this->loadModel('layout_form/privacy');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_privacy->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_privacy'])) {
            $this->data['enabled_privacy'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_privacy'])) {
            $this->data['enabled_privacy'] = false;
        } else {
            $this->data['enabled_privacy'] = $this->setting->get('enabled_privacy');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/privacy');
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
