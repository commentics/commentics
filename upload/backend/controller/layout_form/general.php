<?php
namespace Commentics;

class LayoutFormGeneralController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/general');

        $this->loadModel('layout_form/general');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_general->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_form'])) {
            $this->data['enabled_form'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_form'])) {
            $this->data['enabled_form'] = false;
        } else {
            $this->data['enabled_form'] = $this->setting->get('enabled_form');
        }

        if (isset($this->request->post['hide_form'])) {
            $this->data['hide_form'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['hide_form'])) {
            $this->data['hide_form'] = false;
        } else {
            $this->data['hide_form'] = $this->setting->get('hide_form');
        }

        if (isset($this->request->post['display_javascript_disabled'])) {
            $this->data['display_javascript_disabled'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['display_javascript_disabled'])) {
            $this->data['display_javascript_disabled'] = false;
        } else {
            $this->data['display_javascript_disabled'] = $this->setting->get('display_javascript_disabled');
        }

        if (isset($this->request->post['display_required_symbol'])) {
            $this->data['display_required_symbol'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['display_required_symbol'])) {
            $this->data['display_required_symbol'] = false;
        } else {
            $this->data['display_required_symbol'] = $this->setting->get('display_required_symbol');
        }

        if (isset($this->request->post['display_required_text'])) {
            $this->data['display_required_text'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['display_required_text'])) {
            $this->data['display_required_text'] = false;
        } else {
            $this->data['display_required_text'] = $this->setting->get('display_required_text');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/general');
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
