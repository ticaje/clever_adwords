<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    protected $_title = "Clever Adwords APP";
    protected $_entity = "settings";
    protected $_helper;

    public function __construct()
    {
        parent::__construct();
        $this->_helper = Mage::helper('clever_adwords');
        $this->setId("tabs");
        $this->setDestElementId('edit_form');
        $this->setTitle($this->_helper->__($this->_title));
    }

    protected function _beforeToHtml()
    {

        if (!$this->_helper->isInstalled()){
            $this->addTab('form_section_install', array(
                'label' => $this->_helper->__('Installation'),
                'title' => $this->_helper->__('Installtion'),
                'content' => $this->getLayout()->createBlock('clever_adwords/adminhtml_settings_edit_tab_install')->toHtml(),
            ));
        }

        $this->addTab('form_section_dashboard', array(
            'label' => $this->_helper->__('Dashboard'),
            'title' => $this->_helper->__('Dashboard'),
            'content' => $this->getLayout()->createBlock('clever_adwords/adminhtml_settings_edit_tab_iframe')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}