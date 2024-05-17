<?php
namespace app\controllers\admin;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        echo '<h1>Admin area web</h1>';
    }
}