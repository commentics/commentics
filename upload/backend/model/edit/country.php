<?php
namespace Commentics;

class EditCountryModel extends Model {
	public function update($data, $id) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "countries` SET `name` = '" . $this->db->escape($data['name']) . "', `code` = '" . $this->db->escape($data['code']) . "', `top` = '" . (int)$data['top'] . "', `enabled` = '" . (int)$data['enabled'] . "', `date_modified` = NOW() WHERE `id` = '" . (int)$id . "'");
	}
}
?>