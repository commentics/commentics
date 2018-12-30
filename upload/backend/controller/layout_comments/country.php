<?php
namespace Commentics;

class LayoutCommentsCountryController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/country');

        $this->loadModel('layout_comments/country');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_country->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_country'])) {
            $this->data['show_country'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_country'])) {
            $this->data['show_country'] = false;
        } else {
            $this->data['show_country'] = $this->setting->get('show_country');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/country');
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
