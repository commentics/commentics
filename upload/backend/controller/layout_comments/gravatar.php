<?php
namespace Commentics;

class LayoutCommentsGravatarController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/gravatar');

        $this->loadModel('layout_comments/gravatar');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_gravatar->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_gravatar'])) {
            $this->data['show_gravatar'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_gravatar'])) {
            $this->data['show_gravatar'] = false;
        } else {
            $this->data['show_gravatar'] = $this->setting->get('show_gravatar');
        }

        if (isset($this->request->post['gravatar_default'])) {
            $this->data['gravatar_default'] = $this->request->post['gravatar_default'];
        } else {
            $this->data['gravatar_default'] = $this->setting->get('gravatar_default');
        }

        if (isset($this->request->post['gravatar_custom'])) {
            $this->data['gravatar_custom'] = $this->request->post['gravatar_custom'];
        } else {
            $this->data['gravatar_custom'] = $this->setting->get('gravatar_custom');
        }

        if (isset($this->request->post['gravatar_size'])) {
            $this->data['gravatar_size'] = $this->request->post['gravatar_size'];
        } else {
            $this->data['gravatar_size'] = $this->setting->get('gravatar_size');
        }

        if (isset($this->request->post['gravatar_rating'])) {
            $this->data['gravatar_rating'] = $this->request->post['gravatar_rating'];
        } else {
            $this->data['gravatar_rating'] = $this->setting->get('gravatar_rating');
        }

        if (isset($this->request->post['show_level'])) {
            $this->data['show_level'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_level'])) {
            $this->data['show_level'] = false;
        } else {
            $this->data['show_level'] = $this->setting->get('show_level');
        }

        if (isset($this->request->post['level_5'])) {
            $this->data['level_5'] = $this->request->post['level_5'];
        } else {
            $this->data['level_5'] = $this->setting->get('level_5');
        }

        if (isset($this->request->post['level_4'])) {
            $this->data['level_4'] = $this->request->post['level_4'];
        } else {
            $this->data['level_4'] = $this->setting->get('level_4');
        }

        if (isset($this->request->post['level_3'])) {
            $this->data['level_3'] = $this->request->post['level_3'];
        } else {
            $this->data['level_3'] = $this->setting->get('level_3');
        }

        if (isset($this->request->post['level_2'])) {
            $this->data['level_2'] = $this->request->post['level_2'];
        } else {
            $this->data['level_2'] = $this->setting->get('level_2');
        }

        if (isset($this->request->post['level_1'])) {
            $this->data['level_1'] = $this->request->post['level_1'];
        } else {
            $this->data['level_1'] = $this->setting->get('level_1');
        }

        if (isset($this->request->post['level_0'])) {
            $this->data['level_0'] = $this->request->post['level_0'];
        } else {
            $this->data['level_0'] = $this->setting->get('level_0');
        }

        if (isset($this->request->post['show_bio'])) {
            $this->data['show_bio'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_bio'])) {
            $this->data['show_bio'] = false;
        } else {
            $this->data['show_bio'] = $this->setting->get('show_bio');
        }

        if (isset($this->request->post['show_badge_top_poster'])) {
            $this->data['show_badge_top_poster'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_badge_top_poster'])) {
            $this->data['show_badge_top_poster'] = false;
        } else {
            $this->data['show_badge_top_poster'] = $this->setting->get('show_badge_top_poster');
        }

        if (isset($this->request->post['show_badge_most_likes'])) {
            $this->data['show_badge_most_likes'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_badge_most_likes'])) {
            $this->data['show_badge_most_likes'] = false;
        } else {
            $this->data['show_badge_most_likes'] = $this->setting->get('show_badge_most_likes');
        }

        if (isset($this->request->post['show_badge_first_poster'])) {
            $this->data['show_badge_first_poster'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_badge_first_poster'])) {
            $this->data['show_badge_first_poster'] = false;
        } else {
            $this->data['show_badge_first_poster'] = $this->setting->get('show_badge_first_poster');
        }

        if (isset($this->error['gravatar_default'])) {
            $this->data['error_gravatar_default'] = $this->error['gravatar_default'];
        } else {
            $this->data['error_gravatar_default'] = '';
        }

        if (isset($this->error['gravatar_custom'])) {
            $this->data['error_gravatar_custom'] = $this->error['gravatar_custom'];
        } else {
            $this->data['error_gravatar_custom'] = '';
        }

        if (isset($this->error['gravatar_size'])) {
            $this->data['error_gravatar_size'] = $this->error['gravatar_size'];
        } else {
            $this->data['error_gravatar_size'] = '';
        }

        if (isset($this->error['gravatar_rating'])) {
            $this->data['error_gravatar_rating'] = $this->error['gravatar_rating'];
        } else {
            $this->data['error_gravatar_rating'] = '';
        }

        if (isset($this->error['level_5'])) {
            $this->data['error_level_5'] = $this->error['level_5'];
        } else {
            $this->data['error_level_5'] = '';
        }

        if (isset($this->error['level_4'])) {
            $this->data['error_level_4'] = $this->error['level_4'];
        } else {
            $this->data['error_level_4'] = '';
        }

        if (isset($this->error['level_3'])) {
            $this->data['error_level_3'] = $this->error['level_3'];
        } else {
            $this->data['error_level_3'] = '';
        }

        if (isset($this->error['level_2'])) {
            $this->data['error_level_2'] = $this->error['level_2'];
        } else {
            $this->data['error_level_2'] = '';
        }

        if (isset($this->error['level_1'])) {
            $this->data['error_level_1'] = $this->error['level_1'];
        } else {
            $this->data['error_level_1'] = '';
        }

        if (isset($this->error['level_0'])) {
            $this->data['error_level_0'] = $this->error['level_0'];
        } else {
            $this->data['error_level_0'] = '';
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/gravatar');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['gravatar_default']) || !in_array($this->request->post['gravatar_default'], array('', 'custom', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash'))) {
            $this->error['gravatar_default'] = $this->data['lang_error_selection'];
        }

        if (isset($this->request->post['gravatar_default']) && $this->request->post['gravatar_default'] == 'custom' && isset($this->request->post['gravatar_custom']) && !$this->validation->isUrl($this->request->post['gravatar_custom'])) {
            $this->error['gravatar_custom'] = $this->data['lang_error_url'];
        }

        if (isset($this->request->post['gravatar_custom']) && !empty($this->request->post['gravatar_custom']) && !$this->validation->isUrl($this->request->post['gravatar_custom'])) {
            $this->error['gravatar_custom'] = $this->data['lang_error_url'];
        }

        if (!isset($this->request->post['gravatar_custom']) || $this->validation->length($this->request->post['gravatar_custom']) > 250) {
            $this->error['gravatar_custom'] = sprintf($this->data['lang_error_length'], 0, 250);
        }

        if (!isset($this->request->post['gravatar_size']) || !$this->validation->isInt($this->request->post['gravatar_size']) || $this->request->post['gravatar_size'] < 1 || $this->request->post['gravatar_size'] > 2048) {
            $this->error['gravatar_size'] = sprintf($this->data['lang_error_range'], 1, 2048);
        }

        if (!isset($this->request->post['gravatar_rating']) || !in_array($this->request->post['gravatar_rating'], array('g', 'pg', 'r', 'x'))) {
            $this->error['gravatar_rating'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['level_5']) || !$this->validation->isInt($this->request->post['level_5']) || $this->request->post['level_5'] < 0 || $this->request->post['level_5'] > 99999) {
            $this->error['level_5'] = sprintf($this->data['lang_error_range'], 0, 99999);
        }

        if (!isset($this->request->post['level_4']) || !$this->validation->isInt($this->request->post['level_4']) || $this->request->post['level_4'] < 0 || $this->request->post['level_4'] > 99999) {
            $this->error['level_4'] = sprintf($this->data['lang_error_range'], 0, 99999);
        }

        if (!isset($this->request->post['level_3']) || !$this->validation->isInt($this->request->post['level_3']) || $this->request->post['level_3'] < 0 || $this->request->post['level_3'] > 99999) {
            $this->error['level_3'] = sprintf($this->data['lang_error_range'], 0, 99999);
        }

        if (!isset($this->request->post['level_2']) || !$this->validation->isInt($this->request->post['level_2']) || $this->request->post['level_2'] < 0 || $this->request->post['level_2'] > 99999) {
            $this->error['level_2'] = sprintf($this->data['lang_error_range'], 0, 99999);
        }

        if (!isset($this->request->post['level_1']) || !$this->validation->isInt($this->request->post['level_1']) || $this->request->post['level_1'] < 0 || $this->request->post['level_1'] > 99999) {
            $this->error['level_1'] = sprintf($this->data['lang_error_range'], 0, 99999);
        }

        if (!isset($this->request->post['level_0']) || !$this->validation->isInt($this->request->post['level_0']) || $this->request->post['level_0'] < 0 || $this->request->post['level_0'] > 99999) {
            $this->error['level_0'] = sprintf($this->data['lang_error_range'], 0, 99999);
        }

        if ($this->error) {
            $this->data['error'] = $this->data['lang_message_error'];

            return false;
        } else {
            $this->data['success'] = $this->data['lang_message_success'];

            return true;
        }
    }
}
