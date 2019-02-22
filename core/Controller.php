<?php
/**
 * Created by PhpStorm.
 * User: MVYaroslavcev
 * Date: 21/02/19
 * Time: 11:58
 */

namespace core;


abstract class Controller
{
    public $routeParams = [];

    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;
    }

    public function render($template, $args = [])
    {
        $view = new View();

        $view->renderTemplate($template, $args = []);
    }


}