<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

class Clever_Adwords_Block_Installed_Renderer extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    protected function _getElementHtml($element)
    {
        $element->setDisabled('disabled');
        return parent::_getElementHtml($element);
    }
}