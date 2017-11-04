<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit_Tab_Iframe extends Clever_Adwords_Override_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $_data = $this->register('settings_data');
        $_form = new Varien_Data_Form();
        $this->setForm($_form);
        $_fieldset = $_form->addFieldset('iframe', array('legend' => $this->_helper->__('Dashborad')));

        $_fieldset->addField('label', 'label', array(
            'value'     => $this->_helper->__('Clever Iframe Wrapper'),
        ));

        $_form->setValues($_data);
        return parent::_prepareForm();
    }

}