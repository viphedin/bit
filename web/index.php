<?php

use core\App;

ini_set("display_errors", 1);
error_reporting(E_ALL);

define ('BASE_DIR', dirname(__DIR__));

require BASE_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$configFile = BASE_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

$config = [];

if (is_file($configFile)) {
    $config = include $configFile;
}

App::run($config);