<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit_Form extends Clever_Adwords_Override_Block_Widget_Form
{
    /** @var  string */
    protected $_url_to_save;

    /**
     * Custom constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_url_to_save = '*/*/install';
    }

    /**
     * Prepare form function
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $_form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl($this->_url_to_save, array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        $_data = $this->register('settings_data');
        $this->setForm($_form);

        if ($this->_helper->isInstalled()) {
            $_fieldset = $_form->addFieldset('iframe', array('legend' => $this->_helper->__('Dashborad')));

            $_fieldset->addType('dashboard', 'Clever_Adwords_Block_Adminhtml_Iframe_Renderer');
            $_fieldset->addField('dashboard', 'dashboard', array(
                'name'      => 'dashboard',
            ));

        } else {
            $_fieldset = $_form->addFieldset('install', array('legend' => $this->_helper->__("Store Info")));

            $_websites = $this->_helper->getWebsitesList();
            $_fieldset->addField('store', 'select', array(
                'label' => $this->_helper->__("Select Website"),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'store',
                'values' => $_websites,
            ));

            $_fieldset->addField('email', 'text', array(
                'label' => $this->_helper->__("Store's Main Email"),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'email',
            ));

        }

        $_form->setValues($_data);

        $_form->setUseContainer(true);
        $this->setForm($_form);
        return parent::_prepareForm();
    }

}