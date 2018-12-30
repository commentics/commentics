<?php
namespace Commentics;

class LayoutFormBbCodeController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/bb_code');

        $this->loadModel('layout_form/bb_code');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_bb_code->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_bb_code'])) {
            $this->data['enabled_bb_code'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code'])) {
            $this->data['enabled_bb_code'] = false;
        } else {
            $this->data['enabled_bb_code'] = $this->setting->get('enabled_bb_code');
        }

        if (isset($this->request->post['enabled_bb_code_bold'])) {
            $this->data['enabled_bb_code_bold'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_bold'])) {
            $this->data['enabled_bb_code_bold'] = false;
        } else {
            $this->data['enabled_bb_code_bold'] = $this->setting->get('enabled_bb_code_bold');
        }

        if (isset($this->request->post['enabled_bb_code_italic'])) {
            $this->data['enabled_bb_code_italic'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_italic'])) {
            $this->data['enabled_bb_code_italic'] = false;
        } else {
            $this->data['enabled_bb_code_italic'] = $this->setting->get('enabled_bb_code_italic');
        }

        if (isset($this->request->post['enabled_bb_code_underline'])) {
            $this->data['enabled_bb_code_underline'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_underline'])) {
            $this->data['enabled_bb_code_underline'] = false;
        } else {
            $this->data['enabled_bb_code_underline'] = $this->setting->get('enabled_bb_code_underline');
        }

        if (isset($this->request->post['enabled_bb_code_strike'])) {
            $this->data['enabled_bb_code_strike'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_strike'])) {
            $this->data['enabled_bb_code_strike'] = false;
        } else {
            $this->data['enabled_bb_code_strike'] = $this->setting->get('enabled_bb_code_strike');
        }

        if (isset($this->request->post['enabled_bb_code_superscript'])) {
            $this->data['enabled_bb_code_superscript'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_superscript'])) {
            $this->data['enabled_bb_code_superscript'] = false;
        } else {
            $this->data['enabled_bb_code_superscript'] = $this->setting->get('enabled_bb_code_superscript');
        }

        if (isset($this->request->post['enabled_bb_code_subscript'])) {
            $this->data['enabled_bb_code_subscript'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_subscript'])) {
            $this->data['enabled_bb_code_subscript'] = false;
        } else {
            $this->data['enabled_bb_code_subscript'] = $this->setting->get('enabled_bb_code_subscript');
        }

        if (isset($this->request->post['enabled_bb_code_code'])) {
            $this->data['enabled_bb_code_code'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_code'])) {
            $this->data['enabled_bb_code_code'] = false;
        } else {
            $this->data['enabled_bb_code_code'] = $this->setting->get('enabled_bb_code_code');
        }

        if (isset($this->request->post['enabled_bb_code_php'])) {
            $this->data['enabled_bb_code_php'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_php'])) {
            $this->data['enabled_bb_code_php'] = false;
        } else {
            $this->data['enabled_bb_code_php'] = $this->setting->get('enabled_bb_code_php');
        }

        if (isset($this->request->post['enabled_bb_code_quote'])) {
            $this->data['enabled_bb_code_quote'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_quote'])) {
            $this->data['enabled_bb_code_quote'] = false;
        } else {
            $this->data['enabled_bb_code_quote'] = $this->setting->get('enabled_bb_code_quote');
        }

        if (isset($this->request->post['enabled_bb_code_line'])) {
            $this->data['enabled_bb_code_line'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_line'])) {
            $this->data['enabled_bb_code_line'] = false;
        } else {
            $this->data['enabled_bb_code_line'] = $this->setting->get('enabled_bb_code_line');
        }

        if (isset($this->request->post['enabled_bb_code_bullet'])) {
            $this->data['enabled_bb_code_bullet'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_bullet'])) {
            $this->data['enabled_bb_code_bullet'] = false;
        } else {
            $this->data['enabled_bb_code_bullet'] = $this->setting->get('enabled_bb_code_bullet');
        }

        if (isset($this->request->post['enabled_bb_code_numeric'])) {
            $this->data['enabled_bb_code_numeric'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_numeric'])) {
            $this->data['enabled_bb_code_numeric'] = false;
        } else {
            $this->data['enabled_bb_code_numeric'] = $this->setting->get('enabled_bb_code_numeric');
        }

        if (isset($this->request->post['enabled_bb_code_link'])) {
            $this->data['enabled_bb_code_link'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_link'])) {
            $this->data['enabled_bb_code_link'] = false;
        } else {
            $this->data['enabled_bb_code_link'] = $this->setting->get('enabled_bb_code_link');
        }

        if (isset($this->request->post['enabled_bb_code_email'])) {
            $this->data['enabled_bb_code_email'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_email'])) {
            $this->data['enabled_bb_code_email'] = false;
        } else {
            $this->data['enabled_bb_code_email'] = $this->setting->get('enabled_bb_code_email');
        }

        if (isset($this->request->post['enabled_bb_code_image'])) {
            $this->data['enabled_bb_code_image'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_image'])) {
            $this->data['enabled_bb_code_image'] = false;
        } else {
            $this->data['enabled_bb_code_image'] = $this->setting->get('enabled_bb_code_image');
        }

        if (isset($this->request->post['enabled_bb_code_youtube'])) {
            $this->data['enabled_bb_code_youtube'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_bb_code_youtube'])) {
            $this->data['enabled_bb_code_youtube'] = false;
        } else {
            $this->data['enabled_bb_code_youtube'] = $this->setting->get('enabled_bb_code_youtube');
        }

        $this->data['bb_code'] = $this->model_layout_form_bb_code->getBbCode();

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/bb_code');
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
