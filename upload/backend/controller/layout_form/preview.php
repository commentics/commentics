<?php
namespace Commentics;

class LayoutFormPreviewController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/preview');

        $this->loadModel('layout_form/preview');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_preview->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_preview'])) {
            $this->data['enabled_preview'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_preview'])) {
            $this->data['enabled_preview'] = false;
        } else {
            $this->data['enabled_preview'] = $this->setting->get('enabled_preview');
        }

        if (isset($this->request->post['agree_to_preview'])) {
            $this->data['agree_to_preview'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['agree_to_preview'])) {
            $this->data['agree_to_preview'] = false;
        } else {
            $this->data['agree_to_preview'] = $this->setting->get('agree_to_preview');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/preview');
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
