<?php
namespace Commentics;

class LayoutCommentsDateController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/date');

        $this->loadModel('layout_comments/date');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_date->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_date'])) {
            $this->data['show_date'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_date'])) {
            $this->data['show_date'] = false;
        } else {
            $this->data['show_date'] = $this->setting->get('show_date');
        }

        if (isset($this->request->post['date_auto'])) {
            $this->data['date_auto'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['date_auto'])) {
            $this->data['date_auto'] = false;
        } else {
            $this->data['date_auto'] = $this->setting->get('date_auto');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/date');
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
