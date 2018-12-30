<?php
namespace Commentics;

class LayoutFormCountryController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/country');

        $this->loadModel('layout_form/country');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_country->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_country'])) {
            $this->data['enabled_country'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_country'])) {
            $this->data['enabled_country'] = false;
        } else {
            $this->data['enabled_country'] = $this->setting->get('enabled_country');
        }

        if (isset($this->request->post['required_country'])) {
            $this->data['required_country'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['required_country'])) {
            $this->data['required_country'] = false;
        } else {
            $this->data['required_country'] = $this->setting->get('required_country');
        }

        if (isset($this->request->post['default_country'])) {
            $this->data['default_country'] = $this->request->post['default_country'];
        } else {
            $this->data['default_country'] = $this->setting->get('default_country');
        }

        if (isset($this->request->post['filled_country_cookie_action'])) {
            $this->data['filled_country_cookie_action'] = $this->request->post['filled_country_cookie_action'];
        } else {
            $this->data['filled_country_cookie_action'] = $this->setting->get('filled_country_cookie_action');
        }

        if (isset($this->request->post['filled_country_login_action'])) {
            $this->data['filled_country_login_action'] = $this->request->post['filled_country_login_action'];
        } else {
            $this->data['filled_country_login_action'] = $this->setting->get('filled_country_login_action');
        }

        if (isset($this->error['default_country'])) {
            $this->data['error_default_country'] = $this->error['default_country'];
        } else {
            $this->data['error_default_country'] = '';
        }

        if (isset($this->error['filled_country_cookie_action'])) {
            $this->data['error_filled_country_cookie_action'] = $this->error['filled_country_cookie_action'];
        } else {
            $this->data['error_filled_country_cookie_action'] = '';
        }

        if (isset($this->error['filled_country_login_action'])) {
            $this->data['error_filled_country_login_action'] = $this->error['filled_country_login_action'];
        } else {
            $this->data['error_filled_country_login_action'] = '';
        }

        $this->data['countries'] = $this->geo->getCountries();

        $this->data['link_list'] = 'index.php?route=manage/countries';

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/country');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_country']) || ($this->request->post['default_country'] && !$this->geo->countryExists($this->request->post['default_country']))) {
            $this->error['default_country'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_country_cookie_action']) || !in_array($this->request->post['filled_country_cookie_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_country_cookie_action'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['filled_country_login_action']) || !in_array($this->request->post['filled_country_login_action'], array('normal', 'disable', 'hide'))) {
            $this->error['filled_country_login_action'] = $this->data['lang_error_selection'];
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
