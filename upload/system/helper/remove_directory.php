<?php
namespace {
    if (!function_exists('remove_directory')) {
		function remove_directory($dir) {
			if (is_dir($dir)) {
				$i = new DirectoryIterator($dir);

				foreach ($i as $f) {
					if ($f->isFile()) {
						unlink($f->getRealPath());
					} else if (!$f->isDot() && $f->isDir()) {
						remove_directory($f->getRealPath());
					}
				}

				rmdir($dir);
			}
		}
	}
}
?>