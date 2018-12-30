<?php
namespace Commentics;

abstract class Base
{
    public $registry = '';
    public $error = false;
    public $data = array();
    public $components = array();

    public function __construct($registry)
    {
        $this->registry = $registry;

        $this->setting->set('language', 'english');

        if (defined('CMTX_INSTALL') && $this->setting->has('language_install')) {
            $this->setting->set('language', $this->setting->get('language_install'));
        }

        if (defined('CMTX_BACKEND') && $this->setting->has('language_backend')) {
            $this->setting->set('language', $this->setting->get('language_backend'));
        }

        if (defined('CMTX_FRONTEND') && $this->setting->has('language_frontend')) {
            $this->setting->set('language', $this->setting->get('language_frontend'));

            if (defined('CMTX_LANGUAGE')) {
                $this->setting->set('language', CMTX_LANGUAGE);
            }
        }

        $this->setting->set('theme', 'default');

        if (defined('CMTX_INSTALL') && $this->setting->has('theme_install')) {
            $this->setting->set('theme', $this->setting->get('theme_install'));
        }

        if (defined('CMTX_BACKEND') && $this->setting->has('theme_backend')) {
            $this->setting->set('theme', $this->setting->get('theme_backend'));
        }

        if (defined('CMTX_FRONTEND') && $this->setting->has('theme_frontend')) {
            $this->setting->set('theme', $this->setting->get('theme_frontend'));
        }
    }

    public function __get($key)
    {
        return $this->registry->get($key);
    }

    public function __set($key, $value)
    {
        $this->registry->set($key, $value);
    }

    public function loadModel($cmtx_model)
    {
        if (file_exists(CMTX_DIR_MODEL . strtolower($cmtx_model) . '.php')) {
            require_once cmtx_modification(CMTX_DIR_MODEL . strtolower($cmtx_model) . '.php');

            $class = '\Commentics\\' . str_replace(array('/', '_'), '', $cmtx_model) . 'Model';

            $this->registry->set('model_' . str_replace('/', '_', $cmtx_model), new $class($this->registry));
        } else {
            die('<b>Error</b>: Could not load model ' . strtolower($cmtx_model) . '!');
        }
    }

    public function loadImage($cmtx_image)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/image/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/image/' . strtolower($cmtx_image);
        } else if (file_exists(CMTX_DIR_VIEW . 'default/image/' . strtolower($cmtx_image))) {
            return CMTX_HTTP_VIEW . 'default/image/' . strtolower($cmtx_image);
        } else {
            die('<b>Error</b>: Could not load image ' . strtolower($cmtx_image) . '!');
        }
    }

    public function loadJavascript($cmtx_javascript)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/javascript/' . strtolower($cmtx_javascript))) {
            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/javascript/' . strtolower($cmtx_javascript);
        } else if (file_exists(CMTX_DIR_VIEW . 'default/javascript/' . strtolower($cmtx_javascript))) {
            return CMTX_HTTP_VIEW . 'default/javascript/' . strtolower($cmtx_javascript);
        } else {
            die('<b>Error</b>: Could not load javascript ' . strtolower($cmtx_javascript) . '!');
        }
    }

    public function loadStylesheet($cmtx_stylesheet)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/' . strtolower($cmtx_stylesheet))) {
            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/stylesheet/css/' . strtolower($cmtx_stylesheet);
        } else if (file_exists(CMTX_DIR_VIEW . 'default/stylesheet/css/' . strtolower($cmtx_stylesheet))) {
            return CMTX_HTTP_VIEW . 'default/stylesheet/css/' . strtolower($cmtx_stylesheet);
        } else {
            die('<b>Error</b>: Could not load stylesheet ' . strtolower($cmtx_stylesheet) . '!');
        }
    }

    public function loadCustomCss()
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom.css')) {
            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom.css';
        } else if (file_exists(CMTX_DIR_VIEW . 'default/stylesheet/css/custom.css')) {
            return CMTX_HTTP_VIEW . 'default/stylesheet/css/custom.css';
        } else {
            return '';
        }
    }

    public function loadWord($cmtx_route, $cmtx_word = '')
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_route) . '.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_route) . '.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_route) . '.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_route) . '.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/english/' . strtolower($cmtx_route) . '.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/english/' . strtolower($cmtx_route) . '.php');
        } else {
            die('<b>Error</b>: Could not load language ' . strtolower($cmtx_route) . '!');
        }

        if ($cmtx_word) {
            if (isset($_[$cmtx_word])) {
                return $_[$cmtx_word];
            } else {
                die('<b>Error</b>: Could not load word ' . strtolower($cmtx_word) . '!');
            }
        } else {
            return $_;
        }
    }
}
