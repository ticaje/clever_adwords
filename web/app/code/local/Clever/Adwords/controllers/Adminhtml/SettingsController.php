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
        $_messenger = Mage::getSingleton('adminhtml/session');
        try {
            $_installer = new Clever_Adwords_Service_Install_Installer($_data);
            $_installed = $_installer->openAPI();
            if ($_installed['result']) {
                //Send data to CleverPPC API ... still undone
                $_connector = new Clever_Adwords_Service_Connector_Clever();
                $_registered = $_connector->register($_installer->buildRegister());
                if ($_registered['result']) {
                    $this->_helper->setInstalled();
                } else {
                    throw new Clever_Adwords_Service_Exception_Clever($_registered['message']);
                }
            } else {
                throw new Clever_Adwords_Service_Exception_Api($_installed['message']);
            }
            $_messenger->addSuccess($this->_helper->__('The Clever Adwords application has been installed successfully'));
        } catch (Clever_Adwords_Service_Exception_Clever $e) {
            $_messenger->addError($this->_helper->__($e->getMessage()));
            Clever_Adwords_Service_Exception_Rollbar_Rollbar::log($e->getMessage(), Clever_Adwords_Service_Exception_Rollbar_Level::ERROR);
        } catch (Clever_Adwords_Service_Exception_Api $e) {
            $_messenger->addError($this->_helper->__($e->getMessage()));
            Clever_Adwords_Service_Exception_Rollbar_Rollbar::log($e->getMessage(), Clever_Adwords_Service_Exception_Rollbar_Level::ERROR);
        } catch (Exception $e) {
            $_messenger->addError($this->_helper->__($e->getMessage()));
            Clever_Adwords_Service_Exception_Rollbar_Rollbar::log($e->getMessage(), Clever_Adwords_Service_Exception_Rollbar_Level::CRITICAL);
        }
        $this->_redirect('*/*/');
        return;
    }

    public function uninstallAction()
    {
        $_messenger = Mage::getSingleton('adminhtml/session');
        try {
            $_un_installer = new Clever_Adwords_Service_Install_Uninstaller();
            $_uninstall = $_un_installer->closeApi(Clever_Adwords_Service_Settings::API_TO_OPEN);
            if ($_uninstall['result']) {
                $_connector = new Clever_Adwords_Service_Connector_Clever();
                $_connector->unregister($_un_installer->buildUnRegister());
                $this->_helper->setUninstalled();
                $_messenger->addSuccess($this->_helper->__('The Clever Adwords application has been uninstalled successfully'));
            } else {
                throw new Clever_Adwords_Service_Exception_Clever($_uninstall['message']);
            }
        } catch (Clever_Adwords_Service_Exception_Clever $e) {
            $_messenger->addError($this->_helper->__($e->getMessage()));
            Clever_Adwords_Service_Exception_Rollbar_Rollbar::log($e->getMessage(), Clever_Adwords_Service_Exception_Rollbar_Level::ERROR);
        } catch (Exception $e) {
            $_messenger->addError($this->_helper->__($e->getMessage()));
            Clever_Adwords_Service_Exception_Rollbar_Rollbar::log($e->getMessage(), Clever_Adwords_Service_Exception_Rollbar_Level::CRITICAL);
        }

        $this->_redirect('*/*/');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('adwords');
    }

}
