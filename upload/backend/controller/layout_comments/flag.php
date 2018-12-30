<?php
namespace Commentics;

class LayoutCommentsFlagController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/flag');

        $this->loadModel('layout_comments/flag');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_flag->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_flag'])) {
            $this->data['show_flag'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_flag'])) {
            $this->data['show_flag'] = false;
        } else {
            $this->data['show_flag'] = $this->setting->get('show_flag');
        }

        if (isset($this->request->post['flag_max_per_user'])) {
            $this->data['flag_max_per_user'] = $this->request->post['flag_max_per_user'];
        } else {
            $this->data['flag_max_per_user'] = $this->setting->get('flag_max_per_user');
        }

        if (isset($this->request->post['flag_min_per_comment'])) {
            $this->data['flag_min_per_comment'] = $this->request->post['flag_min_per_comment'];
        } else {
            $this->data['flag_min_per_comment'] = $this->setting->get('flag_min_per_comment');
        }

        if (isset($this->request->post['flag_disapprove'])) {
            $this->data['flag_disapprove'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['flag_disapprove'])) {
            $this->data['flag_disapprove'] = false;
        } else {
            $this->data['flag_disapprove'] = $this->setting->get('flag_disapprove');
        }

        if (isset($this->error['flag_max_per_user'])) {
            $this->data['error_flag_max_per_user'] = $this->error['flag_max_per_user'];
        } else {
            $this->data['error_flag_max_per_user'] = '';
        }

        if (isset($this->error['flag_min_per_comment'])) {
            $this->data['error_flag_min_per_comment'] = $this->error['flag_min_per_comment'];
        } else {
            $this->data['error_flag_min_per_comment'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/flag');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['flag_max_per_user']) || !$this->validation->isInt($this->request->post['flag_max_per_user']) || $this->request->post['flag_max_per_user'] < 1 || $this->request->post['flag_max_per_user'] > 1000) {
            $this->error['flag_max_per_user'] = sprintf($this->data['lang_error_range'], 1, 1000);
        }

        if (!isset($this->request->post['flag_min_per_comment']) || !$this->validation->isInt($this->request->post['flag_min_per_comment']) || $this->request->post['flag_min_per_comment'] < 1 || $this->request->post['flag_min_per_comment'] > 1000) {
            $this->error['flag_min_per_comment'] = sprintf($this->data['lang_error_range'], 1, 1000);
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
