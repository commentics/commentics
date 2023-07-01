<?php
namespace Tests;

class Bootstrap
{
    public $registry;

    public function __construct() {
        require_once __DIR__ . '/../comments/config.php';

        if (!defined('CMTX_FRONTEND')) {
            define('CMTX_FRONTEND', true);

            define('CMTX_VERSION', '4.4');

            define('CMTX_DIR_THIS', __DIR__ . '/../comments/frontend/');
            define('CMTX_DIR_ROOT', dirname(CMTX_DIR_THIS) . '/');
            define('CMTX_DIR_SYSTEM', CMTX_DIR_ROOT . 'system/');
            define('CMTX_DIR_BACKUPS', CMTX_DIR_SYSTEM . 'backups/');
            define('CMTX_DIR_CACHE', CMTX_DIR_SYSTEM . 'cache/');
            define('CMTX_DIR_ENGINE', CMTX_DIR_SYSTEM . 'engine/');
            define('CMTX_DIR_EVENTS', CMTX_DIR_SYSTEM . 'events/');
            define('CMTX_DIR_HELPER', CMTX_DIR_SYSTEM . 'helper/');
            define('CMTX_DIR_LIBRARY', CMTX_DIR_SYSTEM . 'library/');
            define('CMTX_DIR_LOGS', CMTX_DIR_SYSTEM . 'logs/');
            define('CMTX_DIR_MODIFICATION', CMTX_DIR_SYSTEM . 'modification/');
            define('CMTX_DIR_MODEL', CMTX_DIR_THIS . 'model/');
            define('CMTX_DIR_VIEW', CMTX_DIR_THIS . 'view/');
            define('CMTX_DIR_CONTROLLER', CMTX_DIR_THIS . 'controller/');
            define('CMTX_DIR_3RDPARTY', CMTX_DIR_ROOT . '3rdparty/');
            define('CMTX_DIR_UPLOAD', CMTX_DIR_ROOT . 'upload/');

            define('CMTX_HTTP_VIEW', '');
            define('CMTX_HTTP_3RDPARTY', '');

            define('CMTX_IDENTIFIER', '1');
            define('CMTX_REFERENCE', 'Page One');
            define('CMTX_URL', 'http://localhost/example.php');
        }

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $_SERVER['HTTP_REFERER'] = 'http://localhost/example.php';

        $_POST['cmtx_login'] = 0;

        require CMTX_DIR_SYSTEM . 'startup.php';

        $this->registry = $cmtx_registry;
    }
}
