<?php

namespace App\Models;

use PDO;

class Chat extends \Core\Model
{

    public static function getUsersConnected($connected_user)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT id,name,avatar, FROM users WHERE id != :connected_user');
        $stmt->bindValue(':connected_user', $connected_user, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

}
