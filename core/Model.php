<?php
/**
 * Created by PhpStorm.
 * UserModel: MVYaroslavcev
 * Date: 21/02/19
 * Time: 12:11
 */

namespace core;

use core\Config;
use PDO;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $config = new Config();
        $dsn = 'mysql:host=' .$config->getHost(). ';dbname=' .$config->getDatabase(). ';charset=utf8';
        $this->db = new PDO($dsn, $config->getLogin(), $config->getPassword());

    }
    public function query($sql)
    {
        $result = $this->db->query( $sql );
        return $result;
    }

    public function assoc( $sql )
    {
        $result = $this->db->query( $sql );
        return $result->fetchAll( PDO::FETCH_ASSOC );
    }

    public function obj( $sql )
    {
        $result = $this->db->query( $sql );
        return $result->fetchAll( PDO::FETCH_OBJ );
    }

}