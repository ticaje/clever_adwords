<?php

/**
 * Helper Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Helper_Api extends Mage_Core_Helper_Abstract
{
    /**
     * @param Mage_Api2_Model_Acl_Global_Role $role
     * @return false|Mage_Core_Model_Abstract
     */
    public function resetResourcesAclRules(Mage_Api2_Model_Acl_Global_Role $role)
    {
        $_id = $role->getId();
        $_rule = Mage::getModel('api2/acl_global_rule');
        if ($_id) {
            $_collection = $_rule->getCollection()->addFilterByRoleId($_id);
            /** @var $model Mage_Api2_Model_Acl_Global_Rule */
            foreach ($_collection as $model) {
                $model->delete();
            }
        }
        return $_rule;
    }
}