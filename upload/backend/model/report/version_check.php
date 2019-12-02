<?php
namespace Commentics;

class ReportVersionCheckModel extends Model
{
    public function clearLog()
    {
        $log_file = CMTX_DIR_LOGS . 'version_check.log';

        $handle = fopen($log_file, 'w');

        fputs($handle, '');

        fclose($handle);
    }

    public function getLog()
    {
        if (file_exists(CMTX_DIR_LOGS . 'version_check.log')) {
            $log = file_get_contents(CMTX_DIR_LOGS . 'version_check.log');
        } else {
            $log = '';
        }

        return $log;
    }
}
