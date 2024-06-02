<?php
namespace app\controllers;

use app\models\AppModel;
use wfm\App;
use wfm\Controller;
use app\widgets\language\Language;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel;
        App::$app->setProperty('languages', Language::getLanguages());
        debug(App::$app->getProperty('languages'));
    }
}