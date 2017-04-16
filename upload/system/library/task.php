<?php
namespace Commentics;

class Task {
	private $db;
	private $comment;
	private $setting;

	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->comment = $registry->get('comment');
		$this->setting = $registry->get('setting');

		if (!$this->db->isConnected() || !$this->db->isInstalled()) {
			return;
		}

		if ($this->setting->get('task_enabled_delete_bans')) {
			$this->deleteBans();
		}

		if ($this->setting->get('task_enabled_delete_comments')) {
			$this->deleteComments();
		}

		if ($this->setting->get('task_enabled_delete_reporters')) {
			$this->deleteReporters();
		}

		if ($this->setting->get('task_enabled_delete_subscriptions')) {
			$this->deleteSubscriptions();
		}

		if ($this->setting->get('task_enabled_delete_voters')) {
			$this->deleteVoters();
		}
	}

	private function deleteBans() {
		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "bans` WHERE `date_added` < DATE_SUB(NOW(), INTERVAL " . (int)$this->setting->get('days_to_delete_bans') . " DAY)");
	}

	private function deleteComments() {
		$comments = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments` WHERE `date_added` < DATE_SUB(NOW(), INTERVAL " . (int)$this->setting->get('days_to_delete_comments') . " DAY)");

		foreach ($comments as $comment) {
			$this->comment->deleteComment($comment['id']);
		}
	}

	private function deleteReporters() {
		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "reporters` WHERE `date_added` < DATE_SUB(NOW(), INTERVAL " . (int)$this->setting->get('days_to_delete_reporters') . " DAY)");
	}

	private function deleteSubscriptions() {
		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `is_confirmed` = '0' AND `date_added` < DATE_SUB(NOW(), INTERVAL " . (int)$this->setting->get('days_to_delete_subscriptions') . " DAY)");
	}

	private function deleteVoters() {
		$this->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "voters` WHERE `date_added` < DATE_SUB(NOW(), INTERVAL " . (int)$this->setting->get('days_to_delete_voters') . " DAY)");
	}
}
?>