<?php
namespace Commentics;

class SettingsEmailSetupModel extends Model {
	public function update($data, $username, $admin_id) {
		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['transport_method']) . "' WHERE `title` = 'transport_method'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['smtp_host']) . "' WHERE `title` = 'smtp_host'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . (int)$data['smtp_port'] . "' WHERE `title` = 'smtp_port'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['smtp_encrypt']) . "' WHERE `title` = 'smtp_encrypt'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['smtp_username']) . "' WHERE `title` = 'smtp_username'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['smtp_password']) . "' WHERE `title` = 'smtp_password'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "settings` SET `value` = '" . $this->db->escape($data['sendmail_path']) . "' WHERE `title` = 'sendmail_path'");

		if (!empty($data['from_name'])) {
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "emails` SET `from_name` = '" . $this->db->escape($data['from_name']) . "'");
		}

		if (!empty($data['from_email'])) {
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "emails` SET `from_email` = '" . $this->db->escape($data['from_email']) . "'");
		}

		if (!empty($data['reply_to'])) {
			$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "emails` SET `reply_to` = '" . $this->db->escape($data['reply_to']) . "'");
		}

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "data` SET `text` = '" . $this->db->escape($data['signature_text']) . "', `modified_by` = '" . $this->db->escape($username) . "', `date_modified` = NOW() WHERE `type` = 'signature_text'");

		$this->db->query("UPDATE `" . CMTX_DB_PREFIX . "data` SET `text` = '" . $this->db->escape($data['signature_html']) . "', `modified_by` = '" . $this->db->escape($username) . "', `date_modified` = NOW() WHERE `type` = 'signature_html'");

		if (isset($data['send'])) {
			$this->send($admin_id);
		}
	}

	private function send($admin_id) {
		$this->loadModel('common/administrator');

		$administrator = $this->model_common_administrator->getAdmin($admin_id);

		$to_email = $administrator['email'];

		$format = $administrator['format'];

		$email = $this->email->get('setup_test');

		if ($format == 'text') {
			$body = $email['text'];
		} else {
			$body = $email['html'];
		}

		$subject = $this->security->decode($email['subject']);

		$body = str_ireplace('[username]', $this->session->data['cmtx_username'], $body);
		$body = str_ireplace('[admin link]', $this->email->getAdminLink(), $body);

		if ($format == 'text') {
			$body = str_ireplace('[signature]', $this->email->getSignatureText(), $body);
		} else {
			$body = str_ireplace('[signature]', $this->email->getSignatureHtml(), $body);
		}

		$body = $this->security->decode($body);

		$this->email->send($to_email, null, $subject, $body, $format, $email['from_email'], $email['from_name'], $email['reply_to']);
	}
}
?>