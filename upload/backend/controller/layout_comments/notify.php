<?php
namespace Commentics;

class LayoutCommentsNotifyController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/notify');

        $this->loadModel('layout_comments/notify');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_notify->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_notify'])) {
            $this->data['show_notify'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_notify'])) {
            $this->data['show_notify'] = false;
        } else {
            $this->data['show_notify'] = $this->setting->get('show_notify');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/notify');
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
