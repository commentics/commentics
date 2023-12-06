<?php
namespace Commentics;

class MainPageController extends Controller
{
    public function index()
    {
        $this->loadLanguage('main/page');

        $this->loadModel('main/page');

        /* Is this an administrator? */
        $this->data['is_admin'] = $this->user->isAdmin();

        /* Add viewer */
        if ($this->setting->get('viewers_enabled') && !$this->data['is_admin']) {
            $this->model_main_page->addViewer();
        }

        /* Check maintenance */
        if ($this->setting->get('maintenance_mode') && !$this->data['is_admin']) {
            $this->data['maintenance_mode'] = true;
        } else {
            $this->data['maintenance_mode'] = false;
        }

        /* Parsing information */
        if ($this->setting->get('display_parsing') && $this->data['is_admin']) {
            $this->data['display_parsing'] = true;
        } else {
            $this->data['display_parsing'] = false;
        }

        /* Admin Detect */
        if ($this->setting->get('admin_detect') && $this->data['is_admin']) {
            $this->data['admin_detect'] = true;

            $this->data['lang_modal_admindetect_content'] = sprintf($this->data['lang_modal_admindetect_content'], 'https://commentics.com/faq/general/admin-detection');
        } else {
            $this->data['admin_detect'] = false;
        }

        /* RTL (Right to Left) */
        if ($this->setting->get('rtl')) {
            $this->data['cmtx_dir'] = 'cmtx_rtl';
        } else {
            $this->data['cmtx_dir'] = 'cmtx_ltr';
        }

        /* CSS Editor */
        if ($this->setting->has('css_editor_enabled') && $this->setting->get('css_editor_enabled')) {
            $this->data['css_editor_enabled'] = true;
        } else {
            $this->data['css_editor_enabled'] = false;
        }

        /* These are passed to common.js via the template */
        $this->data['cmtx_js_settings_page'] = array(
            'commentics_url' => $this->url->getCommenticsUrl(),
            'language'       => $this->setting->get('language')
        );

        $this->data['cmtx_js_settings_page'] = json_encode($this->data['cmtx_js_settings_page']);

        $this->components = array('common/header', 'common/footer', 'main/form', 'main/comments');

        $this->loadView('main/page');
    }

    public function adminDetect()
    {
        if ($this->request->isAjax()) {
            if ($this->setting->get('admin_detect') && $this->user->isAdmin()) {
                $this->loadModel('main/page');

                $this->model_main_page->adminDetect();
            }
        }
    }
}
