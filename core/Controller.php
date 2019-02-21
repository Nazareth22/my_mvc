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
    protected $routeParams = [];

    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;
    }

    public function __call($name, $args)
    {
        $method = $name . 'Action';
        if (method_exists($this, $method))
        {
            if ($this->before() !== false)
            {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        }
        else
        {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    protected function before()
    {

    }

    protected function after()
    {

    }

}