<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\User;
use \App\Models\Messages;
use \App\Models\Helper;
use \App\Session;
Session::init();

class Dashboard extends \Core\Controller
{

    /**
     * Afficher la page d'accueil
     *
     * @return void
     */
    public function dashboardAction()
    {
        if(!Session::exist()){
            header("Location: /");
        }

        $user_id = Session::getValue('id');
        $user_id = Helper::crypt_decrypt($user_id,'d');
        $userConnected = User::getUserConnected($user_id);
        $userConnected['image_profile'] = 'upload/avatar/'.$userConnected['avatar'];

        $users = Messages::getUsersChatting($user_id);
        $dataUsers = [];
        foreach($users as $user){
            if($user['avatar']){
                $user['image_profile'] = 'upload/avatar/'.$user['avatar'];
            }else{
                $user['image_profile'] = 'assets/images/userDef.jpg';
            }
            $user['crypt_id'] = Helper::crypt_decrypt($user['id'],'e');
            $lastMsg = Messages::getLastMessageByUser($user_id,$user['id']);
            $user['last_message'] = $lastMsg['message'];
            $user['whosent'] = $lastMsg['user_sender_id'];
            $dataUsers[] = $user;
        }

        View::renderTemplate('Dashboard/dashboard.html', ['userConnected' => $userConnected, 'users' => $dataUsers]);
    }

    public function liveUsersAction(){

        $user_id = Session::getValue('id');
        $users = Messages::getUsersChatting(Helper::crypt_decrypt($user_id,'d'));
        $dataUsers = [];
        foreach($users as $user){
            if($user['avatar']){
                $user['image_profile'] = 'upload/avatar/'.$user['avatar'];
            }else{
                $user['image_profile'] = 'assets/images/userDef.jpg';
            }

            $user['crypt_id'] = Helper::crypt_decrypt($user['id'],'e');
            $lastMsg = Messages::getLastMessageByUser(Helper::crypt_decrypt($user_id,'d'),$user['id']);
            $user['last_message'] = $lastMsg['message'];
            $user['whosent'] = $lastMsg['user_sender_id'];
            $dataUsers[] = $user;
        }

        View::renderTemplate('Dashboard/inc/liveusers.html', ['users' => $dataUsers]);

    }

    public function conversationAction(){
        
        $user_conversation_id = Helper::crypt_decrypt($_REQUEST['id'],'d');
        $userChat = User::getUserConnected($user_conversation_id);
        $userChat['image_profile'] = 'upload/avatar/'.$userChat['avatar'];
        $userChat['crypt_id'] = Helper::crypt_decrypt($userChat['id'],'e');

        $connected_user = Helper::crypt_decrypt(Session::getValue('id'),'d');
        $messages = Messages::conversationByUser($connected_user,$user_conversation_id);
        $messageData = [];
        foreach($messages as $message){
            if($message['user_sender_id'] == $connected_user){
                $message['stats'] = "replies";
            }else{
                $message['stats'] = "sent";
            }

            if($message['avatar']){
                $message['image_profile'] = 'upload/avatar/'.$message['avatar'];
            }else{
                $message['image_profile'] = 'assets/images/userDef.jpg';
            }

            $messageData[] = $message;
        }
        $user_connected_id = Session::getValue('id');
        View::renderTemplate('Dashboard/inc/conversation.html', ['userChat' => $userChat, 'messages' => $messageData, 'user_connected_id' => $user_connected_id]);

    }

    public function addMessageAction(){

        $user_sender_id = Helper::crypt_decrypt($_REQUEST['user_sender_id'],'d');
        $to_user_id = Helper::crypt_decrypt($_REQUEST['to_user_id'],'d');
        $message = $_REQUEST['message'];

        $args = ['user_sender_id' => $user_sender_id, 'to_user_id' => $to_user_id, 'message' => $message];
        $add = Messages::addMessage($args);
        
        echo $_REQUEST['to_user_id'];
        exit();

    }

}
