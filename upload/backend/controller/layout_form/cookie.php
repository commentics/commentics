<?php
namespace Commentics;

class LayoutFormCookieController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/cookie');

        $this->loadModel('layout_form/cookie');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_cookie->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_cookie'])) {
            $this->data['enabled_cookie'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_cookie'])) {
            $this->data['enabled_cookie'] = false;
        } else {
            $this->data['enabled_cookie'] = $this->setting->get('enabled_cookie');
        }

        if (isset($this->request->post['default_cookie'])) {
            $this->data['default_cookie'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['default_cookie'])) {
            $this->data['default_cookie'] = false;
        } else {
            $this->data['default_cookie'] = $this->setting->get('default_cookie');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/cookie');
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
