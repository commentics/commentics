<?php
namespace Commentics;

class CommonHeaderController extends Controller {
	public function index() {
		$this->loadLanguage('common/header');

		$this->data['jquery'] = $this->loadJavascript('jquery.min.js');

		$this->data['jquery_ui'] = $this->loadJavascript('jquery-ui/jquery-ui.min.js');

		$this->data['jquery_theme'] = $this->loadJavascript('jquery-ui/jquery-ui.min.css');

		$this->data['normalize'] = $this->loadStylesheet('normalize.css');

		$this->data['stylesheet'] = $this->loadStylesheet('stylesheet.css');

		$this->data['common'] = $this->loadJavascript('common.js');

		$this->data['logo'] = $this->loadImage('commentics/logo.png');

		return $this->data;
	}
}
?>