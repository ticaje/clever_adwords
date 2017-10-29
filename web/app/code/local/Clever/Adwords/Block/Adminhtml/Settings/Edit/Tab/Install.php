<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit_Tab_Install extends Mage_Adminhtml_Block_Widget_Form
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
        $_fieldset = $_form->addFieldset('install', array('legend' => Mage::helper('clever_adwords')->__('Installation')));

        $_fieldset->addField('title', 'text', array(
            'label' => Mage::helper('clever_adwords')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));

        $_fieldset->addField('tag', 'text', array(
            'label' => Mage::helper('clever_adwords')->__('Tag'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'tag',
        ));

        $_form->setValues($_data);

        return parent::_prepareForm();
    }
}