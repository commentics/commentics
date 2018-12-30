<?php
namespace Commentics;

class LayoutCommentsRatingController extends Controller
{
    public function index()
    {
        $this->loadLanguage('layout_comments/rating');

        $this->loadModel('layout_comments/rating');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->validate()) {
                $this->model_layout_comments_rating->update($this->request->post);
            }
        }

        if (isset($this->request->post['show_rating'])) {
            $this->data['show_rating'] = true;
        } else if ($this->request->server['REQUEST_METHOD'] == 'POST' && !isset($this->request->post['show_rating'])) {
            $this->data['show_rating'] = false;
        } else {
            $this->data['show_rating'] = $this->setting->get('show_rating');
        }

        $this->data['link_back'] = $this->url->link('settings/layout_comments');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('layout_comments/rating');
    }

    private function validate()
    {
        $this->loadModel('common/poster');

        $unpostable = $this->model_common_poster->unpostable($this->data);

        if ($unpostable) {
            $this->data['error'] = $unpostable;

            return false;
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
