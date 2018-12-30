<?php
namespace Commentics;

class LayoutFormSmiliesController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_form/smilies');

        $this->loadModel('layout_form/smilies');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_form_smilies->update($this->request->post);
            }
        }

        if (isset($this->request->post['enabled_smilies'])) {
            $this->data['enabled_smilies'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies'])) {
            $this->data['enabled_smilies'] = false;
        } else {
            $this->data['enabled_smilies'] = $this->setting->get('enabled_smilies');
        }

        if (isset($this->request->post['enabled_smilies_smile'])) {
            $this->data['enabled_smilies_smile'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_smile'])) {
            $this->data['enabled_smilies_smile'] = false;
        } else {
            $this->data['enabled_smilies_smile'] = $this->setting->get('enabled_smilies_smile');
        }

        if (isset($this->request->post['enabled_smilies_sad'])) {
            $this->data['enabled_smilies_sad'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_sad'])) {
            $this->data['enabled_smilies_sad'] = false;
        } else {
            $this->data['enabled_smilies_sad'] = $this->setting->get('enabled_smilies_sad');
        }

        if (isset($this->request->post['enabled_smilies_huh'])) {
            $this->data['enabled_smilies_huh'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_huh'])) {
            $this->data['enabled_smilies_huh'] = false;
        } else {
            $this->data['enabled_smilies_huh'] = $this->setting->get('enabled_smilies_huh');
        }

        if (isset($this->request->post['enabled_smilies_laugh'])) {
            $this->data['enabled_smilies_laugh'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_laugh'])) {
            $this->data['enabled_smilies_laugh'] = false;
        } else {
            $this->data['enabled_smilies_laugh'] = $this->setting->get('enabled_smilies_laugh');
        }

        if (isset($this->request->post['enabled_smilies_mad'])) {
            $this->data['enabled_smilies_mad'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_mad'])) {
            $this->data['enabled_smilies_mad'] = false;
        } else {
            $this->data['enabled_smilies_mad'] = $this->setting->get('enabled_smilies_mad');
        }

        if (isset($this->request->post['enabled_smilies_tongue'])) {
            $this->data['enabled_smilies_tongue'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_tongue'])) {
            $this->data['enabled_smilies_tongue'] = false;
        } else {
            $this->data['enabled_smilies_tongue'] = $this->setting->get('enabled_smilies_tongue');
        }

        if (isset($this->request->post['enabled_smilies_cry'])) {
            $this->data['enabled_smilies_cry'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_cry'])) {
            $this->data['enabled_smilies_cry'] = false;
        } else {
            $this->data['enabled_smilies_cry'] = $this->setting->get('enabled_smilies_cry');
        }

        if (isset($this->request->post['enabled_smilies_grin'])) {
            $this->data['enabled_smilies_grin'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_grin'])) {
            $this->data['enabled_smilies_grin'] = false;
        } else {
            $this->data['enabled_smilies_grin'] = $this->setting->get('enabled_smilies_grin');
        }

        if (isset($this->request->post['enabled_smilies_wink'])) {
            $this->data['enabled_smilies_wink'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_wink'])) {
            $this->data['enabled_smilies_wink'] = false;
        } else {
            $this->data['enabled_smilies_wink'] = $this->setting->get('enabled_smilies_wink');
        }

        if (isset($this->request->post['enabled_smilies_scared'])) {
            $this->data['enabled_smilies_scared'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_scared'])) {
            $this->data['enabled_smilies_scared'] = false;
        } else {
            $this->data['enabled_smilies_scared'] = $this->setting->get('enabled_smilies_scared');
        }

        if (isset($this->request->post['enabled_smilies_cool'])) {
            $this->data['enabled_smilies_cool'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_cool'])) {
            $this->data['enabled_smilies_cool'] = false;
        } else {
            $this->data['enabled_smilies_cool'] = $this->setting->get('enabled_smilies_cool');
        }

        if (isset($this->request->post['enabled_smilies_sleep'])) {
            $this->data['enabled_smilies_sleep'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_sleep'])) {
            $this->data['enabled_smilies_sleep'] = false;
        } else {
            $this->data['enabled_smilies_sleep'] = $this->setting->get('enabled_smilies_sleep');
        }

        if (isset($this->request->post['enabled_smilies_blush'])) {
            $this->data['enabled_smilies_blush'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_blush'])) {
            $this->data['enabled_smilies_blush'] = false;
        } else {
            $this->data['enabled_smilies_blush'] = $this->setting->get('enabled_smilies_blush');
        }

        if (isset($this->request->post['enabled_smilies_confused'])) {
            $this->data['enabled_smilies_confused'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_confused'])) {
            $this->data['enabled_smilies_confused'] = false;
        } else {
            $this->data['enabled_smilies_confused'] = $this->setting->get('enabled_smilies_confused');
        }

        if (isset($this->request->post['enabled_smilies_shocked'])) {
            $this->data['enabled_smilies_shocked'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['enabled_smilies_shocked'])) {
            $this->data['enabled_smilies_shocked'] = false;
        } else {
            $this->data['enabled_smilies_shocked'] = $this->setting->get('enabled_smilies_shocked');
        }

        $this->data['smilies'] = $this->model_layout_form_smilies->getSmilies();

        $this->data['link_back'] = $this->url->link('settings/layout_form');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_form/smilies');
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
