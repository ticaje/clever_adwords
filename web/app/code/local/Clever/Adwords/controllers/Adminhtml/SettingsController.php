<?php

/**
 * Controller Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Adminhtml_SettingsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('clever_adwords/adminhtml_settings_edit'))
            ->_addLeft($this->getLayout()->createBlock('clever_adwords/adminhtml_settings_edit_tabs'));
        $this->renderLayout();
    }
}