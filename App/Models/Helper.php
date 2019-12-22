<?php

namespace App\Models;

class Helper extends \Core\Model
{
    
    public static function crypt_decrypt($string,$action) {

        $secret_key = 'dc514d5607b06c4b7c87144e5b35aa39';//md5('tchat_key')
        $secret_iv = '4518d889641fc0893e582273d3defb15';//md5('tchat_iv')
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
     
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        return $output;

    }
}
