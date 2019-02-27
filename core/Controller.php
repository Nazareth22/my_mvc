<?php
/**
 * Created by PhpStorm.
 * UserModel: MVYaroslavcev
 * Date: 21/02/19
 * Time: 11:58
 */

namespace core;


abstract class Controller
{
    public $routeParams = [];

    private $security;

    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;

        if (!$this->checkSecurity()) {
            View::errorCode(403);
        }
    }

    public function render($template, $args = [])
    {
        $view = new View();

        $view->renderTemplate($template, $args);
    }

    private function checkSecurity()
    {
        $this->security = parse_ini_file('../config/security/'.$this->routeParams['controller'].'.ini', true);

        if ($this->isSecurity('all')) {
            return true;
        }
        elseif (isset($_SESSION['authorize']) and $this->isSecurity('authorize')) {
            return true;
        }
        elseif (!isset($_SESSION['authorize']) and $this->isSecurity('guest')) {
            return true;
        }
        elseif (isset($_SESSION['admin']) and $this->isSecurity('admin')) {
            return true;
        }
        return false;
    }

    private function isSecurity($key)
    {
        return in_array($this->routeParams['action'], $this->security[$key]);
    }

    public function getModel($name)
    {
        $path = '/src/Models/'.$name;
        return new $path;
    }

    public function redirect($url, $prot = 302)
    {
        header('Location: http://'.$_SERVER['HTTP_HOST']. $url, true, $prot);
    }


}