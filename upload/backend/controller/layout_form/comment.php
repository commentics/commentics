<?php
namespace Commentics;

class LayoutFormCommentController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/comment');

        $this->loadModel('layout_form/comment');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_comment->update($this->request->post);
            }
        }

        if (isset($this->request->post['default_comment'])) {
            $this->data['default_comment'] = $this->request->post['default_comment'];
        } else {
            $this->data['default_comment'] = $this->setting->get('default_comment');
        }

        if (isset($this->request->post['comment_maximum_characters'])) {
            $this->data['comment_maximum_characters'] = $this->request->post['comment_maximum_characters'];
        } else {
            $this->data['comment_maximum_characters'] = $this->setting->get('comment_maximum_characters');
        }

        if (isset($this->request->post['enabled_counter'])) {
            $this->data['enabled_counter'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_counter'])) {
            $this->data['enabled_counter'] = false;
        } else {
            $this->data['enabled_counter'] = $this->setting->get('enabled_counter');
        }

        if (isset($this->error['default_comment'])) {
            $this->data['error_default_comment'] = $this->error['default_comment'];
        } else {
            $this->data['error_default_comment'] = '';
        }

        if (isset($this->error['comment_maximum_characters'])) {
            $this->data['error_comment_maximum_characters'] = $this->error['comment_maximum_characters'];
        } else {
            $this->data['error_comment_maximum_characters'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/comment');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['default_comment']) || $this->validation->length($this->request->post['default_comment']) > 250) {
            $this->error['default_comment'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['comment_maximum_characters']) || !$this->validation->isInt($this->request->post['comment_maximum_characters']) || $this->request->post['comment_maximum_characters'] < 1 || $this->request->post['comment_maximum_characters'] > 99999) {
            $this->error['comment_maximum_characters'] = sprintf($this->data['lang_error_range'], 1, 99999);
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
