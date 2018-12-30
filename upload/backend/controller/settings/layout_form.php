<?php
namespace Commentics;

class SettingsLayoutFormController extends Controller
{
    public function index()
    {
        $this->loadLanguage('settings/layout_form');

        $this->data['elements'] = array(
            array(
                'element' => $this->data['lang_text_bb_code'],
                'status'  => ($this->setting->get('enabled_bb_code')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/bb_code')
            ),
            array(
                'element' => $this->data['lang_text_captcha'],
                'status'  => ($this->setting->get('enabled_captcha')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/captcha')
            ),
            array(
                'element' => $this->data['lang_text_comment'],
                'status'  => $this->data['lang_text_enabled'] . $this->data['lang_text_mandatory'],
                'action'  => $this->url->link('layout_form/comment')
            ),
            array(
                'element' => $this->data['lang_text_cookie'],
                'status'  => ($this->setting->get('enabled_cookie')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/cookie')
            ),
            array(
                'element' => $this->data['lang_text_country'],
                'status'  => ($this->setting->get('enabled_country')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/country')
            ),
            array(
                'element' => $this->data['lang_text_email'],
                'status'  => ($this->setting->get('enabled_email')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/email')
            ),
            array(
                'element' => $this->data['lang_text_name'],
                'status'  => $this->data['lang_text_enabled'] . $this->data['lang_text_mandatory'],
                'action'  => $this->url->link('layout_form/name')
            ),
            array(
                'element' => $this->data['lang_text_notify'],
                'status'  => ($this->setting->get('enabled_notify')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/notify')
            ),
            array(
                'element' => $this->data['lang_text_powered'],
                'status'  => ($this->setting->get('enabled_powered_by')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/powered')
            ),
            array(
                'element' => $this->data['lang_text_preview'],
                'status'  => ($this->setting->get('enabled_preview')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/preview')
            ),
            array(
                'element' => $this->data['lang_text_privacy'],
                'status'  => ($this->setting->get('enabled_privacy')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/privacy')
            ),
            array(
                'element' => $this->data['lang_text_question'],
                'status'  => ($this->setting->get('enabled_question')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/question')
            ),
            array(
                'element' => $this->data['lang_text_rating'],
                'status'  => ($this->setting->get('enabled_rating')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/rating')
            ),
            array(
                'element' => $this->data['lang_text_smilies'],
                'status'  => ($this->setting->get('enabled_smilies')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/smilies')
            ),
            array(
                'element' => $this->data['lang_text_state'],
                'status'  => ($this->setting->get('enabled_state')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/state')
            ),
            array(
                'element' => $this->data['lang_text_terms'],
                'status'  => ($this->setting->get('enabled_terms')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/terms')
            ),
            array(
                'element' => $this->data['lang_text_town'],
                'status'  => ($this->setting->get('enabled_town')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/town')
            ),
            array(
                'element' => $this->data['lang_text_upload'],
                'status'  => ($this->setting->get('enabled_upload')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/upload')
            ),
            array(
                'element' => $this->data['lang_text_website'],
                'status'  => ($this->setting->get('enabled_website')) ? $this->data['lang_text_enabled'] : $this->data['lang_text_disabled'],
                'action'  => $this->url->link('layout_form/website')
            )
        );

        $this->data['lang_description'] = sprintf($this->data['lang_description'], $this->url->link('layout_form/general'));

        $this->data['button_edit'] = $this->loadImage('button/edit.png');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('settings/layout_form');
    }
}
