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

            $this->data['maintenance_message'] = $this->setting->get('maintenance_message');
        } else {
            $this->data['maintenance_mode'] = false;
        }

        /* Parsing information */
        if ($this->setting->get('display_parsing') && $this->data['is_admin']) {
            $this->data['display_parsing'] = true;
        } else {
            $this->data['display_parsing'] = false;
        }

        /* Display order */
        $this->data['order_parts'] = $this->setting->get('order_parts');

        if ($this->setting->get('auto_detect')) {
            if ($this->page->isIFrame()) { // if this is an iFrame integration, we don't need AutoDetect as we'll always load jQuery
                $this->data['auto_detect'] = 0;

                $this->model_main_page->autoDetect(array('jquery' => '1')); // turn the AutoDetect setting off
            } else {
                $this->data['auto_detect'] = 1;
            }
        } else {
            $this->data['auto_detect'] = 0;
        }

        $this->data['lang_modal_autodetect_content'] = sprintf($this->data['lang_modal_autodetect_content'], 'https://www.commentics.org/autodetect');

        /* These are passed to autodetect.js via the template */
        $this->data['cmtx_js_settings_page'] = array(
            'commentics_url' => $this->url->getCommenticsUrl(),
            'auto_detect'    => (bool) $this->data['auto_detect']
        );

        $this->data['cmtx_js_settings_page'] = json_encode($this->data['cmtx_js_settings_page']);

        $this->components = array('common/header', 'common/footer', 'main/form', 'main/comments');

        $this->loadView('main/page');
    }

    public function autoDetect()
    {
        if ($this->request->isAjax()) {
            if ($this->setting->get('auto_detect')) {
                $this->loadModel('main/page');

                if (isset($this->request->get['jquery'])) {
                    $this->model_main_page->autoDetect($this->request->get);
                }
            }
        }
    }
}
