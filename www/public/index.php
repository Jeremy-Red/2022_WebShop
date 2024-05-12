<?php
use wfm\App;

if (PHP_MAJOR_VERSION < 8) {
    die('PHP version less than 8 is not supported');
}
require_once dirname(__DIR__) . '/config/init.php';

new App();

// throw new Exception('Test exception');
// echo $test;
echo 'Hello';