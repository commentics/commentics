<?php
namespace Commentics;

class LoginResetModel extends Model
{
    public function sendReset($username, $password, $to_email, $format)
    {
        $email = $this->email->get('password_reset');

        if ($format == 'text') {
            $body = $email['text'];
        } else {
            $body = $email['html'];
        }

        $subject = $this->security->decode($email['subject']);

        $body = str_ireplace('[username]', $username, $body);
        $body = str_ireplace('[password]', $password, $body);
        $body = str_ireplace('[admin link]', $this->email->getAdminLink(), $body);

        if ($format == 'text') {
            $body = str_ireplace('[signature]', $this->email->getSignatureText(), $body);
        } else {
            $body = str_ireplace('[signature]', $this->email->getSignatureHtml(), $body);
        }

        $body = $this->security->decode($body);

        $this->email->send($to_email, null, $subject, $body, $format);
    }

    public function updatePassword($password, $email)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "admins` SET `password` = '" . $this->db->escape($password) . "' WHERE `email` = '" . $this->db->escape($email) . "'");
    }

    public function updateReset($email)
    {
        $this->db->query("UPDATE `" . CMTX_DB_PREFIX . "admins` SET `resets` = `resets` + 1 WHERE `email` = '" . $this->db->escape($email) . "'");
    }
}
