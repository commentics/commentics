<?php
namespace Commentics;

class LayoutCommentsNameController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/name');

        $this->loadModel('layout_comments/name');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_name->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_website'])) {
            $this->data['show_website'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_website'])) {
            $this->data['show_website'] = false;
        } else {
            $this->data['show_website'] = $this->setting->get('show_website');
        }

        if (isset($this->request->post['website_new_window'])) {
            $this->data['website_new_window'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['website_new_window'])) {
            $this->data['website_new_window'] = false;
        } else {
            $this->data['website_new_window'] = $this->setting->get('website_new_window');
        }

        if (isset($this->request->post['website_no_follow'])) {
            $this->data['website_no_follow'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['website_no_follow'])) {
            $this->data['website_no_follow'] = false;
        } else {
            $this->data['website_no_follow'] = $this->setting->get('website_no_follow');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/name');
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
