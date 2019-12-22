<?php

namespace App\Models;

use PDO;

class User extends \Core\Model
{

    public static function signIn($username)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT id,username,email,password FROM users WHERE username = :username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function tagAsConnected($user_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('UPDATE users SET	is_connected = 1 WHERE id = :user_id');
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function tagAsNotConnected($user_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('UPDATE users SET	is_connected = 0 WHERE id = :user_id');
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function signUp($args)
    {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO users (name,username,email,password,avatar) VALUES (:name,:username,:email,:password,:avatar)");
        $stmt->bindParam(':name', $args['name'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $args['username'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $args['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $args['password'], PDO::PARAM_STR);
        $stmt->bindParam(':avatar', $args['avatar'], PDO::PARAM_STR);
        $exec = $stmt->execute();

        if(!empty($exec)){
            return true;
        }else{
            return false;
        }

    }

    public static function getUserConnected($user_id){
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :user_id');
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }


}
