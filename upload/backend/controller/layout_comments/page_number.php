<?php
namespace Commentics;

class LayoutCommentsPageNumberController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/page_number');

        $this->loadModel('layout_comments/page_number');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_page_number->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_page_number'])) {
            $this->data['show_page_number'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_page_number'])) {
            $this->data['show_page_number'] = false;
        } else {
            $this->data['show_page_number'] = $this->setting->get('show_page_number');
        }

        if (isset($this->request->post['page_number_format'])) {
            $this->data['page_number_format'] = $this->request->post['page_number_format'];
        } else {
            $this->data['page_number_format'] = $this->setting->get('page_number_format');
        }

        if (isset($this->error['page_number_format'])) {
            $this->data['error_page_number_format'] = $this->error['page_number_format'];
        } else {
            $this->data['error_page_number_format'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/page_number');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['page_number_format']) || !in_array($this->request->post['page_number_format'], array('Page X', 'Page X of Y'))) {
            $this->error['page_number_format'] = $this->data['lang_error_selection'];
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
