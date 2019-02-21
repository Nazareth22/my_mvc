<?php
/**
 * Created by PhpStorm.
 * User: MVYaroslavcev
 * Date: 21/02/19
 * Time: 15:27
 */

namespace src\Controllers;

use core\Controller;
use core\View;

class Home extends Controller
{
    public function indexAction()
    {
        View::renderTemplate('Home/index.html');
    }

}