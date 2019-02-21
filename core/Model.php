<?php
/**
 * Created by PhpStorm.
 * User: MVYaroslavcev
 * Date: 21/02/19
 * Time: 12:11
 */

namespace core;

use core\Config;
use PDO;

abstract class Model
{
    protected static function getConnection()
    {
        $config = new Config();
        static $conn = null;
        if ($conn === null) {
            $dsn = 'mysql:host=' .$config->getHost(). ';dbname=' .$config->getDatabase(). ';charset=utf8';
            $conn = new PDO($dsn, $config->getLogin(), $config->getPassword());

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $conn;

    }

}