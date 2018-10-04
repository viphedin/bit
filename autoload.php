<?php

define('BASE_DIR', __DIR__);

require BASE_DIR . DIRECTORY_SEPARATOR . 'ClassLoader.php';

ClassLoader::addPath('core', BASE_DIR . DIRECTORY_SEPARATOR . 'core');
ClassLoader::addPath('app', BASE_DIR);

ClassLoader::init();