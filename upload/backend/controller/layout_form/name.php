<?php
namespace Commentics;

class LayoutFormNameController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/name');

        $this->loadModel('layout_form/name');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_name->update($this->request->post);
            }
        }

        if (isset($this->request->post['default_name'])) {
            $this->data['default_name'] = $this->request->post['default_name'];
        } else {
            $this->data['default_name'] = $this->setting->get('default_name');
        }

        if (isset($this->request->post['maximum_name'])) {
            $this->data['maximum_name'] = $this->request->post['maximum_name'];
        } else {
            $this->data['maximum_name'] = $this->setting->get('maximum_name');
        }

        if (isset($this->request->post['filled_name_cookie_action'])) {
            $this->data['filled_name_cookie_action'] = $this->request->post['filled_name_cookie_action'];
        } else {
            $this->data['filled_name_cookie_action'] = $this->setting->get('filled_name_cookie_action');
        }

        if (isset($this->request->post['filled_name_login_action'])) {
            $this->data['filled_name_login_action'] = $this->request->post['filled_name_login_action'];
        } else {
            $this->data['filled_name_login_action'] = $this->setting->get('filled_name_login_action');
        }

        if (isset($this->error['default_name'])) {
            $this->data['error_default_name'] = $this->error['default_name'];
        } else {
            $this->data['error_default_name'] = '';
        }

        if (isset($this->error['maximum_name'])) {
            $this->data['error_maximum_name'] = $this->error['maximum_name'];
        } else {
            $this->data['error_maximum_name'] = '';
        }

        if (isset($this->error['filled_name_cookie_action'])) {
            $this->data['error_filled_name_cookie_action'] = $this->error['filled_name_cookie_action'];
        } else {
            $this->data['error_filled_name_cookie_action'] = '';
        }

        if (isset($this->error['filled_name_login_action'])) {
            $this->data['error_filled_name_login_action'] = $this->error['filled_name_login_action'];
        } else {
            $this->data['error_filled_name_login_action'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/name');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_name']) || $this->validation->length($this->request->post['default_name']) > 250) {
            $this->error['default_name'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['maximum_name']) || !$this->validation->isInt($this->request->post['maximum_name']) || $this->request->post['maximum_name'] < 1 || $this->request->post['maximum_name'] > 250) {
            $this->error['maximum_name'] = sprintf($this->data['lang_error_range'], 1, 250);
        }

        if (!isset($this->request->post['filled_name_cookie_action']) || !in_array($this->request->post['filled_name_cookie_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_name_cookie_action'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_name_login_action']) || !in_array($this->request->post['filled_name_login_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_name_login_action'] = $this->data['lang_error_selection'];
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
