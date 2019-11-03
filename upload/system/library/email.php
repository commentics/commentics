<?php
namespace Commentics;

class Email
{
    private $db;
    private $setting;

    public function __construct($registry)
    {
        $this->db      = $registry->get('db');
        $this->setting = $registry->get('setting');
    }

    public function get($type)
    {
        /* The new version email is sent from the frontend but uses the backend language */
        if ($type == 'new_version') {
            $language = $this->setting->get('language_backend');
        } else {
            $language = $this->setting->get('language');
        }

        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "emails` WHERE `type` = '" . $this->db->escape($type) . "' AND `language` = '" . $this->db->escape($language) . "'"))) {
            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "emails` WHERE `type` = '" . $this->db->escape($type) . "' AND `language` = '" . $this->db->escape($language) . "'");

            return $this->db->row($query);
        } else if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "emails` WHERE `type` = '" . $this->db->escape($type) . "' AND `language` = 'english'"))) {
            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "emails` WHERE `type` = '" . $this->db->escape($type) . "' AND `language` = 'english'");

            return $this->db->row($query);
        } else {
            die('<b>Error</b>: Could not load email ' . strtolower($type) . '!');
        }
    }

    public function getSignatureText($site_id = '')
    {
        $query = $this->db->query("SELECT `text` FROM `" . CMTX_DB_PREFIX . "data` WHERE `type` = 'signature_text'");

        $result = $this->db->row($query);

        $signature = $result['text'];

        $signature = $this->convertSignatureKeywords($signature, $site_id);

        return $signature;
    }

    public function getSignatureHtml($site_id = '')
    {
        $query = $this->db->query("SELECT `text` FROM `" . CMTX_DB_PREFIX . "data` WHERE `type` = 'signature_html'");

        $result = $this->db->row($query);

        $signature = $result['text'];

        $signature = $this->convertSignatureKeywords($signature, $site_id);

        return $signature;
    }

    private function convertSignatureKeywords($signature, $site_id)
    {
        $site_name = $this->setting->get('site_name');
        $site_domain = $this->setting->get('site_domain');
        $site_url = $this->setting->get('site_url');

        if ($site_id) {
            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "sites` WHERE `id` = '" . (int) $site_id . "'");

            $result = $this->db->row($query);

            if ($result) {
                $site_name = $result['name'];

                $site_domain = $result['domain'];

                $site_url = $result['url'];
            }
        }

        $signature = str_ireplace('[site name]', $site_name, $signature);
        $signature = str_ireplace('[site domain]', $site_domain, $signature);
        $signature = str_ireplace('[site url]', $site_url, $signature);

        return $signature;
    }

    public function getAdminLink()
    {
        return $this->setting->get('commentics_url') . $this->setting->get('backend_folder') . '/';
    }

    public function send($to_email, $to_name, $subject, $body, $format, $site_id = '')
    {
        $from_name = $this->setting->get('from_name');
        $from_email = $this->setting->get('from_email');
        $reply_email = $this->setting->get('reply_email');

        if ($site_id) {
            $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "sites` WHERE `id` = '" . (int) $site_id . "'");

            $result = $this->db->row($query);

            if ($result) {
                if ($result['from_name']) {
                    $from_name = $result['from_name'];
                }

                if ($result['from_email']) {
                    $from_email = $result['from_email'];
                }

                if ($result['reply_email']) {
                    $reply_email = $result['reply_email'];
                }
            }
        }

        if ($this->setting->get('transport_method') == 'php-basic') {
            if (!empty($to_name)) {
                $to_email = $to_name . ' <' . $to_email . '>';
            }

            $headers = 'From: ' . $from_name . ' <' . $from_email . '>' . "\r\n";

            $headers .= 'Reply-To: ' . $reply_email . "\r\n";

            if ($format == 'text') {
                $headers .= 'Content-Type: text/plain; charset=utf-8' . "\r\n";
            } else {
                $headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
            }

            mail($to_email, $subject, $body, $headers);
        } else {
            if (!class_exists('Swift')) {
                require_once CMTX_DIR_3RDPARTY . 'swift_mailer/lib/swift_required.php';
            }

            if ($this->setting->get('transport_method') == 'php') {
                $transport = \Swift_MailTransport::newInstance();
            } else if ($this->setting->get('transport_method') == 'smtp') {
                $transport = \Swift_SmtpTransport::newInstance();

                $transport->setHost($this->setting->get('smtp_host'));

                $transport->setPort($this->setting->get('smtp_port'));

                if ($this->setting->get('smtp_encrypt') == 'ssl') {
                    $transport->setEncryption('ssl');
                } else {
                    $transport->setEncryption('tls');
                }

                if ($this->setting->get('smtp_username') && $this->setting->get('smtp_password')) {
                    $transport->setUsername($this->setting->get('smtp_username'));

                    $transport->setPassword($this->setting->get('smtp_password'));
                }
            } else if ($this->setting->get('transport_method') == 'sendmail') {
                $transport = \Swift_SendmailTransport::newInstance($this->setting->get('sendmail_path') . ' -bs');
            }

            $mailer = \Swift_Mailer::newInstance($transport);

            $message = \Swift_Message::newInstance();

            $message->setSubject($subject);

            $message->setFrom(array($from_email => $from_name));

            $message->setReplyTo($reply_email);

            if (empty($to_name)) {
                $message->setTo($to_email);
            } else {
                $message->setTo(array($to_email => $to_name));
            }

            $message->setBody($body);

            if ($format == 'text') {
                $message->setContentType('text/plain');
            } else {
                $message->setContentType('text/html');
            }

            $message->setCharset('UTF-8');

            $message->setEncoder(\Swift_Encoding::get8BitEncoding());

            $message->setMaxLineLength(1000);

            $result = $mailer->send($message);
        }
    }
}
