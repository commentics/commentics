<?php
namespace Commentics;

class LayoutCommentsCommentModel extends Model {
	public function update($data) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (isset($data['show_read_more']) ? 1 : 0) . "' WHERE `title` = 'show_read_more'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int)$data['read_more_limit'] . "' WHERE `title` = 'read_more_limit'");
	}
}
?>