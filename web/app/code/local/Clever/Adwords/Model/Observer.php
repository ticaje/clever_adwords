<?php

/**
 * Observer Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Model_Observer
{
    /**
     * Include our composer autoloader
     *
     * @param Varien_Event_Observer $event
     */
    public function controllerFrontInitBefore(Varien_Event_Observer $event)
    {
        self::init();
    }

    /**
     * Add in autoloader
     */
    static function init()
    {
        $_vendor_folder_path = Mage::helper('clever_adwords')->getExternalLibDirPath();
        // Add our vendor folder to our include path
        set_include_path(get_include_path() . PATH_SEPARATOR . $_vendor_folder_path);

        // Include the autoloader for composer
        require_once($_vendor_folder_path . DS . 'autoload.php');
    }
}