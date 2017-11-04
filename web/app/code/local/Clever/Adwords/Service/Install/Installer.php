<?php

/**
 * Installation Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Install_Installer extends Clever_Adwords_Service_Abstract
{
    protected $_store;

    protected function _construct()
    {
        parent::_init('clever_adwords_service/install_installer');
    }

    public function __construct($storeId)
    {
        $this->_store = Mage::getModel('clever_adwords_service/install_store', $storeId);
    }

    public function openAPI()
    {

    }

    public function sendRequestToCleverAPI()
    {

    }

    public function getStore()
    {
        return $this->_store;
    }

    protected function fetchStoreInfo()
    {
        return $this->_store->getInformation();
    }

    public function fetchCredentials()
    {

    }

}
