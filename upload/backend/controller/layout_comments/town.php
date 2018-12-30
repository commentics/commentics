<?php
namespace Commentics;

class LayoutCommentsTownController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/town');

        $this->loadModel('layout_comments/town');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_town->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_town'])) {
            $this->data['show_town'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_town'])) {
            $this->data['show_town'] = false;
        } else {
            $this->data['show_town'] = $this->setting->get('show_town');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/town');
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
