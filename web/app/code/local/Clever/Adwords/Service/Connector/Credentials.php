<?php

/**
 * Connector Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

class Clever_Adwords_Service_Connector_Credentials extends Clever_Adwords_Service_Abstract
{
    protected $_email;
    protected $_password;
    protected $_register_endpoint;
    protected $_unregister_endpoint;
    protected $_api_url;
    const UNREGISTER_ENDPOINT = 'uninstall_shop';
    const REGISTER_ENDPOINT = 'create_shop';

    public function __construct()
    {
        $this->_api_url = Mage::getStoreConfig('adwords/api/api_url');
        $this->_email = Mage::getStoreConfig('adwords/api/email');
        $this->_password = Mage::getStoreConfig('adwords/api/password');
        $this->_register_endpoint = self::REGISTER_ENDPOINT;
        $this->_unregister_endpoint = self::UNREGISTER_ENDPOINT;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getRegisterEndpoint()
    {
        return $this->_register_endpoint;
    }

    public function getUnRegisterEndpoint()
    {
        return $this->_unregister_endpoint;
    }

    public function getApiUrl()
    {
        return $this->_api_url;
    }
}