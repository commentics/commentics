<?php
namespace Commentics;

class Geo {
	private $db;

	public function __construct($registry) {
		$this->db = $registry->get('db');
	}

	public function countryExists($id) {
		if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "countries` WHERE `id` = '" . (int)$id . "'"))) {
			return true;
		} else {
			return false;
		}
	}

	public function countryExistsByCode($code, $exclude_id = 0) {
		if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "countries` WHERE `code` = '" . $this->db->escape($code) . "' AND `id` != '" . (int)$exclude_id . "'"))) {
			return true;
		} else {
			return false;
		}
	}

	public function countryValid($id) {
		if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "countries` WHERE `id` = '" . (int)$id . "' AND `enabled` = '1'"))) {
			return true;
		} else {
			return false;
		}
	}

	public function getCountry($id) {
		$query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "countries` WHERE `id` = '" . (int)$id . "'");

		$result = $this->db->row($query);

		return $result;
	}

	public function getCountries() {
		$countries = array();

		$query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "countries` WHERE `top` = '1' AND `enabled` = '1' ORDER BY `name` ASC");

		if ($this->db->numRows($query)) {
			$results = $this->db->rows($query);

			$countries[] = array(
				'id'	=> '',
				'name'	=> '---',
				'code'	=> ''
			);

			foreach ($results as $result) {
				$countries[] = array(
					'id'	=> $result['id'],
					'name'	=> $result['name'],
					'code'	=> $result['code']
				);
			}

			$countries[] = array(
				'id'	=> '',
				'name'	=> '---',
				'code'	=> ''
			);
		}

		$query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "countries` WHERE `top` = '0' AND `enabled` = '1' ORDER BY `name` ASC");

		$results = $this->db->rows($query);

		foreach ($results as $result) {
			$countries[] = array(
				'id'	=> $result['id'],
				'name'	=> $result['name'],
				'code'	=> $result['code']
			);
		}

		return $countries;
	}

	public function deleteCountry($id) {
		$query = $this->db->query("SELECT `code` FROM `" . CMTX_DB_PREFIX . "countries` WHERE `id` = '" . (int)$id . "'");

		$result = $this->db->row($query);

		$code = $result['code'];

		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "states` WHERE `country_code` = '" . $this->db->escape($code) . "'");

		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "countries` WHERE `id` = '" . (int)$id . "'");

		if ($this->db->affectedRows()) {
			return true;
		} else {
			return false;
		}
	}

	public function stateExists($id) {
		if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "states` WHERE `id` = '" . (int)$id . "'"))) {
			return true;
		} else {
			return false;
		}
	}

	public function stateValid($id, $country_id = 0) {
		if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "states` WHERE `id` = '" . (int)$id . "' AND `enabled` = '1'"))) {
			if ($country_id) {
				/* Make sure the submitted state belongs to the submitted country */
				$query = $this->db->query(" SELECT * FROM `" . CMTX_DB_PREFIX . "states` `s`
											RIGHT JOIN `" . CMTX_DB_PREFIX . "countries` `c` ON `s`.`country_code` = `c`.`code`
											WHERE `s`.`id` = '" . (int)$id . "'
											AND `c`.`id` = '" . (int)$country_id . "'
											");

				if ($this->db->numRows($query)) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	public function getState($id) {
		$query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "states` WHERE `id` = '" . (int)$id . "'");

		$result = $this->db->row($query);

		return $result;
	}

	public function getStates() {
		$query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "states` WHERE `enabled` = '1' ORDER BY `name` ASC");

		$results = $this->db->rows($query);

		return $results;
	}

	public function getStatesByCountryId($id) {
		$query = $this->db->query("SELECT `code` FROM `" . CMTX_DB_PREFIX . "countries` WHERE `id` = '" . (int)$id . "'");

		$result = $this->db->row($query);

		$code = $result['code'];

		$query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "states` WHERE `country_code` = '" . $this->db->escape($code) . "' AND `enabled` = '1' ORDER BY `name` ASC");

		$results = $this->db->rows($query);

		return $results;
	}

	public function deleteState($id) {
		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "states` WHERE `id` = '" . (int)$id . "'");

		if ($this->db->affectedRows()) {
			return true;
		} else {
			return false;
		}
	}
}
?>