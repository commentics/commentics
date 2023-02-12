<?php
namespace Commentics;

abstract class Base
{
    public $registry = '';
    public $error = array();
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

        if (!$this->setting->has('purpose')) {
            $this->setting->set('purpose', 'comment');
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

    public function loadFont($cmtx_font)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/font/' . strtolower($cmtx_font))) {
            return CMTX_DIR_VIEW . $this->setting->get('theme') . '/font/' . strtolower($cmtx_font);
        } else if (file_exists(CMTX_DIR_VIEW . 'default/font/' . strtolower($cmtx_font))) {
            return CMTX_DIR_VIEW . 'default/font/' . strtolower($cmtx_font);
        } else {
            die('<b>Error</b>: Could not load font ' . strtolower($cmtx_font) . '!');
        }
    }

    public function loadLanguage($cmtx_language, $cmtx_word = '')
    {
        /* Load general language file if it exists */
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/general.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/general.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/general.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/general.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/english/general.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/english/general.php');
        }

        /* Always load requested language file */
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/' . strtolower($cmtx_language) . '.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/english/' . strtolower($cmtx_language) . '.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/english/' . strtolower($cmtx_language) . '.php');
        } else {
            die('<b>Error</b>: Could not load language ' . strtolower($cmtx_language) . '!');
        }

        /* Autoload language files if any exist (default theme) */
        if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/autoload/')) {
            foreach (glob(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/autoload/*.php') as $filename) {
                require cmtx_modification($filename);
            }
        }

        /* Autoload language files if any exist (custom theme) */
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/autoload/')) {
            foreach (glob(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/autoload/*.php') as $filename) {
                require cmtx_modification($filename);
            }
        }

        /* Load custom language file if it exists */
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/custom.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/custom.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/custom.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/custom.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/english/custom.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/english/custom.php');
        }

        /* Change the comment type wording if configured */
        if ($this->setting->get('purpose') != 'comment') {
            $_ = $this->changePurpose($_);
        }

        if ($cmtx_word) {
            if (isset($_[$cmtx_word])) {
                return $_[$cmtx_word];
            } else {
                die('<b>Error</b>: Could not load word ' . strtolower($cmtx_word) . '!');
            }
        } else {
            /* Combine language files together */
            $this->data = array_merge($this->data, $_);
        }
    }

    private function changePurpose($cmtx_wording)
    {
        /* Load general language file if it exists */
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/general.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/language/' . $this->setting->get('language') . '/general.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/general.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/' . $this->setting->get('language') . '/general.php');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/language/english/general.php')) {
            require cmtx_modification(CMTX_DIR_VIEW . 'default/language/english/general.php');
        }

        /* If comment type wording is defined in selected language */
        if (isset($_['lang_type_comment'])) {
            foreach ($cmtx_wording as $key => &$value) {
                if ($this->variable->substr($key, 0, 10) != 'lang_type_') {
                    $value = str_replace(array('Commentics', 'commentics'), array('C-o-m-m-e-n-t-i-c-s', 'c-o-m-m-e-n-t-i-c-s'), $value);

                    if ($this->setting->get('purpose') == 'review') {
                        $value = str_replace($_['lang_type_comments'], $_['lang_type_reviews'], $value);
                        $value = str_replace($_['lang_type_comment'], $_['lang_type_review'], $value);

                        $value = str_replace($this->variable->fixCase($_['lang_type_comments']), $this->variable->fixCase($_['lang_type_reviews']), $value);
                        $value = str_replace($this->variable->fixCase($_['lang_type_comment']), $this->variable->fixCase($_['lang_type_review']), $value);
                    } else if ($this->setting->get('purpose') == 'testimonial') {
                        $value = str_replace($_['lang_type_comments'], $_['lang_type_testimonials'], $value);
                        $value = str_replace($_['lang_type_comment'], $_['lang_type_testimonial'], $value);

                        $value = str_replace($this->variable->fixCase($_['lang_type_comments']), $this->variable->fixCase($_['lang_type_testimonials']), $value);
                        $value = str_replace($this->variable->fixCase($_['lang_type_comment']), $this->variable->fixCase($_['lang_type_testimonial']), $value);
                    }

                    $value = str_replace(array('C-o-m-m-e-n-t-i-c-s', 'c-o-m-m-e-n-t-i-c-s'), array('Commentics', 'commentics'), $value);
                }
            }
        }

        return $cmtx_wording;
    }
}
