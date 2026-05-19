<?php
namespace Commentics;

class Session
{
    public $data = array();

    private $key = '';

    public function __construct()
    {
        $this->key = md5(CMTX_DIR_SYSTEM);

        if (!isset($_SESSION['commentics'])) {
            $_SESSION['commentics'] = array();
        }

        if (!isset($_SESSION['commentics'][$this->key])) {
            $_SESSION['commentics'][$this->key] = array();
        }

        // Upgrade compatibility. Migrate legacy flat session keys into namespaced storage. Remove in future version.

        if (empty($_SESSION['commentics'][$this->key]) && isset($_SESSION['cmtx_admin_id'])) {
            foreach ($_SESSION as $session_key => $value) {
                if (strpos($session_key, 'cmtx_') === 0) {
                    $_SESSION['commentics'][$this->key][$session_key] = $value;
                    unset($_SESSION[$session_key]);
                }
            }
        }

        $this->data = &$_SESSION['commentics'][$this->key];
    }

    public function start()
    {
        session_start();
    }

    public function getId()
    {
        return session_id();
    }

    public function getName()
    {
        return session_name();
    }

    public function regenerate()
    {
        session_regenerate_id(true);
    }

    public function end()
    {
        unset($_SESSION['commentics'][$this->key]);
    }
}
