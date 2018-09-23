<?php
/**
 * Project:     Securimage: A PHP class for creating and managing form CAPTCHA images<br />
 * File:        securimage_show.php<br />
 *
 * Copyright (c) 2013, Drew Phillips
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Any modifications to the library should be indicated clearly in the source code
 * to inform users that the changes are not a part of the original software.<br /><br />
 *
 * If you found this script useful, please take a quick moment to rate it.<br />
 * http://www.hotscripts.com/rate/49400.html  Thanks.
 *
 * @link http://www.phpcaptcha.org Securimage PHP CAPTCHA
 * @link http://www.phpcaptcha.org/latest.zip Download Latest Version
 * @link http://www.phpcaptcha.org/Securimage_Docs/ Online Documentation
 * @copyright 2013 Drew Phillips
 * @author Drew Phillips <drew@drew-phillips.com>
 * @version 3.6.6 (Nov 20 2017)
 * @package Securimage
 *
 */

namespace Commentics;

require_once dirname(__FILE__) . '/securimage.php';

$img = new Securimage();

define('CMTX_DIR_ROOT', str_replace('\\', '/', realpath(__DIR__ . '/../../')) . '/');

if (file_exists(CMTX_DIR_ROOT . 'config.php') && filesize(CMTX_DIR_ROOT . 'config.php')) {
	require_once CMTX_DIR_ROOT . 'config.php';

	if (extension_loaded('mysqli')) {
		if (CMTX_DB_PORT) {
			$link = @mysqli_connect(CMTX_DB_HOSTNAME, CMTX_DB_USERNAME, CMTX_DB_PASSWORD, CMTX_DB_DATABASE, CMTX_DB_PORT);
		} else {
			$link = @mysqli_connect(CMTX_DB_HOSTNAME, CMTX_DB_USERNAME, CMTX_DB_PASSWORD, CMTX_DB_DATABASE);
		}

		if ($link) {
			mysqli_set_charset($link, 'utf8');

			$settings = array();

			$query = mysqli_query($link, "SELECT * FROM `" . CMTX_DB_PREFIX . "settings` WHERE `title` LIKE 'securimage%'");

			while ($result = mysqli_fetch_assoc($query)) {
				$settings[$result['title']] = $result['value'];
			}

			$img->image_width = $settings['securimage_width'];
			$img->image_height = $settings['securimage_height'];
			$img->code_length = $settings['securimage_length'];
			$img->perturbation = $settings['securimage_perturbation'];
			$img->num_lines = $settings['securimage_lines'];
			$img->noise_level = $settings['securimage_noise'];
			$img->text_color = new Securimage_Color($settings['securimage_text_color']);
			$img->line_color = new Securimage_Color($settings['securimage_line_color']);
			$img->image_bg_color = new Securimage_Color($settings['securimage_back_color']);
			$img->noise_color = new Securimage_Color($settings['securimage_noise_color']);
		}
	}
}

// set namespace if supplied to script via HTTP GET
if (!empty($_GET['namespace'])) $img->setNamespace($_GET['namespace']);

$img->show();  // outputs the image and content headers to the browser
