<?php

/**
 * Helper Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Helper_Data extends Mage_Core_Helper_Abstract
{
    const CACHE_CONFIG_TYPE = 'config';
    const AUTOLOADER_CLEVER_FOLDER = 'Clever';

    public function getWebsitesList()
    {
        $_result = [null => Mage::helper('clever_adwords')->__('Please Select')];
        $_websites = Mage::getResourceModel( 'core/website_collection' );
        foreach ($_websites as $index => $website){
            $_values['label'] = $website->getName();
            // I will just pick up the first one
            $_values['value'] = $website->getId();
            $_result[$index] = $_values;
        }
        return $_result;
    }

    public function isInstalled()
    {
        return Mage::getStoreConfig('adwords/general/installed');
    }

    public function setInstalled()
    {
        Mage::getConfig()->saveConfig('adwords/general/installed', 1);
        Mage::app()->getCacheInstance()->cleanType(self::CACHE_CONFIG_TYPE);
        Mage::dispatchEvent('adminhtml_cache_refresh_type', array('type' => self::CACHE_CONFIG_TYPE));
    }

    public function setStoreUniqueId($hash)
    {
        Mage::getConfig()->saveConfig('adwords/store/store_hash', $hash);
    }

    public function setStoreHmac($hmac)
    {
        Mage::getConfig()->saveConfig('adwords/store/hmac', $hmac);
    }

    /**
     * @return string
     */
    public function getExternalLibDirPath()
    {
        return Mage::getBaseDir('lib') . DS . self::AUTOLOADER_CLEVER_FOLDER;
    }
}