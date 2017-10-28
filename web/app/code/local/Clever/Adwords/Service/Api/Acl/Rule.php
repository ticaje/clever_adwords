<?php

/**
 * API Acl Rule Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Api_Acl_Rule
{
    /**
     * @return Mage_Api2_Model_Acl_Global_Rule
     */
    public function getRule()
    {
        return Mage::getModel('api2/acl_global_rule');
    }

    /**
     * @param $role
     */
    public function assignResources($role)
    {
        $_id = $role->getId();
        $_resources = Clever_Adwords_Service_Settings::getResources();
        $_rule = $this->getRule();
        foreach ($_resources as $resourceId => $privileges) {
            foreach ($privileges as $privilege => $allow) {
                if (!$allow) {
                    continue;
                }

                $_rule->setId(null)
                    ->isObjectNew(true);

                $_rule->setRoleId($_id)
                    ->setResourceId($resourceId)
                    ->setPrivilege($privilege)
                    ->save();
            }
        }
    }
}