<?php
namespace wfm;

use Exception;
use RedBeanPHP\R;

class Db
{
    use TSingleton;
    private function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';
        R::setup($db['dsn'], $db['user'], $db['password']);
        if (!R::testConnection()) {
            throw new Exception('Connect to database is failed', 500);
        }
        R::freeze(true);
        if (DEBUG) {
            R::debug(true, 3);
        }
    }
}