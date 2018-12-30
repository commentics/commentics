<?php
namespace Commentics;

class LayoutFormWebsiteController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/website');

        $this->loadModel('layout_form/website');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_website->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_website'])) {
            $this->data['enabled_website'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_website'])) {
            $this->data['enabled_website'] = false;
        } else {
            $this->data['enabled_website'] = $this->setting->get('enabled_website');
        }

        if (isset($this->request->post['required_website'])) {
            $this->data['required_website'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['required_website'])) {
            $this->data['required_website'] = false;
        } else {
            $this->data['required_website'] = $this->setting->get('required_website');
        }

        if (isset($this->request->post['default_website'])) {
            $this->data['default_website'] = $this->request->post['default_website'];
        } else {
            $this->data['default_website'] = $this->setting->get('default_website');
        }

        if (isset($this->request->post['maximum_website'])) {
            $this->data['maximum_website'] = $this->request->post['maximum_website'];
        } else {
            $this->data['maximum_website'] = $this->setting->get('maximum_website');
        }

        if (isset($this->request->post['filled_website_cookie_action'])) {
            $this->data['filled_website_cookie_action'] = $this->request->post['filled_website_cookie_action'];
        } else {
            $this->data['filled_website_cookie_action'] = $this->setting->get('filled_website_cookie_action');
        }

        if (isset($this->request->post['filled_website_login_action'])) {
            $this->data['filled_website_login_action'] = $this->request->post['filled_website_login_action'];
        } else {
            $this->data['filled_website_login_action'] = $this->setting->get('filled_website_login_action');
        }

        if (isset($this->error['default_website'])) {
            $this->data['error_default_website'] = $this->error['default_website'];
        } else {
            $this->data['error_default_website'] = '';
        }

        if (isset($this->error['maximum_website'])) {
            $this->data['error_maximum_website'] = $this->error['maximum_website'];
        } else {
            $this->data['error_maximum_website'] = '';
        }

        if (isset($this->error['filled_website_cookie_action'])) {
            $this->data['error_filled_website_cookie_action'] = $this->error['filled_website_cookie_action'];
        } else {
            $this->data['error_filled_website_cookie_action'] = '';
        }

        if (isset($this->error['filled_website_login_action'])) {
            $this->data['error_filled_website_login_action'] = $this->error['filled_website_login_action'];
        } else {
            $this->data['error_filled_website_login_action'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/website');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_website']) || $this->validation->length($this->request->post['default_website']) > 250) {
            $this->error['default_website'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['maximum_website']) || !$this->validation->isInt($this->request->post['maximum_website']) || $this->request->post['maximum_website'] < 1 || $this->request->post['maximum_website'] > 250) {
            $this->error['maximum_website'] = sprintf($this->data['lang_error_range'], 1, 250);
        }

        if (!isset($this->request->post['filled_website_cookie_action']) || !in_array($this->request->post['filled_website_cookie_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_website_cookie_action'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_website_login_action']) || !in_array($this->request->post['filled_website_login_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_website_login_action'] = $this->data['lang_error_selection'];
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
