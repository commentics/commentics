<?php
namespace Commentics;

class MainDatabaseModel extends Model {
	public function writeConfig() {
		$data = '<?php
		/* Database Details */
		define(\'CMTX_DB_DATABASE\', \'' . addslashes($this->request->post['database']) . '\');
		define(\'CMTX_DB_USERNAME\', \'' . addslashes($this->request->post['username']) . '\');
		define(\'CMTX_DB_PASSWORD\', \'' . addslashes($this->request->post['password']) . '\');
		define(\'CMTX_DB_HOSTNAME\', \'' . addslashes($this->request->post['hostname']) . '\');
		define(\'CMTX_DB_PORT\', \'' . addslashes($this->request->post['port']) . '\');
		define(\'CMTX_DB_PREFIX\', \'' . addslashes($this->request->post['prefix']) . '\');
		define(\'CMTX_DB_DRIVER\', \'' . addslashes($this->request->post['driver']) . '\');
		?>';

		$handle = fopen('../config.php', 'w');

		fputs($handle, preg_replace('/\t+/', '', $data));

		fclose($handle);

		chmod('../config.php', 0444);
	}
}
?>