<?php
namespace App;

class Session extends \Core\Controller {

    static function init() {
        session_start();
    }

    static function destroy() {
        session_destroy();
    }

    static function getValue($var) {
        return $_SESSION[$var];
    }

    static function setValue($var, $val) {
        $_SESSION[$var] = $val;
    }

    static function exist() {
        if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }

}
