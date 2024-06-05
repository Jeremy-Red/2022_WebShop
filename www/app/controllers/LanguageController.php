<?php
namespace app\controllers;

use wfm\App;

class LanguageController extends AppController
{
    public function changeAction()
    {
        $lang = $_GET['lang'] ?? null;
        if ($lang) {
            $langs = App::$app->getProperty('languages');
            if (array_key_exists($lang, $langs)) {
                $url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');
                $url_parts = explode('/', $url, 2);
                if (array_key_exists($url_parts[0], $langs)) {
                    if ($lang != App::$app->getProperty('language')['code']) {
                        $url_parts[0] = $lang;
                    } else {
                        array_shift($url_parts);
                    }
                } else {
                    if ($lang != App::$app->getProperty('language')['code']) {
                        array_unshift($url_parts, $lang);
                    }
                }
                $url = PATH . '/' . implode('/', $url_parts);
                redirect($url);
            }
        }
        redirect();
    }
}