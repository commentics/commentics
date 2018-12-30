<?php
namespace Commentics;

class LayoutFormEmailController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/email');

        $this->loadModel('layout_form/email');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_email->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_email'])) {
            $this->data['enabled_email'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_email'])) {
            $this->data['enabled_email'] = false;
        } else {
            $this->data['enabled_email'] = $this->setting->get('enabled_email');
        }

        if (isset($this->request->post['required_email'])) {
            $this->data['required_email'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['required_email'])) {
            $this->data['required_email'] = false;
        } else {
            $this->data['required_email'] = $this->setting->get('required_email');
        }

        if (isset($this->request->post['default_email'])) {
            $this->data['default_email'] = $this->request->post['default_email'];
        } else {
            $this->data['default_email'] = $this->setting->get('default_email');
        }

        if (isset($this->request->post['maximum_email'])) {
            $this->data['maximum_email'] = $this->request->post['maximum_email'];
        } else {
            $this->data['maximum_email'] = $this->setting->get('maximum_email');
        }

        if (isset($this->request->post['filled_email_cookie_action'])) {
            $this->data['filled_email_cookie_action'] = $this->request->post['filled_email_cookie_action'];
        } else {
            $this->data['filled_email_cookie_action'] = $this->setting->get('filled_email_cookie_action');
        }

        if (isset($this->request->post['filled_email_login_action'])) {
            $this->data['filled_email_login_action'] = $this->request->post['filled_email_login_action'];
        } else {
            $this->data['filled_email_login_action'] = $this->setting->get('filled_email_login_action');
        }

        if (isset($this->error['default_email'])) {
            $this->data['error_default_email'] = $this->error['default_email'];
        } else {
            $this->data['error_default_email'] = '';
        }

        if (isset($this->error['maximum_email'])) {
            $this->data['error_maximum_email'] = $this->error['maximum_email'];
        } else {
            $this->data['error_maximum_email'] = '';
        }

        if (isset($this->error['filled_email_cookie_action'])) {
            $this->data['error_filled_email_cookie_action'] = $this->error['filled_email_cookie_action'];
        } else {
            $this->data['error_filled_email_cookie_action'] = '';
        }

        if (isset($this->error['filled_email_login_action'])) {
            $this->data['error_filled_email_login_action'] = $this->error['filled_email_login_action'];
        } else {
            $this->data['error_filled_email_login_action'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/email');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_email']) || $this->validation->length($this->request->post['default_email']) > 250) {
            $this->error['default_email'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['maximum_email']) || !$this->validation->isInt($this->request->post['maximum_email']) || $this->request->post['maximum_email'] < 1 || $this->request->post['maximum_email'] > 250) {
            $this->error['maximum_email'] = sprintf($this->data['lang_error_range'], 1, 250);
        }

        if (!isset($this->request->post['filled_email_cookie_action']) || !in_array($this->request->post['filled_email_cookie_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_email_cookie_action'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_email_login_action']) || !in_array($this->request->post['filled_email_login_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_email_login_action'] = $this->data['lang_error_selection'];
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
