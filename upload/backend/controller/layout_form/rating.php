<?php
namespace Commentics;

class LayoutFormRatingController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/rating');

        $this->loadModel('layout_form/rating');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_rating->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_rating'])) {
            $this->data['enabled_rating'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_rating'])) {
            $this->data['enabled_rating'] = false;
        } else {
            $this->data['enabled_rating'] = $this->setting->get('enabled_rating');
        }

        if (isset($this->request->post['required_rating'])) {
            $this->data['required_rating'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['required_rating'])) {
            $this->data['required_rating'] = false;
        } else {
            $this->data['required_rating'] = $this->setting->get('required_rating');
        }

        if (isset($this->request->post['default_rating'])) {
            $this->data['default_rating'] = $this->request->post['default_rating'];
        } else {
            $this->data['default_rating'] = $this->setting->get('default_rating');
        }

        if (isset($this->request->post['repeat_rating'])) {
            $this->data['repeat_rating'] = $this->request->post['repeat_rating'];
        } else {
            $this->data['repeat_rating'] = $this->setting->get('repeat_rating');
        }

        if (isset($this->error['default_rating'])) {
            $this->data['error_default_rating'] = $this->error['default_rating'];
        } else {
            $this->data['error_default_rating'] = '';
        }

        if (isset($this->error['repeat_rating'])) {
            $this->data['error_repeat_rating'] = $this->error['repeat_rating'];
        } else {
            $this->data['error_repeat_rating'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/rating');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_rating']) || !in_array($this->request->post['default_rating'], array('', '1', '2', '3', '4', '5'))) {
            $this->error['default_rating'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['repeat_rating']) || !in_array($this->request->post['repeat_rating'], array('normal', 'hide'))) {
            $this->error['repeat_rating'] = $this->data['lang_error_selection'];
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
