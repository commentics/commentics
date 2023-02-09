<?php
namespace Commentics;

class PartPaginationController extends Controller
{
    public function index($component_data)
    {
        $this->loadLanguage('part/pagination');

        $this->loadModel('part/pagination');

        $result = $this->model_part_pagination->calculate($component_data['current_page'], $component_data['total_pages']);

        $this->data = $this->model_part_pagination->setPages($this->data, $component_data['current_page'], $component_data['total_pages']);

        $this->data['pages'] = array();

        for ($i = $result['start']; $i <= $result['end']; $i++) {
            $this->data['pages'][] = array(
                'number' => $i,
                'url'    => $this->data['pagination_url'] . $i
            );
        }

        return $this->data;
    }
}
