<?php
namespace Commentics;

class CommonHeaderController extends Controller
{
    public function index()
    {
        $this->data['commentics_url'] = $this->url->getCommenticsUrl();

        if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'recaptcha') {
            $this->data['recaptcha_api'] = 'https://www.google.com/recaptcha/api.js';
        } else {
            $this->data['recaptcha_api'] = '';
        }

        if ($this->setting->get('optimize')) {
            $this->data['highlight'] = '';

            $this->data['common'] = $this->loadJavascript('common.min.js');

            $this->data['stylesheet'] = $this->loadStylesheet('stylesheet.min.css');
        } else {
            if ($this->setting->get('enabled_bb_code') && ($this->setting->get('enabled_bb_code_code') || ($this->setting->get('enabled_bb_code_php')))) {
                $this->data['highlight'] = $this->data['commentics_url'] . '3rdparty/highlight/highlight.js';
            } else {
                $this->data['highlight'] = '';
            }

            $this->data['common'] = $this->loadJavascript('common.js');

            $this->data['stylesheet'] = $this->loadStylesheet('stylesheet.css');
        }

        $this->data['autoload_javascript'] = $this->autoloadJavascript();

        $this->data['autoload_stylesheet'] = $this->autoloadStylesheet();

        $this->data['custom'] = $this->loadCustomCss();

        $this->data['site_css'] = $this->loadSiteCss($this->page->getSiteId());

        return $this->data;
    }
}
