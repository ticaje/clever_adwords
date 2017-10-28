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
    }

    /**
     * @param $data
     */
    public function createRole($data)
    {
    }

    /**
     * @param $data
     */
    public function assignRoleToUser($data)
    {
    }

}