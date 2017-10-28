<?php

/**
 * API Acl Rule Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Api_Acl_Rule
{
    protected $_rule;

    public function __construct()
    {
        $this->_rule = Mage::getModel('api2/acl_global_rule');
    }

    /**
     * @return Mage_Api2_Model_Acl_Global_Rule
     */
    public function getRule()
    {
        return $this->_rule;
    }

    /**
     * @param $role
     * @param $resources
     */
    public function assignResources($role, $resources)
    {
        $_id = $role->getId();
        foreach ($resources as $resourceId => $privileges) {
            foreach ($privileges as $privilege => $allow) {
                if (!$allow) {
                    continue;
                }

                $this->_rule->setId(null)
                    ->isObjectNew(true);

                $this->_rule->setRoleId($_id)
                    ->setResourceId($resourceId)
                    ->setPrivilege($privilege)
                    ->save();
            }
        }
    }
}