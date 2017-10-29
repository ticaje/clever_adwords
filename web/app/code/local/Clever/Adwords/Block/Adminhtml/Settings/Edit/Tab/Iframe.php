<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit_Tab_Iframe extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        if (Mage::registry('settings_data')) {
            $_data = Mage::registry('settings_data')->getData();
        } else {
            $_data = array();
        }

        $_form = new Varien_Data_Form();
        $this->setForm($_form);
        $_fieldset = $_form->addFieldset('iframe', array('legend' => Mage::helper('clever_adwords')->__('Dashborad')));

        $_fieldset->addField('label', 'label', array(
            'value'     => Mage::helper('clever_adwords')->__('Label Text'),
        ));


        $_form->setValues($_data);
        return parent::_prepareForm();
    }

}