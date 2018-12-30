<?php
namespace Commentics;

class LayoutFormStateController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/state');

        $this->loadModel('layout_form/state');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_state->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_state'])) {
            $this->data['enabled_state'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_state'])) {
            $this->data['enabled_state'] = false;
        } else {
            $this->data['enabled_state'] = $this->setting->get('enabled_state');
        }

        if (isset($this->request->post['required_state'])) {
            $this->data['required_state'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['required_state'])) {
            $this->data['required_state'] = false;
        } else {
            $this->data['required_state'] = $this->setting->get('required_state');
        }

        if (isset($this->request->post['default_state'])) {
            $this->data['default_state'] = $this->request->post['default_state'];
        } else {
            $this->data['default_state'] = $this->setting->get('default_state');
        }

        if (isset($this->request->post['filled_state_cookie_action'])) {
            $this->data['filled_state_cookie_action'] = $this->request->post['filled_state_cookie_action'];
        } else {
            $this->data['filled_state_cookie_action'] = $this->setting->get('filled_state_cookie_action');
        }

        if (isset($this->request->post['filled_state_login_action'])) {
            $this->data['filled_state_login_action'] = $this->request->post['filled_state_login_action'];
        } else {
            $this->data['filled_state_login_action'] = $this->setting->get('filled_state_login_action');
        }

        if (isset($this->error['default_state'])) {
            $this->data['error_default_state'] = $this->error['default_state'];
        } else {
            $this->data['error_default_state'] = '';
        }

        if (isset($this->error['filled_state_cookie_action'])) {
            $this->data['error_filled_state_cookie_action'] = $this->error['filled_state_cookie_action'];
        } else {
            $this->data['error_filled_state_cookie_action'] = '';
        }

        if (isset($this->error['filled_state_login_action'])) {
            $this->data['error_filled_state_login_action'] = $this->error['filled_state_login_action'];
        } else {
            $this->data['error_filled_state_login_action'] = '';
        }

        $this->data['states'] = $this->geo->getStatesByCountryId($this->setting->get('default_country'));

        $this->data['link_list'] = 'index.php?route=manage/states';

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/state');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_state']) || ($this->request->post['default_state'] && !$this->geo->stateExists($this->request->post['default_state']))) {
            $this->error['default_state'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_state_cookie_action']) || !in_array($this->request->post['filled_state_cookie_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_state_cookie_action'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_state_login_action']) || !in_array($this->request->post['filled_state_login_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_state_login_action'] = $this->data['lang_error_selection'];
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
