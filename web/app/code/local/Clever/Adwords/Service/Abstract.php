<?php

/**
 * Abstract Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
abstract class Clever_Adwords_Service_Abstract extends Varien_Object
{
    const SHA_256 = 'sha256';
    protected $_store;
    protected $_email;

    protected function getHashMacAlgorithm()
    {
        return self::SHA_256;
    }

    protected function getHashSecret()
    {
        return '4n7fdidvdrzvwe5hb0i4blohf4d8crc'; // Will be stored later on
    }

    protected function persistStoreHash()
    {

    }
}