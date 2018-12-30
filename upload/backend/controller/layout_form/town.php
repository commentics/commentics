<?php
namespace Commentics;

class LayoutFormTownController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/town');

        $this->loadModel('layout_form/town');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_town->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_town'])) {
            $this->data['enabled_town'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_town'])) {
            $this->data['enabled_town'] = false;
        } else {
            $this->data['enabled_town'] = $this->setting->get('enabled_town');
        }

        if (isset($this->request->post['required_town'])) {
            $this->data['required_town'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['required_town'])) {
            $this->data['required_town'] = false;
        } else {
            $this->data['required_town'] = $this->setting->get('required_town');
        }

        if (isset($this->request->post['default_town'])) {
            $this->data['default_town'] = $this->request->post['default_town'];
        } else {
            $this->data['default_town'] = $this->setting->get('default_town');
        }

        if (isset($this->request->post['maximum_town'])) {
            $this->data['maximum_town'] = $this->request->post['maximum_town'];
        } else {
            $this->data['maximum_town'] = $this->setting->get('maximum_town');
        }

        if (isset($this->request->post['filled_town_cookie_action'])) {
            $this->data['filled_town_cookie_action'] = $this->request->post['filled_town_cookie_action'];
        } else {
            $this->data['filled_town_cookie_action'] = $this->setting->get('filled_town_cookie_action');
        }

        if (isset($this->request->post['filled_town_login_action'])) {
            $this->data['filled_town_login_action'] = $this->request->post['filled_town_login_action'];
        } else {
            $this->data['filled_town_login_action'] = $this->setting->get('filled_town_login_action');
        }

        if (isset($this->error['default_town'])) {
            $this->data['error_default_town'] = $this->error['default_town'];
        } else {
            $this->data['error_default_town'] = '';
        }

        if (isset($this->error['maximum_town'])) {
            $this->data['error_maximum_town'] = $this->error['maximum_town'];
        } else {
            $this->data['error_maximum_town'] = '';
        }

        if (isset($this->error['filled_town_cookie_action'])) {
            $this->data['error_filled_town_cookie_action'] = $this->error['filled_town_cookie_action'];
        } else {
            $this->data['error_filled_town_cookie_action'] = '';
        }

        if (isset($this->error['filled_town_login_action'])) {
            $this->data['error_filled_town_login_action'] = $this->error['filled_town_login_action'];
        } else {
            $this->data['error_filled_town_login_action'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/town');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_town']) || $this->validation->length($this->request->post['default_town']) > 250) {
            $this->error['default_town'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['maximum_town']) || !$this->validation->isInt($this->request->post['maximum_town']) || $this->request->post['maximum_town'] < 1 || $this->request->post['maximum_town'] > 250) {
            $this->error['maximum_town'] = sprintf($this->data['lang_error_range'], 1, 250);
        }

        if (!isset($this->request->post['filled_town_cookie_action']) || !in_array($this->request->post['filled_town_cookie_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_town_cookie_action'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_town_login_action']) || !in_array($this->request->post['filled_town_login_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_town_login_action'] = $this->data['lang_error_selection'];
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
