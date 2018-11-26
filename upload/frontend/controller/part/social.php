<?php
namespace Commentics;

class PartSocialController extends Controller {
	public function index() {
		$this->loadLanguage('part/social');

		$this->data['social_new_window']       = $this->setting->get('social_new_window');

		$this->data['show_social_digg']        = $this->setting->get('show_social_digg');
		$this->data['show_social_facebook']    = $this->setting->get('show_social_facebook');
		$this->data['show_social_linkedin']    = $this->setting->get('show_social_linkedin');
		$this->data['show_social_reddit']      = $this->setting->get('show_social_reddit');
		$this->data['show_social_twitter']     = $this->setting->get('show_social_twitter');
		$this->data['show_social_weibo']   	   = $this->setting->get('show_social_weibo');

		$url = $this->url->encode($this->page->getUrl());

		$reference = $this->url->encode($this->page->getReference());

		$this->data['social_digg']             = 'http://digg.com/submit?url=' . $url . '&title=' . $reference;
		$this->data['social_facebook']         = 'https://www.facebook.com/sharer.php?u=' . $url;
		$this->data['social_linkedin']         = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $reference;
		$this->data['social_reddit']           = 'https://reddit.com/submit?url=' . $url . '&title=' . $reference;
		$this->data['social_twitter']          = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $reference;
		$this->data['social_weibo']            = 'http://service.weibo.com/share/share.php?url=' . $url . '&title=' . $reference;

		return $this->data;
	}
}
?>