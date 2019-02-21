<?php
/**
 * Created by PhpStorm.
 * User: MVYaroslavcev
 * Date: 21/02/19
 * Time: 12:34
 */

namespace core;


class View
{
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = dirname(__DIR__) . "/src/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;
        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/src/Views');
            $twig = new \Twig_Environment($loader);
        }
        echo $twig->render($template, $args);
    }

}