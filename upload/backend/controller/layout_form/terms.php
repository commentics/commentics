<?php
namespace Commentics;

class LayoutFormTermsController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/terms');

        $this->loadModel('layout_form/terms');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_terms->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_terms'])) {
            $this->data['enabled_terms'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_terms'])) {
            $this->data['enabled_terms'] = false;
        } else {
            $this->data['enabled_terms'] = $this->setting->get('enabled_terms');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/terms');
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
