<?php
namespace Commentics;

class SettingsLayoutCommentsController extends Controller
{
    public function index()
    {
        $this->loadLanguage('settings/layout_comments');

        $this->data['inner_elements'] = array(
            array(
                'element' => $this->data['lang_text_country'],
                'status'  => ($this->setting->get('show_country')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/country')
            ),
            array(
                'element' => $this->data['lang_text_date'],
                'status'  => ($this->setting->get('show_date')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/date')
            ),
            array(
                'element' => $this->data['lang_text_dislike'],
                'status'  => ($this->setting->get('show_dislike')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/dislike')
            ),
            array(
                'element' => $this->data['lang_text_flag'],
                'status'  => ($this->setting->get('show_flag')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/flag')
            ),
            array(
                'element' => $this->data['lang_text_gravatar'],
                'status'  => ($this->setting->get('show_gravatar')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/gravatar')
            ),
            array(
                'element' => $this->data['lang_text_like'],
                'status'  => ($this->setting->get('show_like')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/like')
            ),
            array(
                'element' => $this->data['lang_text_name'],
                'status'  => $this->data['lang_text_enabled'] . $this->data['lang_text_mandatory'],
                'action'  => $this->url->link('layout_comments/name')
            ),
            array(
                'element' => $this->data['lang_text_permalink'],
                'status'  => ($this->setting->get('show_permalink')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/permalink')
            ),
            array(
                'element' => $this->data['lang_text_rating'],
                'status'  => ($this->setting->get('show_rating')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/rating')
            ),
            array(
                'element' => $this->data['lang_text_reply'],
                'status'  => ($this->setting->get('show_reply')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/reply')
            ),
            array(
                'element' => $this->data['lang_text_share'],
                'status'  => ($this->setting->get('show_share')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/share')
            ),
            array(
                'element' => $this->data['lang_text_state'],
                'status'  => ($this->setting->get('show_state')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/state')
            ),
            array(
                'element' => $this->data['lang_text_town'],
                'status'  => ($this->setting->get('show_town')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/town')
            )
        );

        $this->data['outer_elements'] = array(
            array(
                'element' => $this->data['lang_text_average_rating'],
                'status'  => ($this->setting->get('show_average_rating')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/average_rating')
            ),
            array(
                'element' => $this->data['lang_text_notify'],
                'status'  => ($this->setting->get('show_notify')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/notify')
            ),
            array(
                'element' => $this->data['lang_text_online'],
                'status'  => ($this->setting->get('show_online')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/online')
            ),
            array(
                'element' => $this->data['lang_text_page_number'],
                'status'  => ($this->setting->get('show_page_number')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/page_number')
            ),
            array(
                'element' => $this->data['lang_text_pagination'],
                'status'  => ($this->setting->get('show_pagination')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/pagination')
            ),
            array(
                'element' => $this->data['lang_text_rss'],
                'status'  => ($this->setting->get('show_rss')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/rss')
            ),
            array(
                'element' => $this->data['lang_text_search'],
                'status'  => ($this->setting->get('show_search')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/search')
            ),
            array(
                'element' => $this->data['lang_text_social'],
                'status'  => ($this->setting->get('show_social')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/social')
            ),
            array(
                'element' => $this->data['lang_text_sort_by'],
                'status'  => ($this->setting->get('show_sort_by')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/sort_by')
            ),
            array(
                'element' => $this->data['lang_text_topic'],
                'status'  => ($this->setting->get('show_topic')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_comments/topic')
            )
        );

        $this->data['lang_description'] = sprintf($this->data['lang_description'], $this->url->link('layout_comments/general'));

        $this->data['button_edit'] = $this->loadImage('button/edit.png');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('settings/layout_comments');
    }
}
