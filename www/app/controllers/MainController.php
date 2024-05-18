<?php
namespace app\controllers;

use app\models\Main;
use wfm\Controller;

/** @property Main $model */
class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Title', 'Desc"ription', 'Keywords');
        $names = $this->model->get_names();
        $this->set(compact('names'));
    }
}