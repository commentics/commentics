<?php
namespace Commentics;

class PartSortByController extends Controller {
	public function index() {
		$this->loadLanguage('part/sort_by');

		if ($this->setting->get('show_sort_by_1') && $this->setting->get('show_date')) {
			$this->data['show_sort_by_1'] = true;
		} else {
			$this->data['show_sort_by_1'] = false;
		}

		if ($this->setting->get('show_sort_by_2') && $this->setting->get('show_date')) {
			$this->data['show_sort_by_2'] = true;
		} else {
			$this->data['show_sort_by_2'] = false;
		}

		if ($this->setting->get('show_sort_by_3') && $this->setting->get('show_like')) {
			$this->data['show_sort_by_3'] = true;
		} else {
			$this->data['show_sort_by_3'] = false;
		}

		if ($this->setting->get('show_sort_by_4') && $this->setting->get('show_dislike')) {
			$this->data['show_sort_by_4'] = true;
		} else {
			$this->data['show_sort_by_4'] = false;
		}

		if ($this->setting->get('show_sort_by_5') && $this->setting->get('show_rating')) {
			$this->data['show_sort_by_5'] = true;
		} else {
			$this->data['show_sort_by_5'] = false;
		}

		if ($this->setting->get('show_sort_by_6') && $this->setting->get('show_rating')) {
			$this->data['show_sort_by_6'] = true;
		} else {
			$this->data['show_sort_by_6'] = false;
		}

		if (isset($this->request->post['cmtx_sort_by']) && $this->request->post['cmtx_sort_by']) {
			$this->data['comments_order'] = $this->request->post['cmtx_sort_by'];
		} else {
			$this->data['comments_order'] = $this->setting->get('comments_order');
		}

		$this->data['commentics_url'] = $this->url->getCommenticsUrl();

		$this->data['page_id'] = $this->page->getId();

		return $this->data;
	}
}
?>