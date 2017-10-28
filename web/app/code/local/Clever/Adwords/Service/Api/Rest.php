<?php

/**
 * Abstract Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Api_Rest extends Clever_Adwords_Service_Api_Abstract
{

    protected $_acl_global_rule;

    /**
     * Clever_Adwords_Service_Api_Rest constructor.
     * @param Clever_Adwords_Service_Api_Acl_Rule $rule
     */
    public function __construct(Clever_Adwords_Service_Api_Acl_Rule $rule)
    {
        $this->_acl_global_rule = $rule;
    }

    /**
     * @param $data
     * @return bool
     */
    public function createOauthConsumer($data)
    {
        $_result = false;
        $_helper = Mage::helper('oauth');
        $data['key']    = $_helper->generateConsumerKey();
        $data['secret'] = $_helper->generateConsumerSecret();
        $_model = Mage::getModel('oauth/consumer');
        $_model->addData($data);
        if ($_model->save()){
            $_result = true;
        }
        return $_result;
    }

    /**
     * @param $data
     * @return bool
     */
    public function createRole($data)
    {
        $_result = false;
        //Set role data
        $_role = Mage::getModel('api2/acl_global_role');
        $_role->setRoleName($data['role_name']);
        if ($_role->save()){
            //Assign resources to rule
            $_resources = Clever_Adwords_Service_Settings::getResources();
            $this->_acl_global_rule->assignResources($_role, $_resources);
            $_result = true;
        }
        return $_result;
    }

    /**
     * @param $data
     */
    public function assignRoleToUser($data)
    {
        $_user = $data['user'];
        $_role = $data['role'];
        $_resource_model = Mage::getResourceModel('api2/acl_global_role');
        $_resource_model->saveAdminToRoleRelation($_user->getId(), $_role->getId());
    }

}