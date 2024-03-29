<?php
namespace Commentics;

class PartPaginationModel extends Model
{
    public function calculate($current_page, $total_pages)
    {
        $range = $this->setting->get('pagination_range');

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

        return array(
            'start' => $start,
            'end'   => $end
        );
    }

    public function setPages($data, $current_page, $total_pages)
    {
        $data['pagination_url'] = $this->url->getPaginationUrl($this->page->getUrl()); // Used for search engines to index pages

        $data['current_page'] = $current_page;

        $data['total_pages'] = $total_pages;

        $data['pagination_url_first'] = $data['pagination_url'] . '1';

        $data['pagination_url_previous'] = $data['pagination_url'] . ($current_page - 1);

        $data['pagination_url_next'] = $data['pagination_url'] . ($current_page + 1);

        $data['pagination_url_last'] = $data['pagination_url'] . $total_pages;

        $data['previous_page'] = $current_page - 1;

        $data['next_page'] = $current_page + 1;

        return $data;
    }
}
