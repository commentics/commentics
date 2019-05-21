<?php
namespace Commentics;

class LayoutFormUploadController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/upload');

        $this->loadModel('layout_form/upload');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_upload->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_upload'])) {
            $this->data['enabled_upload'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_upload'])) {
            $this->data['enabled_upload'] = false;
        } else {
            $this->data['enabled_upload'] = $this->setting->get('enabled_upload');
        }

        if (isset($this->request->post['maximum_upload_size'])) {
            $this->data['maximum_upload_size'] = $this->request->post['maximum_upload_size'];
        } else {
            $this->data['maximum_upload_size'] = $this->setting->get('maximum_upload_size');
        }

        if (isset($this->request->post['maximum_upload_amount'])) {
            $this->data['maximum_upload_amount'] = $this->request->post['maximum_upload_amount'];
        } else {
            $this->data['maximum_upload_amount'] = $this->setting->get('maximum_upload_amount');
        }

        if (isset($this->request->post['maximum_upload_total'])) {
            $this->data['maximum_upload_total'] = $this->request->post['maximum_upload_total'];
        } else {
            $this->data['maximum_upload_total'] = $this->setting->get('maximum_upload_total');
        }

        if (isset($this->error['maximum_upload_size'])) {
            $this->data['error_maximum_upload_size'] = $this->error['maximum_upload_size'];
        } else {
            $this->data['error_maximum_upload_size'] = '';
        }

        if (isset($this->error['maximum_upload_amount'])) {
            $this->data['error_maximum_upload_amount'] = $this->error['maximum_upload_amount'];
        } else {
            $this->data['error_maximum_upload_amount'] = '';
        }

        if (isset($this->error['maximum_upload_total'])) {
            $this->data['error_maximum_upload_total'] = $this->error['maximum_upload_total'];
        } else {
            $this->data['error_maximum_upload_total'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/upload');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['maximum_upload_size']) || !$this->validation->isInt($this->request->post['maximum_upload_size']) || $this->request->post['maximum_upload_size'] < 1 || $this->request->post['maximum_upload_size'] > 99) {
            $this->error['maximum_upload_size'] = sprintf($this->data['lang_error_range'], 1, 99);
        }

        if (!isset($this->request->post['maximum_upload_amount']) || !$this->validation->isInt($this->request->post['maximum_upload_amount']) || $this->request->post['maximum_upload_amount'] < 1 || $this->request->post['maximum_upload_amount'] > 10) {
            $this->error['maximum_upload_amount'] = sprintf($this->data['lang_error_range'], 1, 10);
        }

        if (!isset($this->request->post['maximum_upload_total']) || !$this->validation->isInt($this->request->post['maximum_upload_total']) || $this->request->post['maximum_upload_total'] < 1 || $this->request->post['maximum_upload_total'] > 99) {
            $this->error['maximum_upload_total'] = sprintf($this->data['lang_error_range'], 1, 99);
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
