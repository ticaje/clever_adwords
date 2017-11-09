<?php

/**
 * Controller Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Adminhtml_SettingsController extends Mage_Adminhtml_Controller_Action
{
    protected $_helper;
    public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
    {
        $this->_helper = Mage::helper('clever_adwords');
        parent::__construct($request, $response, $invokeArgs);
    }

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('adwords');
        $this->_addContent($this->getLayout()->createBlock('clever_adwords/adminhtml_settings_edit'));
        $this->renderLayout();
    }

    public function installAction()
    {
        $_data = $this->getRequest()->getPost();
        $_installer = new Clever_Adwords_Service_Install_Installer($_data['store']);
        $_api_credentials = (new Clever_Adwords_Service_Api_Rest())->generateCredentials();
        if ($_api_credentials['result']){
            //Send data to CleverPPC API ... still undone
            $this->_helper->setInstalled();
        }
        Mage::getSingleton('adminhtml/session')->addSuccess($this->_helper->__('The Clever Adwords application has been installed successfully'));
        $this->_redirect('*/*/');
        return;
    }
}