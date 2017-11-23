<?php

/**
 * Exception Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

class Clever_Adwords_Service_Exception_Rollbar
{
    static public function log($message, $level)
    {
        Rollbar::init(
            array(
                'access_token' => 'sign up, start trial, get access token',
                'environment' => 'production'
            )
        );

        Rollbar::log(Level::$level(), $message);

    }
}
