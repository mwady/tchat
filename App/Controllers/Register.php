<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\User;

class Register extends \Core\Controller
{

    public function registerAction()
    {
        View::renderTemplate('Login/register.html');
    }

    public function signupAction(){

        $data["name"] = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
        $data["email"] = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        $data["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
        $data["password"] = md5($_POST["password"]);

        if($_POST["password"] == $_POST["confirmpassword"]){

            if(!empty($_FILES['image']['name'])){

                $allowed=array('jpg','jpeg','png');
                $filename=$_FILES['image']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if(!in_array($ext,$allowed) ) { 
                    die("Sorry, only Images(jpg,jpeg,png) are allowed.");
                }
    
                $temp = explode(".", $_FILES["image"]["name"]);
                $code = round(microtime(true));
                $newfilename = $code . '.' . end($temp);
    
                $path = 'upload/avatar/'; 
                $location = $path . $newfilename; 
    
                move_uploaded_file($_FILES["image"]["tmp_name"], $location);
    
                $data["avatar"] = $newfilename;
    
            }else{
                $data["avatar"] = 0;
            }
            $signup = User::signUp($data);
            if($signup){
                header('Location: /');
            }

        }else{
            $error = "Les mots de passe sont pas identiques";
            View::renderTemplate('Login/register.html', ['error' => $error]);
        }


    }

}
