<?php

/**
 * SOAP API Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Api_Soap extends Clever_Adwords_Service_Api_Abstract
{

    protected $_email;
    protected $_api_key;
    protected $_user;
    protected $_role;
    protected $_username;

    public function __construct($email)
    {
        parent::__construct();
        $this->_email = $email;
        $this->_username = 'clever_consumer';
        $this->generateConsumerCredentials();
    }

    protected function generateConsumerCredentials()
    {
        $this->_api_key = $this->_helper->generateConsumerKey();
    }

    protected function getUserData()
    {
        $_user_data = [
            'username' => $this->_username,
            'firstname' => $this->_consumer_name,
            'lastname' => $this->_consumer_name,
            'email' => $this->_email,
            'api_key' => $this->_api_key,
            'is_active' => 1
        ];
        return $_user_data;
    }

    protected function createUser()
    {
        $_user_model = Mage::getModel('api/user');
        $_user_model->setData($this->getUserData());
        $_user_model->save();
        $this->_user = $_user_model;
    }

    /**
     * @param $data
     */
    protected function createRole($data)
    {
        $_api_role = Mage::getModel('api/roles')
            ->setName($data['name'])
            ->setPid(false)
            ->setRoleType('G')
            ->save();

        $_resources = Clever_Adwords_Service_Settings::getSoapResources();
        Mage::getModel("api/rules")
            ->setRoleId($_api_role->getId())
            ->setResources($_resources)
            ->saveRel();
        $this->_role = $_api_role;
    }

    protected function assignRoleToUser($role)
    {
        $this->_user->setRoleId($role->getId())->setUserId($this->_user->getId());

        if( $this->_user->roleUserExists() === true ) {
            return false;
        } else {
            $this->_user->add();
            return true;
        }
    }

    protected function getCredentials()
    {
        $_result = ['access_token' => $this->_consumer_name, 'secret' => $this->_api_key];
        return $_result;
    }

    public function generateCredentials()
    {
        try {
            $this->createUser();
            $this->createRole(['name' => $this->_role_name]);
            $this->assignRoleToUser($this->_role);
            $_result = ['result' => true, 'message' => 'Credentials created successfully', 'credentials' => $this->getCredentials()];
        } catch (Exception $exception) {
            $_result = ['result' => false, 'message' => $exception->getMessage()];
        }
        return $_result;
    }
}