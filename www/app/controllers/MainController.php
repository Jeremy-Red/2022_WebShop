<?php
namespace app\controllers;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        // debug($this->model);
        echo __METHOD__;
    }
}