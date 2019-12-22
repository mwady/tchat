<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\User;
use \App\Session;
use \App\Models\Helper;

class Login extends \Core\Controller
{

    public function authAction()
    {

        $username = htmlspecialchars($_REQUEST['username'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_REQUEST['password'], ENT_QUOTES, 'UTF-8');

        $user = User::signIn($username);
        if($user){
            if (md5($password) == $user['password']) {

                Session::init();
                Session::setValue('id', Helper::crypt_decrypt($user['id'],'e'));
                Session::setValue('username', $user['username']);
                Session::setValue('email', $user['email']);
                User::tagAsConnected($user['id']);
                header("Location: messages");

            }else{

                $error = "Mot de passe ou username incorrect";
                View::renderTemplate('Login/login.html', ['error' => $error]);

            }
        }else{

            $error = "Username non trouvé";
            View::renderTemplate('Login/login.html', ['error' => $error]);

        }
        
    }

    public function logoutAction()
    {
        Session::init();
        $user_id = Helper::crypt_decrypt(Session::getValue('id'),'d');
        User::tagAsNotConnected($user_id);
        Session::destroy();
        header("Location: /");
    }
}
