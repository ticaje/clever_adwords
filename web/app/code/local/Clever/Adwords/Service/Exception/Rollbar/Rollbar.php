<?php

/**
 * Exception Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

class Clever_Adwords_Service_Exception_Rollbar_Rollbar
{
    static public function log($message, $level)
    {
        Rollbar::init(
            array(
                'access_token' => '2ebc59c9d3b641f3b5a57f8746b5ee69',
                'environment' => 'production'
            )
        );

        Rollbar::log(Level::$level(), $message);

    }
}
