<?php

/**
 * API Model Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Model_Api extends Mage_Api_Model_Resource_Abstract
{
    public function alive() {
        $_result['response'] = array('code' => 200, 'status' => true);
        return $_result;
    }
}
