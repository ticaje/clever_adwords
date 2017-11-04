<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit_Tab_Install extends Clever_Adwords_Override_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $_data = $this->register('settings_data');
        $_form = new Varien_Data_Form();
        $this->setForm($_form);
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

        $_form->setValues($_data);

        return parent::_prepareForm();
    }

}