<?php
namespace Commentics;

class LayoutCommentsShareController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/share');

        $this->loadModel('layout_comments/share');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_share->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_share'])) {
            $this->data['show_share'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_share'])) {
            $this->data['show_share'] = false;
        } else {
            $this->data['show_share'] = $this->setting->get('show_share');
        }

        if (isset($this->request->post['share_new_window'])) {
            $this->data['share_new_window'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['share_new_window'])) {
            $this->data['share_new_window'] = false;
        } else {
            $this->data['share_new_window'] = $this->setting->get('share_new_window');
        }

        if (isset($this->request->post['show_share_digg'])) {
            $this->data['show_share_digg'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_share_digg'])) {
            $this->data['show_share_digg'] = false;
        } else {
            $this->data['show_share_digg'] = $this->setting->get('show_share_digg');
        }

        if (isset($this->request->post['show_share_facebook'])) {
            $this->data['show_share_facebook'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_share_facebook'])) {
            $this->data['show_share_facebook'] = false;
        } else {
            $this->data['show_share_facebook'] = $this->setting->get('show_share_facebook');
        }

        if (isset($this->request->post['show_share_linkedin'])) {
            $this->data['show_share_linkedin'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_share_linkedin'])) {
            $this->data['show_share_linkedin'] = false;
        } else {
            $this->data['show_share_linkedin'] = $this->setting->get('show_share_linkedin');
        }

        if (isset($this->request->post['show_share_reddit'])) {
            $this->data['show_share_reddit'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_share_reddit'])) {
            $this->data['show_share_reddit'] = false;
        } else {
            $this->data['show_share_reddit'] = $this->setting->get('show_share_reddit');
        }

        if (isset($this->request->post['show_share_twitter'])) {
            $this->data['show_share_twitter'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_share_twitter'])) {
            $this->data['show_share_twitter'] = false;
        } else {
            $this->data['show_share_twitter'] = $this->setting->get('show_share_twitter');
        }

        if (isset($this->request->post['show_share_weibo'])) {
            $this->data['show_share_weibo'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_share_weibo'])) {
            $this->data['show_share_weibo'] = false;
        } else {
            $this->data['show_share_weibo'] = $this->setting->get('show_share_weibo');
        }

        $this->data['shares'] = $this->model_layout_comments_share->getShares();

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/share');
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
