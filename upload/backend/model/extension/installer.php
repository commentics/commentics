<?php
namespace Commentics;

class ExtensionInstallerModel extends Model {
	public function install() {
		// Load the error messages
		$error = $this->loadWord('extension/installer');

		// Name of the temp folder to store the uploaded zip file
		$temp_folder = CMTX_DIR_UPLOAD . 'temp-' . $this->variable->random();

		// Create the temp folder
		mkdir($temp_folder, 0777);

		// Check if the temp folder exists
		if (!is_dir($temp_folder)) {
			return $error['lang_error_no_temp_dir'];
		}

		// Location of the zip file once uploaded
		$zip_file = $temp_folder . '/upload.zip';

		// Store the uploaded zip file in the temp folder
		move_uploaded_file($this->request->files['file']['tmp_name'], $zip_file);

		// If the uploaded zip file exists
		if (file_exists($zip_file)) {
			// Check if it's an acceptable file
			if (!is_file($zip_file) || substr(str_replace('\\', '/', realpath($zip_file)), 0, strlen(CMTX_DIR_UPLOAD)) != CMTX_DIR_UPLOAD) {
				remove_directory($temp_folder);

				return $error['lang_error_zip_issue'];
			}

			// We use the ZipArchive class
			$zip = new \ZipArchive();

			// Extract the zip file
			if ($zip->open($zip_file)) {
				$zip->extractTo($temp_folder);

				$zip->close();
			} else {
				remove_directory($temp_folder);

				return $error['lang_error_zip_no_extract'];
			}

			// Delete the zip file
			unlink($zip_file);
		} else {
			remove_directory($temp_folder);

			return $error['lang_error_zip_not_stored'];
		}

		// Path to the /upload/ folder inside the extracted zip
		$directory = $temp_folder . '/upload/';

		// Check the extracted zip has the /upload/ folder inside it
		if (!is_dir($directory) || substr(str_replace('\\', '/', realpath($directory)), 0, strlen(CMTX_DIR_UPLOAD)) != CMTX_DIR_UPLOAD) {
			remove_directory($temp_folder);

			return $error['lang_error_no_upload_in_zip'];
		}

		// Variable to store the list of files to upload
		$files = array();

		$path = array($directory . '*');

		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}

				$files[] = $file;
			}
		}

		// For every file to upload
		foreach ($files as $file) {
			$destination = substr($file, strlen($directory));

			// Set the corresponding server path depending on its starting folder
			if (substr($destination, 0, 7) == 'backend') {
				$destination = CMTX_DIR_THIS . substr($destination, 7);
			} else if (substr($destination, 0, 8) == 'frontend') {
				$destination = CMTX_DIR_FRONTEND . substr($destination, 8);
			} else if (substr($destination, 0, 6) == 'system') {
				$destination = CMTX_DIR_SYSTEM . substr($destination, 6);
			} else if (substr($destination, 0, 8) == '3rdparty') {
				$destination = CMTX_DIR_3RDPARTY . substr($destination, 8);
			} else {
				$destination = CMTX_DIR_ROOT . $destination;
			}

			// If it's a directory then create it
			if (is_dir($file)) {
				if (!file_exists($destination)) {
					if (!mkdir($destination)) {
						remove_directory($temp_folder);

						return $error['lang_error_dir_create'];
					}
				}
			}

			// If it's a file then copy it there
			if (is_file($file)) {
				if (!copy($file, $destination)) {
					remove_directory($temp_folder);

					return $error['lang_error_file_create'];
				}
			}
		}

		// Delete the temp folder
		remove_directory($temp_folder);

		return false;
	}
}
?>