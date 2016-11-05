<?php
namespace Commentics;

class AddCountryModel extends Model {
	public function add($data) {
		$this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "countries` SET `name` = '" . $this->db->escape($data['name']) . "', `code` = '" . $this->db->escape($data['code']) . "', `top` = '" . (int)$data['top'] . "', `enabled` = '" . (int)$data['enabled'] . "', `date_modified` = NOW(), `date_added` = NOW()");
	}
}
?>