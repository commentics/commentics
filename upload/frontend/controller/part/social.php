<?php
namespace Commentics;

class PartSocialController extends Controller {
	public function index() {
		$this->loadLanguage('part/social');

		$this->data['social_new_window']       = $this->setting->get('social_new_window');

		$this->data['show_social_digg']        = $this->setting->get('show_social_digg');
		$this->data['show_social_facebook']    = $this->setting->get('show_social_facebook');
		$this->data['show_social_google']      = $this->setting->get('show_social_google');
		$this->data['show_social_linkedin']    = $this->setting->get('show_social_linkedin');
		$this->data['show_social_reddit']      = $this->setting->get('show_social_reddit');
		$this->data['show_social_stumbleupon'] = $this->setting->get('show_social_stumbleupon');
		$this->data['show_social_twitter']     = $this->setting->get('show_social_twitter');

		$url = $this->page->getUrl();

		$this->data['social_digg']             = 'http://digg.com/submit?url=' . $url;
		$this->data['social_facebook']         = 'https://www.facebook.com/sharer.php?u=' . $url;
		$this->data['social_google']           = 'https://plus.google.com/share?url=' . $url;
		$this->data['social_linkedin']         = 'https://www.linkedin.com/shareArticle?url=' . $url;
		$this->data['social_reddit']           = 'http://reddit.com/submit?url=' . $url;
		$this->data['social_stumbleupon']      = 'http://www.stumbleupon.com/submit?url=' . $url;
		$this->data['social_twitter']          = 'https://twitter.com/intent/tweet?url=' . $url;

		return $this->data;
	}
}
?>