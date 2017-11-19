<?php

/**
 * Installation Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Install_Store
{
    protected $_instance;
    protected $_platform;
    protected $_store_hash;
    protected $_website;

    /**
     * Clever_Adwords_Service_Install_Store constructor.
     * @param $websiteId
     */
    public function __construct($websiteId)
    {
        $this->_website = $websiteId;
        $storeId = current(Mage::getModel('core/website')->load($websiteId)->getStoreIds());
        $this->_instance = Mage::getModel('core/store')->load($storeId);
        $this->_platform = 'community'; // to be parametrised
        // Generating the store id
        $this->generateStoreUniqueId();
    }

    public function getInstance()
    {
        return $this->_instance;
    }

    /**
     * @return array
     */
    public function getInformation()
    {
        $_store = [
            'name' => $this->getName(),
            'domain' => $this->getDomain(),
            'url' => $this->getUrl(),
            'countries' => $this->getCountries(),
            'logo_url' => $this->getLogoUrl(),
            'platform' => $this->_platform,
            'currency' => $this->getCurrency(),
            'language' => $this->getLanguages()

        ];
        return $_store;

    }

    /**
     * @return string
     * Generate the ID for the store which is unique for Clever's purposes
     */
    public function generateStoreUniqueId()
    {
        $_time_stamp = time();
        $_checksum = crc32($this->getDomain()) * $_time_stamp;
        $_result = md5(uniqid("{$_checksum}", true));
        $this->_store_hash = $_result;
        Mage::helper('clever_adwords')->setStoreUniqueId($_result, $this->_website);
    }

    public function getStoreUniqueId()
    {
        return $this->_store_hash;
    }

    private function getName()
    {
        return $this->_instance->getName();
    }

    private function getDomain()
    {
        return $this->_instance->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
    }

    private function getUrl()
    {
        return $this->_instance->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
    }

    private function getCountries()
    {
        return [Mage::getStoreConfig(Mage_Core_Helper_Data::XML_PATH_MERCHANT_COUNTRY_CODE, $this->_instance)];
    }

    private function getLanguages()
    {
        return [Mage::getStoreConfig('general/locale/code', $this->_instance->getId())];
    }

    private function getLogoUrl()
    {
        $_logo_path = Mage::getStoreConfig('design/header/logo_src', $this->_instance->getId());
        return Mage::getDesign()->getSkinUrl($_logo_path);
    }

    private function getCurrency()
    {
        return $this->_instance->getCurrentCurrencyCode();
    }

}