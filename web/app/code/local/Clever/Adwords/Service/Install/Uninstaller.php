<?php

/**
 * Installation Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Install_Uninstaller extends Clever_Adwords_Service_Abstract
{

    /**
     * @param $protocol
     */
    public function closeApi($protocol)
    {
        $_remove_api_credentials_method = "removeApi{$protocol}Credentials";
        $_remove_api_credentials = $this->$_remove_api_credentials_method();
        $this->removeSettings();
        return $_remove_api_credentials;
    }

    protected function removeApiSoapCredentials()
    {
        // By deleting the user i also remove those roles link to this user
        $_user = Mage::getModel('api/user')->loadByUsername(Clever_Adwords_Service_Settings::CLEVER_CONSUMER_USERNAME);
        if ($_user->delete()){
            return true;
        }
        return false;
    }

    protected function removeSettings()
    {
        // Unset store unique ID
        Mage::getConfig()->saveConfig('adwords/store/store_hash', '');
        // Unset store Hmac
        Mage::getConfig()->saveConfig('adwords/store/hmac', '');
    }

    public function buildUnRegister()
    {
        $_data = ['client_id' => Mage::helper('clever_adwords')->getStoreUniqueId()];
        return $_data;
    }
}