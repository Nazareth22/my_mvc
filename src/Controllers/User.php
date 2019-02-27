<?php
/**
 * Created by PhpStorm.
 * UserModel: MVYaroslavcev
 * Date: 22/02/19
 * Time: 13:03
 */

namespace src\Controllers;

use core\Controller;
use src\Models\UserModel;

class User extends Controller
{
    public function registrationAction()
    {
        $result = array('status'=>false,
            'data'=>[
                'names'=>'',
                'email'=>'',
                'pass'=>'',
            ],
            'message'=>'');

        if (array_key_exists('submit', $_POST))
        {
            $userModel = new UserModel();

            $result = $userModel->reg($_POST['names'], $_POST['email'], $_POST['pass']);

            if ($result['status'])
            {
                $this->redirect('/');
            }
        }

        $this->render('User/registration.html', array('data'=>$result['data'], 'message'=>$result['message']));

    }

    public function loginAction()
    {
        $result = array('status'=>false,
            'data'=>[
                'names'=>'',
                'pass'=>'',
            ],
            'message'=>'');


        if (isset($_POST['names']) && isset($_POST['pass']))
        {
            $userModel = new UserModel();

            $result = $userModel->login($_POST['names'], $_POST['pass']);
            if ($result['status'])
            {
                $this->redirect('/');
            }

        }

        $this->render('User/login.html', array('data'=>$result['data'], 'message'=>$result['message']));

    }

}