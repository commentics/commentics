<?php
namespace Commentics;

class LayoutCommentsGeneralController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/general');

        $this->loadModel('layout_comments/general');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_general->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_comment_count'])) {
            $this->data['show_comment_count'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_comment_count'])) {
            $this->data['show_comment_count'] = false;
        } else {
            $this->data['show_comment_count'] = $this->setting->get('show_comment_count');
        }

        if (isset($this->request->post['comments_order'])) {
            $this->data['comments_order'] = $this->request->post['comments_order'];
        } else {
            $this->data['comments_order'] = $this->setting->get('comments_order');
        }

        if (isset($this->request->post['show_says'])) {
            $this->data['show_says'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_says'])) {
            $this->data['show_says'] = false;
        } else {
            $this->data['show_says'] = $this->setting->get('show_says');
        }

        if (isset($this->request->post['comments_position_1'])) {
            $this->data['comments_position_1'] = $this->request->post['comments_position_1'];
        } else {
            $this->data['comments_position_1'] = $this->setting->get('comments_position_1');
        }

        if (isset($this->request->post['comments_position_2'])) {
            $this->data['comments_position_2'] = $this->request->post['comments_position_2'];
        } else {
            $this->data['comments_position_2'] = $this->setting->get('comments_position_2');
        }

        if (isset($this->request->post['comments_position_3'])) {
            $this->data['comments_position_3'] = $this->request->post['comments_position_3'];
        } else {
            $this->data['comments_position_3'] = $this->setting->get('comments_position_3');
        }

        if (isset($this->request->post['comments_position_4'])) {
            $this->data['comments_position_4'] = $this->request->post['comments_position_4'];
        } else {
            $this->data['comments_position_4'] = $this->setting->get('comments_position_4');
        }

        if (isset($this->request->post['comments_position_5'])) {
            $this->data['comments_position_5'] = $this->request->post['comments_position_5'];
        } else {
            $this->data['comments_position_5'] = $this->setting->get('comments_position_5');
        }

        if (isset($this->request->post['comments_position_6'])) {
            $this->data['comments_position_6'] = $this->request->post['comments_position_6'];
        } else {
            $this->data['comments_position_6'] = $this->setting->get('comments_position_6');
        }

        if (isset($this->request->post['comments_position_7'])) {
            $this->data['comments_position_7'] = $this->request->post['comments_position_7'];
        } else {
            $this->data['comments_position_7'] = $this->setting->get('comments_position_7');
        }

        if (isset($this->request->post['comments_position_8'])) {
            $this->data['comments_position_8'] = $this->request->post['comments_position_8'];
        } else {
            $this->data['comments_position_8'] = $this->setting->get('comments_position_8');
        }

        if (isset($this->request->post['comments_position_9'])) {
            $this->data['comments_position_9'] = $this->request->post['comments_position_9'];
        } else {
            $this->data['comments_position_9'] = $this->setting->get('comments_position_9');
        }

        if (isset($this->request->post['comments_position_10'])) {
            $this->data['comments_position_10'] = $this->request->post['comments_position_10'];
        } else {
            $this->data['comments_position_10'] = $this->setting->get('comments_position_10');
        }

        if (isset($this->request->post['comments_position_11'])) {
            $this->data['comments_position_11'] = $this->request->post['comments_position_11'];
        } else {
            $this->data['comments_position_11'] = $this->setting->get('comments_position_11');
        }

        if (isset($this->request->post['comments_position_12'])) {
            $this->data['comments_position_12'] = $this->request->post['comments_position_12'];
        } else {
            $this->data['comments_position_12'] = $this->setting->get('comments_position_12');
        }

        if (isset($this->error['comments_order'])) {
            $this->data['error_comments_order'] = $this->error['comments_order'];
        } else {
            $this->data['error_comments_order'] = '';
        }

        if (isset($this->error['comments_position_1'])) {
            $this->data['error_comments_position_1'] = $this->error['comments_position_1'];
        } else {
            $this->data['error_comments_position_1'] = '';
        }

        if (isset($this->error['comments_position_2'])) {
            $this->data['error_comments_position_2'] = $this->error['comments_position_2'];
        } else {
            $this->data['error_comments_position_2'] = '';
        }

        if (isset($this->error['comments_position_3'])) {
            $this->data['error_comments_position_3'] = $this->error['comments_position_3'];
        } else {
            $this->data['error_comments_position_3'] = '';
        }

        if (isset($this->error['comments_position_4'])) {
            $this->data['error_comments_position_4'] = $this->error['comments_position_4'];
        } else {
            $this->data['error_comments_position_4'] = '';
        }

        if (isset($this->error['comments_position_5'])) {
            $this->data['error_comments_position_5'] = $this->error['comments_position_5'];
        } else {
            $this->data['error_comments_position_5'] = '';
        }

        if (isset($this->error['comments_position_6'])) {
            $this->data['error_comments_position_6'] = $this->error['comments_position_6'];
        } else {
            $this->data['error_comments_position_6'] = '';
        }

        if (isset($this->error['comments_position_7'])) {
            $this->data['error_comments_position_7'] = $this->error['comments_position_7'];
        } else {
            $this->data['error_comments_position_7'] = '';
        }

        if (isset($this->error['comments_position_8'])) {
            $this->data['error_comments_position_8'] = $this->error['comments_position_8'];
        } else {
            $this->data['error_comments_position_8'] = '';
        }

        if (isset($this->error['comments_position_9'])) {
            $this->data['error_comments_position_9'] = $this->error['comments_position_9'];
        } else {
            $this->data['error_comments_position_9'] = '';
        }

        if (isset($this->error['comments_position_10'])) {
            $this->data['error_comments_position_10'] = $this->error['comments_position_10'];
        } else {
            $this->data['error_comments_position_10'] = '';
        }

        if (isset($this->error['comments_position_11'])) {
            $this->data['error_comments_position_11'] = $this->error['comments_position_11'];
        } else {
            $this->data['error_comments_position_11'] = '';
        }

        if (isset($this->error['comments_position_12'])) {
            $this->data['error_comments_position_12'] = $this->error['comments_position_12'];
        } else {
            $this->data['error_comments_position_12'] = '';
        }

        $this->data['elements'] = array(
            $this->data['lang_select_none']           => '',
            $this->data['lang_select_average_rating'] => 'average_rating',
            $this->data['lang_select_notify']         => 'notify',
            $this->data['lang_select_online']         => 'online',
            $this->data['lang_select_page_number']    => 'page_number',
            $this->data['lang_select_pagination']     => 'pagination',
            $this->data['lang_select_rss']            => 'rss',
            $this->data['lang_select_search']         => 'search',
            $this->data['lang_select_social']         => 'social',
            $this->data['lang_select_sort_by']        => 'sort_by',
            $this->data['lang_select_topic']          => 'topic'
        );

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/general');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
        }

        if (!isset($this->request->post['comments_order']) || !in_array($this->request->post['comments_order'], array('1', '2', '3', '4', '5', '6'))) {
            $this->error['comments_order'] = $this->data['lang_error_selection'];
        }

        $elements = array('', 'average_rating', 'notify', 'online', 'page_number', 'pagination', 'rss', 'search', 'social', 'sort_by', 'topic');

        if (!isset($this->request->post['comments_position_1']) || !in_array($this->request->post['comments_position_1'], $elements)) {
            $this->error['comments_position_1'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_2']) || !in_array($this->request->post['comments_position_2'], $elements)) {
            $this->error['comments_position_2'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_3']) || !in_array($this->request->post['comments_position_3'], $elements)) {
            $this->error['comments_position_3'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_4']) || !in_array($this->request->post['comments_position_4'], $elements)) {
            $this->error['comments_position_4'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_5']) || !in_array($this->request->post['comments_position_5'], $elements)) {
            $this->error['comments_position_5'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_6']) || !in_array($this->request->post['comments_position_6'], $elements)) {
            $this->error['comments_position_6'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_7']) || !in_array($this->request->post['comments_position_7'], $elements)) {
            $this->error['comments_position_7'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_8']) || !in_array($this->request->post['comments_position_8'], $elements)) {
            $this->error['comments_position_8'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_9']) || !in_array($this->request->post['comments_position_9'], $elements)) {
            $this->error['comments_position_9'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_10']) || !in_array($this->request->post['comments_position_10'], $elements)) {
            $this->error['comments_position_10'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_11']) || !in_array($this->request->post['comments_position_11'], $elements)) {
            $this->error['comments_position_11'] = $this->data['lang_error_selection'];
        }

        if (!isset($this->request->post['comments_position_12']) || !in_array($this->request->post['comments_position_12'], $elements)) {
            $this->error['comments_position_12'] = $this->data['lang_error_selection'];
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
