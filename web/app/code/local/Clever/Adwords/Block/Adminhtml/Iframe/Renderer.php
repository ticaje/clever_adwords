<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

class Clever_Adwords_Block_Adminhtml_Iframe_Renderer extends Varien_Data_Form_Element_Abstract
{

    public function getElementHtml()
    {
        $_url = Mage::getStoreConfig('adwords/general/iframe_url');
        $_argument = Mage::getStoreConfig('adwords/store/hmac');
        $_src = "{$_url}?hmac={$_argument}";
        return '<iframe class="" style="border: 0;" src="' . $_src . '" frameborder="0" onload="this.width=screen.width-120;this.height=screen.height;"></iframe>';
    }
}