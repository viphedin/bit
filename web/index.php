<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'autoload.php';

$configFile = BASE_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

$config = [];

if (is_file($configFile)) {
    $config = include $configFile;
}

\core\App::run($config);