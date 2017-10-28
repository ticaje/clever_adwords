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

}