<?php
namespace Commentics;

abstract class Controller extends Base
{
    public function loadView($cmtx_view)
    {
        foreach ($this->components as $cmtx_component) {
            $this->data[basename($cmtx_component)] = $this->getComponent($cmtx_component);
        }

        if (!isset($this->data['success'])) {
            $this->data['success'] = '';
        }

        if (!isset($this->data['info'])) {
            $this->data['info'] = '';
        }

        if (!isset($this->data['error'])) {
            $this->data['error'] = '';
        }

        if (!isset($this->data['warning'])) {
            $this->data['warning'] = '';
        }

        if (defined('CMTX_BACKEND')) {
            foreach ($this->data as $cmtx_key => $cmtx_value) {
                if (substr($cmtx_key, 0, 5) != 'lang_') {
                    if (isset($this->error[$cmtx_key])) {
                        $this->data['error_' . $cmtx_key] = $this->error[$cmtx_key];
                    } else {
                        $this->data['error_' . $cmtx_key] = '';
                    }
                }
            }

            foreach ($this->data as $cmtx_key => &$cmtx_value) {
                if (substr($cmtx_key, 0, 10) == 'lang_hint_') {
                    $cmtx_value = $this->variable->hint($cmtx_value);
                } else if (substr($cmtx_key, 0, 12) == 'lang_dialog_' && substr($cmtx_key, -6) == '_title') {
                    $cmtx_value = $this->variable->encodeDouble($cmtx_value);
                }
            }
        }

        $generated_time = microtime(true) - CMTX_START_TIME;

        $this->data['generated_time'] = round($generated_time, 5);

        $this->data['php_time'] = round($generated_time - $this->db->getQueryTime(), 5);

        $this->data['query_time'] = round($this->db->getQueryTime(), 5);

        $this->data['query_count'] = $this->db->getQueryCount();

        unset($cmtx_component, $cmtx_key, $cmtx_value, $generated_time);

        extract($this->setting->all());

        extract($this->data);

        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_view) . '.tpl')) {
            $file = cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_view) . '.tpl');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_view) . '.tpl')) {
            $file = cmtx_modification(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_view) . '.tpl');
        } else {
            die('<b>Error</b>: Could not load view ' . strtolower($cmtx_view) . '!');
        }

        $cmtx_view = $this->parse($cmtx_view, $file);

        require $cmtx_view;
    }


    public function loadJavascript($cmtx_javascript)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/javascript/' . strtolower($cmtx_javascript))) {
            $modified = filemtime(CMTX_DIR_VIEW . $this->setting->get('theme') . '/javascript/' . strtolower($cmtx_javascript));

            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/javascript/' . strtolower($cmtx_javascript) . ($modified ? '?' . $modified : '');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/javascript/' . strtolower($cmtx_javascript))) {
            $modified = filemtime(CMTX_DIR_VIEW . 'default/javascript/' . strtolower($cmtx_javascript));

            return CMTX_HTTP_VIEW . 'default/javascript/' . strtolower($cmtx_javascript) . ($modified ? '?' . $modified : '');
        } else {
            die('<b>Error</b>: Could not load javascript ' . strtolower($cmtx_javascript) . '!');
        }
    }

    public function autoloadJavascript()
    {
        $auto_load = array();

        if (file_exists(CMTX_DIR_VIEW . 'default/javascript/autoload/')) {
            foreach (glob(CMTX_DIR_VIEW . 'default/javascript/autoload/*.js') as $filename) {
                $filename = basename($filename);

                $modified = filemtime(CMTX_DIR_VIEW . 'default/javascript/autoload/' . $filename);

                $auto_load[$filename] = CMTX_HTTP_VIEW . 'default/javascript/autoload/' . $filename . ($modified ? '?' . $modified : '');
            }
        }

        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/javascript/autoload/')) {
            foreach (glob(CMTX_DIR_VIEW . $this->setting->get('theme') . '/javascript/autoload/*.js') as $filename) {
                $filename = basename($filename);

                $modified = filemtime(CMTX_DIR_VIEW . $this->setting->get('theme') . '/javascript/autoload/' . $filename);

                $auto_load[$filename] = CMTX_HTTP_VIEW . $this->setting->get('theme') . '/javascript/autoload/' . $filename . ($modified ? '?' . $modified : '');
            }
        }

        return $auto_load;
    }

    public function loadStylesheet($cmtx_stylesheet)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/' . strtolower($cmtx_stylesheet))) {
            $modified = filemtime(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/' . strtolower($cmtx_stylesheet));

            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/stylesheet/css/' . strtolower($cmtx_stylesheet) . ($modified ? '?' . $modified : '');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/stylesheet/css/' . strtolower($cmtx_stylesheet))) {
            $modified = filemtime(CMTX_DIR_VIEW . 'default/stylesheet/css/' . strtolower($cmtx_stylesheet));

            return CMTX_HTTP_VIEW . 'default/stylesheet/css/' . strtolower($cmtx_stylesheet) . ($modified ? '?' . $modified : '');
        } else {
            die('<b>Error</b>: Could not load stylesheet ' . strtolower($cmtx_stylesheet) . '!');
        }
    }

    public function autoloadStylesheet()
    {
        $auto_load = array();

        if (file_exists(CMTX_DIR_VIEW . 'default/stylesheet/css/autoload/')) {
            foreach (glob(CMTX_DIR_VIEW . 'default/stylesheet/css/autoload/*.css') as $filename) {
                $filename = basename($filename);

                $modified = filemtime(CMTX_DIR_VIEW . 'default/stylesheet/css/autoload/' . $filename);

                $auto_load[$filename] = CMTX_HTTP_VIEW . 'default/stylesheet/css/autoload/' . $filename . ($modified ? '?' . $modified : '');
            }
        }

        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/autoload/')) {
            foreach (glob(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/autoload/*.css') as $filename) {
                $filename = basename($filename);

                $modified = filemtime(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/autoload/' . $filename);

                $auto_load[$filename] = CMTX_HTTP_VIEW . $this->setting->get('theme') . '/stylesheet/css/autoload/' . $filename . ($modified ? '?' . $modified : '');
            }
        }

        return $auto_load;
    }

    public function loadCustomCss()
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom.css')) {
            $modified = filemtime(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom.css');

            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom.css' . ($modified ? '?' . $modified : '');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/stylesheet/css/custom.css')) {
            $modified = filemtime(CMTX_DIR_VIEW . 'default/stylesheet/css/custom.css');

            return CMTX_HTTP_VIEW . 'default/stylesheet/css/custom.css' . ($modified ? '?' . $modified : '');
        } else {
            return '';
        }
    }

    public function loadSiteCss($site_id)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom_' . $site_id . '.css')) {
            $modified = filemtime(CMTX_DIR_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom_' . $site_id . '.css');

            return CMTX_HTTP_VIEW . $this->setting->get('theme') . '/stylesheet/css/custom_' . $site_id . '.css' . ($modified ? '?' . $modified : '');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/stylesheet/css/custom_' . $site_id . '.css')) {
            $modified = filemtime(CMTX_DIR_VIEW . 'default/stylesheet/css/custom_' . $site_id . '.css');

            return CMTX_HTTP_VIEW . 'default/stylesheet/css/custom_' . $site_id . '.css' . ($modified ? '?' . $modified : '');
        } else {
            return '';
        }
    }

    public function getComponent($cmtx_component, $cmtx_component_data = array())
    {
        /* Some components have a controller */
        if (file_exists(CMTX_DIR_CONTROLLER . strtolower($cmtx_component) . '.php')) {
            require_once cmtx_modification(CMTX_DIR_CONTROLLER . strtolower($cmtx_component) . '.php');

            $class = '\Commentics\\' . str_replace('/', '', $cmtx_component) . 'Controller';

            $class = str_replace('_', '', $class);

            $controller = new $class($this->registry);

            $this->data = array_merge($this->data, $controller->index($cmtx_component_data));
        }

        extract($this->setting->all());

        extract($this->data);

        ob_start();

        /* Some components have a view */
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_component) . '.tpl')) {
            $file = cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_component) . '.tpl');
        } else if (file_exists(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_component) . '.tpl')) {
            $file = cmtx_modification(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_component) . '.tpl');
        } else {
            return;
        }

        $cmtx_component = $this->parse($cmtx_component, $file);

        require $cmtx_component;

        return ob_get_clean();
    }

    public function loadTemplate($cmtx_template)
    {
        if (file_exists(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_template) . '.tpl')) {
            $file = cmtx_modification(CMTX_DIR_VIEW . $this->setting->get('theme') . '/template/' . strtolower($cmtx_template) . '.tpl');
        } else if (file_exists(cmtx_modification(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_template) . '.tpl'))) {
            $file = cmtx_modification(CMTX_DIR_VIEW . 'default/template/' . strtolower($cmtx_template) . '.tpl');
        } else {
            die('<b>Error</b>: Could not load template ' . strtolower($cmtx_template) . '!');
        }

        $cmtx_template = $this->parse($cmtx_template, $file);

        return $cmtx_template;
    }

    private function parse($name, $file)
    {
        if (defined('CMTX_FRONTEND')) {
            $cached_file = CMTX_DIR_CACHE . 'template/' . str_replace('/', '_', strtolower($name)) . '.tpl';

            $parse_template = false;

            clearstatcache();

            if (file_exists($cached_file)) {
                $cached_file_time = filemtime($cached_file);

                $template_file_time = filemtime($file);

                /* If modification time of both files was determined */
                if ($cached_file_time && $template_file_time) {
                    /* If cached file is older than template file */
                    if ($cached_file_time < $template_file_time) {
                        $parse_template = true;
                    }
                }
            } else {
                $parse_template = true;
            }

            if ($parse_template) {
                $code = file_get_contents($file);

                $this->template->setCode($code);

                $this->template->setMinify($this->setting->get('optimize'));

                $parsed = $this->template->parse();

                $handle = fopen($cached_file, 'w');

                if ($handle) {
                    fputs($handle, $parsed);

                    fclose($handle);
                }

                if (!file_exists($cached_file)) {
                    die('<b>Error</b>: Could not save cache for ' . strtolower($name) . '!');
                }
            }

            return $cached_file;
        } else {
            return $file;
        }
    }
}
