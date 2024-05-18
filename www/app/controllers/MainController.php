<?php
namespace app\controllers;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Title', 'Desc"ription', 'Keywords');
        $names = ['Kate', 'Jane', 'Mike'];
        $this->set(compact('names'));
    }
}