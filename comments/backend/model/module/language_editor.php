<?php
namespace Commentics;

class ModuleLanguageEditorModel extends Model
{
    private $exclude = array(
        'lang_title_digg',
        'lang_title_facebook',
        'lang_title_linkedin',
        'lang_title_reddit',
        'lang_title_twitter',
        'lang_title_weibo'
    );
    private $file = '';

    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->file = CMTX_DIR_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/language/' . $this->setting->get('language_frontend') . '/custom.php';
    }

    public function getText()
    {
        $directories = $results = array();

        $directories[] = $this->getDirectoryIterator(CMTX_DIR_ROOT . 'frontend/view/default/language/' . $this->setting->get('language_frontend') . '/');
        $directories[] = $this->getDirectoryIterator(CMTX_DIR_ROOT . 'frontend/view/default/language/' . $this->setting->get('language_frontend') . '/autoload/');
        $directories[] = $this->getDirectoryIterator(CMTX_DIR_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/language/' . $this->setting->get('language_frontend') . '/');
        $directories[] = $this->getDirectoryIterator(CMTX_DIR_ROOT . 'frontend/view/' . $this->setting->get('theme_frontend') . '/language/' . $this->setting->get('language_frontend') . '/autoload/');

        $iterator = new \AppendIterator();

        foreach ($directories as $directory) {
            if (!empty($directory)) {
                $iterator->append(new \RecursiveIteratorIterator($directory));
            }
        }

        $matches = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);

        $custom_file = '';

        foreach ($matches as $match) {
            if (substr($match[0], -10) == 'custom.php') {
                $custom_file = file($match[0]);
            } else {
                $file = file($match[0]);

                foreach ($file as $line_number => $line) {
                    $line_number++;

                    $line = trim(preg_replace('/\s+/', ' ', $line));

                    if ($line && substr($line, 0, 2) != '//' && $line != '<?php') {
                        $parts = explode('$_[\'', $line);
                        $parts = explode('\'] = \'', $parts[1]);
                        $parts[1] = $this->variable->substr($parts[1], 0, -2);
                        $parts[1] = str_replace("\'", "'", $parts[1]);

                        if (!in_array($parts[0], $this->exclude)) {
                            $results[$parts[0]] = array(
                                'key'  => $parts[0],
                                'text' => $this->security->encode($parts[1])
                            );
                        }
                    }
                }
            }
        }

        if ($custom_file) {
            foreach ($custom_file as $line_number => $line) {
                $line_number++;

                $line = trim(preg_replace('/\s+/', ' ', $line));

                if ($line && substr($line, 0, 2) != '//' && $line != '<?php') {
                    $parts = explode('$_[\'', $line);
                    $parts = explode('\'] = \'', $parts[1]);
                    $parts[1] = $this->variable->substr($parts[1], 0, -2);
                    $parts[1] = str_replace("\'", "'", $parts[1]);

                    if (!in_array($parts[0], $this->exclude)) {
                        if (empty($results[$parts[0]])) {
                            $results[$parts[0]] = array(
                                'key'    => $parts[0],
                                'text'   => $this->security->encode($parts[1]),
                                'custom' => $this->security->encode($parts[1])
                            );
                        } else {
                            $results[$parts[0]]['custom'] = $this->security->encode($parts[1]);
                        }
                    }
                }
            }
        }

        return $results;
    }

    private function getDirectoryIterator($path)
    {
        if (file_exists($path)) {
            $directory_iterator = new \RecursiveDirectoryIterator($path, \FilesystemIterator::UNIX_PATHS);
        } else {
            $directory_iterator = false;
        }

        return $directory_iterator;
    }

    private function addComments($handle, $key)
    {
        switch ($key) {
            case 'lang_date_time_format':
                $value = 'Date & Time';
                break;
            case 'lang_type_comment':
                $value = 'General';
            break;
            case 'lang_heading_comments':
                $value = 'Comments';
            break;
            case 'lang_heading_form':
                $value = 'Form';
            break;
            case 'lang_modal_upload_heading':
                $value = 'Modal';
            break;
            case 'lang_error_page_invalid':
                $value = 'Errors';
            break;
            case 'lang_button_submit':
                $value = 'Button';
            break;
            case 'lang_heading_maintenance':
                $value = 'Page';
            break;
            case 'lang_message_success':
                $value = 'User';
            break;
            case 'lang_title_avg_rating_1':
                $value = 'Other';
            break;
            default:
                $value = '';
        }

        if ($value) {
            if ($key != 'lang_date_time_format') {
                fputs($handle, "\r\n");
            }

            fputs($handle, '// ' . $value . "\r\n");
        }
    }

    public function update($data)
    {
        $directory = dirname($this->file);

        if (!is_dir($directory)) {
            @mkdir($directory, 0777, true);
        }

        file_put_contents($this->file, '<?php' . "\r\n");

        $handle = fopen($this->file, 'a');

        $ignore = array('csrf_key');

        foreach ($data as $key => $value) {
            if (!in_array($key, $ignore) && trim($value)) {
                $this->addComments($handle, $key);

                $value = $this->security->decode($value);

                $value = str_replace("'", "\\'", $value);

                fputs($handle, '$_[\'' . $key . '\'] = \'' . $value . '\';' . "\r\n");
            }
        }

        fclose($handle);
    }

    public function reset()
    {
        if ($this->fileExists()) {
            @unlink($this->file);
        }
    }

    public function download()
    {
        if ($this->fileExists()) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($this->file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($this->file));

            readfile($this->file);

            die();
        }
    }

    public function fileExists()
    {
        if (file_exists($this->file)) {
            return true;
        } else {
            return false;
        }
    }
}
