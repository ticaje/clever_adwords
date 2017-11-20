<?php

/**
 * Installation Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Install_Installer extends Clever_Adwords_Service_Abstract
{
    protected $_payload;
    protected $_credentials;
    protected $_website_id;
    protected $_hmac;

    /**
     * Clever_Adwords_Service_Install_Installer constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->_website_id = $data['store'];
        $this->_store = Mage::getModel('clever_adwords_service/install_store', $this->_website_id);
        $this->_email = $data['email'];
        $this->initialize();
    }

    private function initialize()
    {
        // Generate the payload which is the base for store unique id
        $this->generatePayload();
        // Generate the hmac for communications with clever API
        $this->generateHmac();
        $this->_credentials = [];
    }
    /**
     * @return string
     * This is the hash that will be passed along onto Clever's API and is in fact the argument for the iFrame
     */
    public function generateHmac()
    {
        $_encoded = Mage::helper('core')->jsonEncode($this->_payload);
        $this->_hmac = hash_hmac(Clever_Adwords_Service_Settings::getHashMacAlgorithm(), $_encoded, Clever_Adwords_Service_Settings::getHashSecret());
        Mage::helper('clever_adwords')->setStoreHmac($this->_hmac, $this->_website_id);
    }

    protected function generatePayload()
    {
        $this->_payload = ['store_hash' => $this->_store->getStoreUniqueId(), 'timestamp' => time(), 'email' => $this->_email];
    }

    public function openAPI()
    {
        $_api_register = (new Clever_Adwords_Service_Api_Rest())->generateCredentials();
        if ($_api_register['result']){
            $this->_credentials = $_api_register['credentials'];
        }
        return $_api_register;
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

    public function buildRegister()
    {
        $_store_info = $this->fetchStoreInfo();
        $_extra_data = ['email' => $this->_email, 'client_id' => $this->_store->getStoreUniqueId()];
        $_data = array_merge($_store_info, $this->_credentials, $_extra_data);
        return $_data;
        /*
         * The builder result format responds to following sample pattern
         * $data = [
            'name' => , 'domain' => , 'email' => ,
            'countries' => , 'language' => , 'currency' => , 'access_token' => ,
            'client_id' => , 'secret' => , 'first_name' => , 'second_name' => ,
            'shop_country' => , 'address' => , 'phone' => , 'timezone' =>
        ];*/
    }
}
