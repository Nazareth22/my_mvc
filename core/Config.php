<?php
/**
 * Created by PhpStorm.
 * UserModel: MVYaroslavcev
 * Date: 21/02/19
 * Time: 12:14
 */

namespace core;


class Config
{
    private $host;
    private $database;
    private $login;
    private $password;

    public function __construct()
    {
        $fillArray=parse_ini_file('../config/config.ini');

        $this->host=$fillArray['host'];
        $this->database=$fillArray['database'];
        $this->login=$fillArray['user'];
        $this->password=$fillArray['password'];
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }





}