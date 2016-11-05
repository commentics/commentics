<?php
namespace Commentics;

class PartAverageRatingModel extends Model {
	public function getAverageRating($page_id) {
		$query = $this->db->query("	SELECT AVG(`rating`)
									FROM (
										SELECT `rating` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `is_approved` = '1' AND `rating` != '0' AND `page_id` = '" . (int)$page_id . "'
									UNION ALL
										SELECT `rating` FROM `" . CMTX_DB_PREFIX . "ratings` WHERE `page_id` = '" . (int)$page_id . "'
									)
									AS `average`
								 ");

		$result = $this->db->row($query);

		$average = round($result['AVG(`rating`)'], 0, PHP_ROUND_HALF_UP);

		return $average;
	}

	public function getNumOfRatings($page_id) {
		$total_1 = $this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `is_approved` = '1' AND `rating` != '0' AND `page_id` = '" . (int)$page_id . "'"));

		$total_2 = $this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "ratings` WHERE `page_id` = '" . (int)$page_id . "'"));

		$total = $total_1 + $total_2;

		return $total;
	}

	public function hasAlreadyRatedPage($page_id, $ip_address) {
		if ($this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `page_id` = '" . (int)$page_id . "' AND `ip_address` = '" . $this->db->escape($ip_address) . "' AND `rating` != '0'"))) {
			return true;
		}

		if ($this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "ratings` WHERE `page_id` = '" . (int)$page_id . "' AND `ip_address` = '" . $this->db->escape($ip_address) . "'"))) {
			return true;
		}

		return false;
	}

	public function addRating($page_id, $rating, $ip_address) {
		$this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "ratings` SET `page_id` = '" . (int)$page_id . "', `rating` = '" . (int)$rating . "', `ip_address` = '" . $this->db->escape($ip_address) . "', `date_added` = NOW()");
	}
}
?>