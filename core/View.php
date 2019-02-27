<?php
/**
 * Created by PhpStorm.
 * UserModel: MVYaroslavcev
 * Date: 21/02/19
 * Time: 12:34
 */

namespace core;


use http\Message;

class View
{
    public function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = dirname(__DIR__) . "/src/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    public function renderTemplate($template, $args = [])
    {
        static $twig = null;
        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/src/Views');
            $twig = new \Twig_Environment($loader);
        }
        echo $twig->render($template, $args);
    }

    public static function errorCode($code) {
        http_response_code($code);
        $path = 'src/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

}