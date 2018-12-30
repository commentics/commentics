<?php
namespace Commentics;

class LayoutCommentsSocialController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/social');

        $this->loadModel('layout_comments/social');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_social->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_social'])) {
            $this->data['show_social'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_social'])) {
            $this->data['show_social'] = false;
        } else {
            $this->data['show_social'] = $this->setting->get('show_social');
        }

        if (isset($this->request->post['social_new_window'])) {
            $this->data['social_new_window'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['social_new_window'])) {
            $this->data['social_new_window'] = false;
        } else {
            $this->data['social_new_window'] = $this->setting->get('social_new_window');
        }

        if (isset($this->request->post['show_social_digg'])) {
            $this->data['show_social_digg'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_social_digg'])) {
            $this->data['show_social_digg'] = false;
        } else {
            $this->data['show_social_digg'] = $this->setting->get('show_social_digg');
        }

        if (isset($this->request->post['show_social_facebook'])) {
            $this->data['show_social_facebook'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_social_facebook'])) {
            $this->data['show_social_facebook'] = false;
        } else {
            $this->data['show_social_facebook'] = $this->setting->get('show_social_facebook');
        }

        if (isset($this->request->post['show_social_linkedin'])) {
            $this->data['show_social_linkedin'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_social_linkedin'])) {
            $this->data['show_social_linkedin'] = false;
        } else {
            $this->data['show_social_linkedin'] = $this->setting->get('show_social_linkedin');
        }

        if (isset($this->request->post['show_social_reddit'])) {
            $this->data['show_social_reddit'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_social_reddit'])) {
            $this->data['show_social_reddit'] = false;
        } else {
            $this->data['show_social_reddit'] = $this->setting->get('show_social_reddit');
        }

        if (isset($this->request->post['show_social_twitter'])) {
            $this->data['show_social_twitter'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_social_twitter'])) {
            $this->data['show_social_twitter'] = false;
        } else {
            $this->data['show_social_twitter'] = $this->setting->get('show_social_twitter');
        }

        if (isset($this->request->post['show_social_weibo'])) {
            $this->data['show_social_weibo'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_social_weibo'])) {
            $this->data['show_social_weibo'] = false;
        } else {
            $this->data['show_social_weibo'] = $this->setting->get('show_social_weibo');
        }

        $this->data['socials'] = $this->model_layout_comments_social->getSocials();

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/social');
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
