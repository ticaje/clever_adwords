<?php

/**
 * Abstract Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
abstract class Clever_Adwords_Service_Api_Abstract
{
    protected $_consumer_name;
    protected $_role_name;
    protected $_helper;

    public function __construct()
    {
        $this->_helper = Mage::helper('oauth');
        $this->_consumer_name = 'Clever Consumer'; //To load from config
        $this->_role_name = 'Clever Role'; //To load from config
        $this->generateConsumerCredentials();
    }

    abstract protected function generateConsumerCredentials();

    abstract protected function createRole($data);

    abstract protected function assignRoleToUser($data);

    abstract protected function getConsumerCredentials();

    abstract public function generateCredentials();
}