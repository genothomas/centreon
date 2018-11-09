<?php
/**
 * Copyright 2016 Centreon
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

define('_CENTREON_PATH_', realpath('/tmp/'));
define('_CENTREON_ETC_', realpath('/tmp/'));
// Disable warnings for PEAR.
error_reporting(E_ALL & ~E_STRICT);

require_once realpath(dirname(__FILE__) . '/../../vendor/autoload.php');

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__ . '/www/class'),
    realpath(__DIR__ . '/www/lib'),
    get_include_path()
)));

// Centreon Autoload
spl_autoload_register(function ($sClass) {
    $fileName = $sClass;
    $fileName{0} = strtolower($fileName{0});
    $fileNameType1 = __DIR__ . "/www/class/" . $fileName . ".class.php";
    $fileNameType2 = __DIR__ . "/www/class/" . $fileName . ".php";

    if (file_exists($fileNameType1)) {
        require_once $fileNameType1;
    } elseif (file_exists($fileNameType2)) {
        require_once $fileNameType2;
    }
});
