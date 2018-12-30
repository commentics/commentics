<?php
namespace Commentics;

class LayoutFormQuestionController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/question');

        $this->loadModel('layout_form/question');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_question->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_question'])) {
            $this->data['enabled_question'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_question'])) {
            $this->data['enabled_question'] = false;
        } else {
            $this->data['enabled_question'] = $this->setting->get('enabled_question');
        }

        $this->data['link_list'] = 'index.php?route=manage/questions';

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/question');
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
