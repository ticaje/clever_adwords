<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected $_helper;

    /**
     * Clever_Adwords_Block_Adminhtml_Configurations_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_helper = Mage::helper('clever_adwords');
        $this->_objectId = 'id';
        $this->_blockGroup = 'clever_adwords';
        $this->_controller = 'adminhtml_settings';
        $this->_removeButton('reset');
        if ($this->_helper->isInstalled()) {
            $this->_removeButton('back');
            $this->_removeButton('save');
        }
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        $_installed = $this->_helper->isInstalled();
        $_header = !$_installed ? 'Install the Clever Adwords Application' : 'Clever Adwords Application Management';
        return $this->_helper->__($_header);
    }
}