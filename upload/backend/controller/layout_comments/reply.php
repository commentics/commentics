<?php
namespace Commentics;

class LayoutCommentsReplyController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/reply');

        $this->loadModel('layout_comments/reply');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_reply->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_reply'])) {
            $this->data['show_reply'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_reply'])) {
            $this->data['show_reply'] = false;
        } else {
            $this->data['show_reply'] = $this->setting->get('show_reply');
        }

        if (isset($this->request->post['hide_replies'])) {
            $this->data['hide_replies'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['hide_replies'])) {
            $this->data['hide_replies'] = false;
        } else {
            $this->data['hide_replies'] = $this->setting->get('hide_replies');
        }

        if (isset($this->request->post['reply_depth'])) {
            $this->data['reply_depth'] = $this->request->post['reply_depth'];
        } else {
            $this->data['reply_depth'] = $this->setting->get('reply_depth');
        }

        if (isset($this->error['reply_depth'])) {
            $this->data['error_reply_depth'] = $this->error['reply_depth'];
        } else {
            $this->data['error_reply_depth'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/reply');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['reply_depth']) || !$this->validation->isInt($this->request->post['reply_depth']) || $this->request->post['reply_depth'] < 1 || $this->request->post['reply_depth'] > 5) {
            $this->error['reply_depth'] = sprintf($this->data['lang_error_range'], 1, 5);
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
