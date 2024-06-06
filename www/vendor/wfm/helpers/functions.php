<?php
use wfm\App;

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
    if ($die)
        die;
}

function h($str)
{
    return htmlspecialchars($str, double_encode: false);
}

function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("location: {$redirect}");
    die;
}

function base_url()
{
    $lang = App::$app->getProperty('lang');
    $url = PATH . '/' .
        ($lang ? $lang . '/' : '');
    return $url;
}