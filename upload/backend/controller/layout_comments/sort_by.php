<?php
namespace Commentics;

class LayoutCommentsSortByController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/sort_by');

        $this->loadModel('layout_comments/sort_by');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_sort_by->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_sort_by'])) {
            $this->data['show_sort_by'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_sort_by'])) {
            $this->data['show_sort_by'] = false;
        } else {
            $this->data['show_sort_by'] = $this->setting->get('show_sort_by');
        }

        if (isset($this->request->post['show_sort_by_1'])) {
            $this->data['show_sort_by_1'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_sort_by_1'])) {
            $this->data['show_sort_by_1'] = false;
        } else {
            $this->data['show_sort_by_1'] = $this->setting->get('show_sort_by_1');
        }

        if (isset($this->request->post['show_sort_by_2'])) {
            $this->data['show_sort_by_2'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_sort_by_2'])) {
            $this->data['show_sort_by_2'] = false;
        } else {
            $this->data['show_sort_by_2'] = $this->setting->get('show_sort_by_2');
        }

        if (isset($this->request->post['show_sort_by_3'])) {
            $this->data['show_sort_by_3'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_sort_by_3'])) {
            $this->data['show_sort_by_3'] = false;
        } else {
            $this->data['show_sort_by_3'] = $this->setting->get('show_sort_by_3');
        }

        if (isset($this->request->post['show_sort_by_4'])) {
            $this->data['show_sort_by_4'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_sort_by_4'])) {
            $this->data['show_sort_by_4'] = false;
        } else {
            $this->data['show_sort_by_4'] = $this->setting->get('show_sort_by_4');
        }

        if (isset($this->request->post['show_sort_by_5'])) {
            $this->data['show_sort_by_5'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_sort_by_5'])) {
            $this->data['show_sort_by_5'] = false;
        } else {
            $this->data['show_sort_by_5'] = $this->setting->get('show_sort_by_5');
        }

        if (isset($this->request->post['show_sort_by_6'])) {
            $this->data['show_sort_by_6'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_sort_by_6'])) {
            $this->data['show_sort_by_6'] = false;
        } else {
            $this->data['show_sort_by_6'] = $this->setting->get('show_sort_by_6');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/sort_by');
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
