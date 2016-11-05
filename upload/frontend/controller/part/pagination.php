<?php
namespace Commentics;

class PartPaginationController extends Controller {
	public function index($component_data) {
		$this->loadLanguage('part/pagination');

		$current_page = $component_data['current_page'];

		$total_pages = $component_data['total_pages'];

		$range = $this->setting->get('pagination_range');

		// TODO: Move following to model

		if ($total_pages <= $range) {
			$start = 1;

			$end = $total_pages;
		} else {
			$start = $current_page - floor($range / 2);

			$end = $current_page + floor($range / 2);

			if ($start < 1) {
				$end += abs($start) + 1;

				$start = 1;
			}

			if ($end > $total_pages) {
				$start -= ($end - $total_pages);

				$end = $total_pages;
			}
		}

		$this->data['current_page'] = $current_page;

		$this->data['total_pages'] = $total_pages;

		$this->data['start'] = $start;

		$this->data['end'] = $end;

		$this->data['commentics_url'] = $this->url->getCommenticsUrl();

		$this->data['pagination_url'] = $this->url->getPaginationUrl($this->page->getUrl()); // Used for search engines to index pages

		$this->data['page_id'] = $this->page->getId();

		return $this->data;
	}
}
?>