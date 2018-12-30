<?php
namespace Commentics;

class LayoutCommentsPaginationController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/pagination');

        $this->loadModel('layout_comments/pagination');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_pagination->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_pagination'])) {
            $this->data['show_pagination'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_pagination'])) {
            $this->data['show_pagination'] = false;
        } else {
            $this->data['show_pagination'] = $this->setting->get('show_pagination');
        }

        if (isset($this->request->post['pagination_type'])) {
            $this->data['pagination_type'] = $this->request->post['pagination_type'];
        } else {
            $this->data['pagination_type'] = $this->setting->get('pagination_type');
        }

        if (isset($this->request->post['pagination_amount'])) {
            $this->data['pagination_amount'] = $this->request->post['pagination_amount'];
        } else {
            $this->data['pagination_amount'] = $this->setting->get('pagination_amount');
        }

        if (isset($this->request->post['pagination_range'])) {
            $this->data['pagination_range'] = $this->request->post['pagination_range'];
        } else {
            $this->data['pagination_range'] = $this->setting->get('pagination_range');
        }

        if (isset($this->error['pagination_type'])) {
            $this->data['error_pagination_type'] = $this->error['pagination_type'];
        } else {
            $this->data['error_pagination_type'] = '';
        }

        if (isset($this->error['pagination_amount'])) {
            $this->data['error_pagination_amount'] = $this->error['pagination_amount'];
        } else {
            $this->data['error_pagination_amount'] = '';
        }

        if (isset($this->error['pagination_range'])) {
            $this->data['error_pagination_range'] = $this->error['pagination_range'];
        } else {
            $this->data['error_pagination_range'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/pagination');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['pagination_type']) || !in_array($this->request->post['pagination_type'], array('multiple', 'button', 'infinite'))) {
            $this->error['pagination_type'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['pagination_amount']) || !$this->validation->isInt($this->request->post['pagination_amount']) || $this->request->post['pagination_amount'] < 1 || $this->request->post['pagination_amount'] > 100) {
            $this->error['pagination_amount'] = sprintf($this->data['lang_error_range'], 1, 100);
        }

        if (!isset($this->request->post['pagination_range']) || !$this->validation->isInt($this->request->post['pagination_range']) || $this->request->post['pagination_range'] < 1 || $this->request->post['pagination_range'] > 10) {
            $this->error['pagination_range'] = sprintf($this->data['lang_error_range'], 1, 10);
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
