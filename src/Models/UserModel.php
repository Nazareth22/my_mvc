<?php
/**
 * Created by PhpStorm.
 * UserModel: MVYaroslavcev
 * Date: 22/02/19
 * Time: 14:04
 */

namespace src\Models;

use core\Model;

class UserModel extends Model
{
    public function reg($names, $email, $pass)
    {
        $result = array('status'=>false, 'data'=>
            [
            'names'=>$names,
            'email'=>$email,
            'pass'=>$pass,
                ],
            'message'=>'');

        if ( preg_match( '/[0-9a-z]+@[a-z]/', $email ) )
        {
            if ( preg_match( '/^[0-9A-Za-z]{5,20}$/', $pass ) )
            {
                if ( preg_match( '/[A-za-zА-яа-я]/', $names ) )
                {
                    $res = $this->assoc( "select * from user where email = '".$email."'" );
                    if (count($res) != 0)
                    {
                        if ($res[0]['email'] === $email)
                        {
                            $result['message'] = 'Ваш e-mail уже зарегистрирован в системе.';
                        }

                    }
                    else
                    {
                        $query = $this->query( "insert into user 
						(login, email, password, role) values 
						('" . $names . "', '" . $email . "', '" .md5($pass). "', 'authorize')" );
                        if ( $query )
                        {
                            $_SESSION['authorize'] = md5( $email . $pass );

                            $result['status'] = true;


                        }
                        else
                        {
                            $result['message'] = 'Вам не удалось зарегистрироваться.';
                        }
                    }
                }
                else
                {
                    $result['message'] = 'Ваше имя должно содержать только русские или латинские символы.';
                }
            }
            else
            {
                $result['message'] = 'Ваш пароль должен состоять из цифр и латинских символов длинной от 5 до 20.';
            }
        }
        else
        {
            $result['message'] = 'Ваш e-mail адрес введен не верно';
        }
        return $result;
    }

    public function login($names, $pass)
    {
        $result = array('status'=>false, 'data'=>
            [
                'names'=>$names,
                'pass'=>$pass,
            ],
            'message'=>'');
        $res = $this->assoc("select * from user where login = '".$names."' and password = '".md5($pass)."'");

        if (count($res) == 0)
        {
            $result['message'] = 'Вы ввели не верные данные';
        }
        else
        {
            $_SESSION[$res[0]['role']] = md5( $res[0]['email'] . $pass );

            $result['status'] = true;
        }

        return $result;

    }

}