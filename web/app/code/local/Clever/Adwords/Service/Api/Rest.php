<?php

/**
 * REST API Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Api_Rest extends Clever_Adwords_Service_Api_Abstract
{

    protected $_acl_global_rule;
    protected $_api_role;
    protected $_consumer_key;
    protected $_consumer_secret;

    /**
     * @param $data
     * @return bool
     */
    protected function createOauthConsumer($data)
    {
        $_result = false;
        $_data = array_merge($data, $this->getConsumerCredentials());
        $_model = Mage::getModel('oauth/consumer');
        $_model->addData($_data);
        if ($_model->save()) {
            $_result = true;
        }
        return $_result;
    }

    protected function generateConsumerCredentials()
    {
        // Generate consumer credentials
        $this->_consumer_key = $this->_helper->generateConsumerKey();
        $this->_consumer_secret = $this->_helper->generateConsumerSecret();
    }

    /**
     * @param $data
     * @return false|Mage_Core_Model_Abstract|null
     */
    protected function createRole($data)
    {
        $_result = false;
        //Set role data
        /** @var Mage_Api2_Model_Acl_Global_Role $_role */
        $_role = Mage::getModel('api2/acl_global_role');
        $_role->setRoleName($data['role_name']);
        if ($_role->save()) {
            //Assign resources to rule
            $_resources = Clever_Adwords_Service_Settings::getResources();
            $this->_acl_global_rule = new Clever_Adwords_Service_Api_Acl_Rule();
            $this->_acl_global_rule->assignResources($_role, $_resources);
            $this->_api_role = $_role;
            $_result = true;
        }
        return $_result;
    }

    /**
     * @param $data
     */
    protected function assignRoleToUser($data)
    {
        $_user = Mage::getSingleton('admin/session')->getUser();
        $_role = $this->_api_role ?: $data['role'];
        $_resource_model = Mage::getResourceModel('api2/acl_global_role');
        $_resource_model->saveAdminToRoleRelation($_user->getId(), $_role->getId());
    }

    /**
     * @return array
     */
    protected function getConsumerCredentials()
    {
        $_result = ['key' => $this->_consumer_key, 'secret' => $this->_consumer_secret];
        return $_result;
    }

    /**
     * @return array
     */
    protected function getCredentials()
    {
        return ['access_token' => $this->_consumer_key, 'secret' => $this->_consumer_secret];
    }

    /**
     * @return array
     */
    public function generateCredentials()
    {
        $_consumer_data = ['name' => $this->_consumer_name];
        $_role_data = ['role_name' => $this->_role_name];
        try {
            $this->createOauthConsumer($_consumer_data);
            $this->createRole($_role_data);
            $this->assignRoleToUser(['role' => $this->_api_role]);
            $_result = ['result' => true, 'message' => 'Credentials created successfully', 'credentials' => $this->getCredentials()];
        } catch (Exception $exception) {
            $_result = ['result' => false, 'message' => $exception->getMessage()];
        }
        return $_result;
    }
}