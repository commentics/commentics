<?php
namespace Commentics;

class LayoutCommentsOnlineController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/online');

        $this->loadModel('layout_comments/online');

        if (!$this->setting->get('viewers_enabled')) {
            $this->data['warning'] = $this->data['lang_message_disabled'];
        }

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_online->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_online'])) {
            $this->data['show_online'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_online'])) {
            $this->data['show_online'] = false;
        } else {
            $this->data['show_online'] = $this->setting->get('show_online');
        }

        if (isset($this->request->post['online_refresh_enabled'])) {
            $this->data['online_refresh_enabled'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['online_refresh_enabled'])) {
            $this->data['online_refresh_enabled'] = false;
        } else {
            $this->data['online_refresh_enabled'] = $this->setting->get('online_refresh_enabled');
        }

        if (isset($this->request->post['online_refresh_interval'])) {
            $this->data['online_refresh_interval'] = $this->request->post['online_refresh_interval'];
        } else {
            $this->data['online_refresh_interval'] = $this->setting->get('online_refresh_interval');
        }

        if (isset($this->error['online_refresh_interval'])) {
            $this->data['error_online_refresh_interval'] = $this->error['online_refresh_interval'];
        } else {
            $this->data['error_online_refresh_interval'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        if ($this->setting->get('notice_layout_comments_online')) {
            $this->data['info'] = $this->data['lang_notice'];
        }

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/online');
    }

    public function dismiss()
    {
        $this->loadModel('layout_comments/online');

        $this->model_layout_comments_online->dismiss();
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['online_refresh_interval']) || !$this->validation->isInt($this->request->post['online_refresh_interval']) || $this->request->post['online_refresh_interval'] < 10 || $this->request->post['online_refresh_interval'] > 999) {
            $this->error['online_refresh_interval'] = sprintf($this->data['lang_error_range'], 10, 999);
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
