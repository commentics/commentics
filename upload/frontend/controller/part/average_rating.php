<?php
namespace Commentics;

class PartAverageRatingController extends Controller {
	public function index() {
		$this->loadLanguage('part/average_rating');

		$this->loadModel('part/average_rating');

		$this->data['average_rating'] = $this->model_part_average_rating->getAverageRating($this->page->getId());

		$this->data['num_of_ratings'] = $this->model_part_average_rating->getNumOfRatings($this->page->getId());

		$this->data['commentics_url'] = $this->url->getCommenticsUrl();

		$this->data['page_id'] = $this->page->getId();

		if ($this->setting->has('rich_snippets_enabled') && $this->setting->get('rich_snippets_enabled')) {
			$this->data['rich_snippets_enabled'] = true;
		} else {
			$this->data['rich_snippets_enabled'] = false;
		}

		return $this->data;
	}

	public function rate() {
		if ($this->request->isAjax()) {
			$this->response->addHeader('Content-Type: application/json');

			$json = array();

			if (isset($this->request->post['cmtx_page_id']) && isset($this->request->post['cmtx_rating']) && preg_match('/[1-5]/', $this->request->post['cmtx_rating'])) {
				$this->loadLanguage('part/average_rating');

				$this->loadModel('part/average_rating');

				$page_id = $this->request->post['cmtx_page_id'];

				$rating = $this->request->post['cmtx_rating'];

				$ip_address = $this->user->getIpAddress();

				if ($this->setting->get('maintenance_mode')) { // check if in maintenance mode
					$json['error'] = $this->data['lang_error_maintenance'];
				} else if (!$this->setting->get('show_average_rating')) { // check if feature enabled
					$json['error'] = $this->data['lang_error_disabled'];
				} else if (!$this->page->pageExists($page_id)) { // check if page exists
					$json['error'] = $this->data['lang_error_no_page'];
				} else if ($this->model_part_average_rating->hasAlreadyRatedPage($page_id, $ip_address)) { // check if user has already rated this page
					$json['error'] = $this->data['lang_error_rate_already'];
				} else if ($this->user->isBanned($ip_address)) { // check if user is banned
					$json['error'] = $this->data['lang_error_banned'];
				}

				if (!$json) {
					$this->model_part_average_rating->addRating($page_id, $rating, $ip_address);

					$json['success'] = $this->data['lang_error_rated'];

					$json['average_rating'] = $this->model_part_average_rating->getAverageRating($page_id);

					$json['num_of_ratings'] = $this->model_part_average_rating->getNumOfRatings($page_id);
				}
			}

			echo json_encode($json);
		}
	}
}
?>