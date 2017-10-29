<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Clever_Adwords_Block_Adminhtml_Configurations_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'clever_adwords';
        $this->_controller = 'adminhtml_settings';
        $this->_removeButton('reset');
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        return Mage::helper('clever_adwords')->__('Install the Clever Adwords Application');
    }
}