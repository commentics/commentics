<?php
namespace Commentics;

class CommonHeaderController extends Controller {
	public function index() {
		$this->data['commentics_url'] = $this->url->getCommenticsUrl();

		switch ($this->setting->get('jquery_source')) {
			case '':
				$this->data['jquery'] = '';
				break;
			case 'local':
				$this->data['jquery'] = $this->loadJavascript('jquery/jquery.min.js');
				break;
			case 'google':
				$this->data['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js';
				break;
			default:
				$this->data['jquery'] = '//code.jquery.com/jquery-1.12.4.min.js';
		}

		switch ($this->setting->get('jquery_ui_source')) {
			case '':
				$this->data['jquery_ui'] = '';
				break;
			case 'local':
				$this->data['jquery_ui'] = $this->loadJavascript('jquery/jquery-ui.min.js');
				break;
			case 'google':
				$this->data['jquery_ui'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
				break;
			default:
				$this->data['jquery_ui'] = '//code.jquery.com/ui/1.12.1/jquery-ui.min.js';
		}

		if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'recaptcha') {
			$this->data['recaptcha_api'] = 'https://www.google.com/recaptcha/api.js' . (($this->setting->get('recaptcha_language') == 'auto') ? '' : '?hl=' . $this->setting->get('recaptcha_language'));
		} else {
			$this->data['recaptcha_api'] = '';
		}

		if ($this->setting->get('optimize')) {
			$this->data['read_more'] = $this->data['filer'] = $this->data['timeago'] = $this->data['highlight'] = '';

			if ($this->setting->get('jquery_source') == 'local' && $this->setting->get('jquery_ui_source') == 'local') {
				$this->data['jquery'] = $this->data['jquery_ui'] = '';

				$this->data['common'] = $this->loadJavascript('common-jq-jqui.min.js');
			} else if ($this->setting->get('jquery_source') == 'local' && $this->setting->get('jquery_ui_source') != 'local') {
				$this->data['jquery'] = '';

				$this->data['common'] = $this->loadJavascript('common-jq.min.js');
			} else if ($this->setting->get('jquery_source') != 'local' && $this->setting->get('jquery_ui_source') == 'local') {
				$this->data['jquery_ui'] = '';

				$this->data['common'] = $this->loadJavascript('common-jqui.min.js');
			} else {
				$this->data['common'] = $this->loadJavascript('common.min.js');
			}

			$this->data['stylesheet'] = $this->loadStylesheet('stylesheet.min.css');
		} else {
			if ($this->setting->get('show_read_more')) {
				$this->data['read_more'] = $this->data['commentics_url'] . '3rdparty/read_more/read_more.js';
			} else {
				$this->data['read_more'] = '';
			}

			if ($this->setting->get('enabled_upload')) {
				$this->data['filer'] = $this->data['commentics_url'] . '3rdparty/filer/filer.js';
			} else {
				$this->data['filer'] = '';
			}

			if ($this->setting->get('date_auto')) {
				$this->data['timeago'] = $this->data['commentics_url'] . '3rdparty/timeago/timeago.js';
			} else {
				$this->data['timeago'] = '';
			}

			if ($this->setting->get('enabled_bb_code') && ($this->setting->get('enabled_bb_code_code') || ($this->setting->get('enabled_bb_code_php')))) {
				$this->data['highlight'] = $this->data['commentics_url'] . '3rdparty/highlight/highlight.js';
			} else {
				$this->data['highlight'] = '';
			}

			$this->data['common'] = $this->loadJavascript('common.js');

			$this->data['stylesheet'] = $this->loadStylesheet('stylesheet.css');
		}

		$this->data['custom'] = $this->loadCustomCss();

		return $this->data;
	}
}
?>