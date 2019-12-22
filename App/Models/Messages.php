<?php

namespace App\Models;

use PDO;

class Messages extends \Core\Model
{

    public static function getUsersChatting($connected_user)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE id != :connected_user');
        $stmt->bindValue(':connected_user', $connected_user, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function conversationByUser($connected_user,$user_conversation_id){
        $db = static::getDB();
        $stmt = $db->prepare('SELECT messages.message,messages.to_user_id,messages.user_sender_id,users.avatar FROM messages
        LEFT JOIN users ON users.id = messages.user_sender_id
        WHERE ((to_user_id = :user_conversation_id) AND (user_sender_id = :connected_user))
        OR ((to_user_id = :connected_user) AND (user_sender_id = :user_conversation_id))');
        $stmt->bindValue(':connected_user', $connected_user, PDO::PARAM_STR);
        $stmt->bindValue(':user_conversation_id', $user_conversation_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addMessage($args)
    {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO messages (message,to_user_id,user_sender_id) VALUES (:message,:to_user_id,:user_sender_id)");
        $stmt->bindParam(':message', $args['message'], PDO::PARAM_STR);
        $stmt->bindParam(':to_user_id', $args['to_user_id'], PDO::PARAM_STR);
        $stmt->bindParam(':user_sender_id', $args['user_sender_id'], PDO::PARAM_STR);
        $exec = $stmt->execute();

        if(!empty($exec)){
            return true;
        }else{
            return false;
        }

    }

    public static function getLastMessageByUser($connected_user,$user_conversation_id){
        $db = static::getDB();
        $stmt = $db->prepare('SELECT messages.message,messages.user_sender_id FROM messages
        LEFT JOIN users ON users.id = messages.user_sender_id
        WHERE ((to_user_id = :user_conversation_id) AND (user_sender_id = :connected_user))
        OR ((to_user_id = :connected_user) AND (user_sender_id = :user_conversation_id))
        ORDER BY messages.message_id DESC LIMIT 0,1');
        $stmt->bindValue(':connected_user', $connected_user, PDO::PARAM_STR);
        $stmt->bindValue(':user_conversation_id', $user_conversation_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

}
