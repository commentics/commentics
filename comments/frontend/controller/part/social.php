<?php
namespace Commentics;

class PartSocialController extends Controller
{
    public function index()
    {
        $this->loadLanguage('part/social');

        if ($this->setting->get('social_new_window')) {
            $this->data['new_window'] = 'target="_blank"';
        } else {
            $this->data['new_window'] = '';
        }

        $url = $this->url->encode($this->page->getUrl());

        $reference = $this->url->encode($this->page->getReference());

        $this->data['digg_url']     = 'http://digg.com/submit?url=' . $url . '&title=' . $reference;
        $this->data['facebook_url'] = 'https://www.facebook.com/sharer.php?u=' . $url;
        $this->data['linkedin_url'] = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $reference;
        $this->data['reddit_url']   = 'https://reddit.com/submit?url=' . $url . '&title=' . $reference;
        $this->data['twitter_url']  = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $reference;
        $this->data['weibo_url']    = 'http://service.weibo.com/share/share.php?url=' . $url . '&title=' . $reference;

        return $this->data;
    }
}
