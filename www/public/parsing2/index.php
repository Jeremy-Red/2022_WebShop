<?php
use parsing\Parser;

// $url = 'https://www.discudemy.com/feed/';
// $url = 'https://www.noexistsrsslink.com/feed/';
$url = './assets/test';
require_once './Parser.php';
$p = new Parser($url);
$p->start();
