<?php
namespace Commentics;

class ReportVersionCheckController extends Controller
{
    public function index()
    {
        $this->loadLanguage('report/version_check');

        $this->loadModel('report/version_check');

        $this->model_report_version_check->clearLog();

        $this->home->getLatestVersion(true);

        $this->data['log'] = $this->model_report_version_check->getLog();

        $this->data['link_back'] = 'index.php?route=main/dashboard';

        $this->data['lang_description'] = sprintf($this->data['lang_description'], 'https://www.commentics.org/forum/');

        $this->components = array('common/header', 'common/footer');

        $this->loadView('report/version_check');
    }
}
