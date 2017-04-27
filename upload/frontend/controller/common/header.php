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
				$this->data['jquery'] = $this->loadJavascript('jquery.min.js');
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
				$this->data['jquery_theme'] = '';
				break;
			case 'local':
				$this->data['jquery_ui'] = $this->loadJavascript('jquery-ui/jquery-ui.min.js');
				$this->data['jquery_theme'] = $this->loadJavascript('jquery-ui/jquery-ui.min.css');
				break;
			case 'google':
				$this->data['jquery_ui'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
				$this->data['jquery_theme'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css';
				break;
			default:
				$this->data['jquery_ui'] = '//code.jquery.com/ui/1.12.1/jquery-ui.min.js';
				$this->data['jquery_theme'] = '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.min.css';
		}

		switch ($this->setting->get('font_awesome_source')) {
			case '':
				$this->data['font_awesome'] = '';
				break;
			case 'local':
				$this->data['font_awesome'] = $this->data['commentics_url'] . '3rdparty/font_awesome/css/font-awesome.min.css';
				break;
			default:
				$this->data['font_awesome'] = '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
		}

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

		if ($this->setting->get('enabled_captcha') && $this->setting->get('captcha_type') == 'recaptcha') {
			$this->data['recaptcha_api'] = 'https://www.google.com/recaptcha/api.js' . (($this->setting->get('recaptcha_language') == 'auto') ? '' : '?hl=' . $this->setting->get('recaptcha_language'));
		} else {
			$this->data['recaptcha_api'] = '';
		}

		if ($this->setting->get('colorbox_source') != '' && ($this->setting->get('enabled_upload') || ($this->setting->get('enabled_privacy') || $this->setting->get('enabled_terms')))) {
			$this->data['colorbox'] = true;
		} else {
			$this->data['colorbox'] = false;
		}

		if ($this->setting->get('enabled_bb_code') && ($this->setting->get('enabled_bb_code_code') || ($this->setting->get('enabled_bb_code_php')))) {
			$this->data['highlight'] = true;
		} else {
			$this->data['highlight'] = false;
		}

		$this->data['common'] = $this->loadJavascript('common.js');

		$this->data['stylesheet'] = $this->loadStylesheet('stylesheet.css');

		$this->data['extra'] = $this->loadExtraCss();

		return $this->data;
	}
}
?>