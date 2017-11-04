<?php

/**
 * Block Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Block_Adminhtml_Settings_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
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
        $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl($this->_url_to_save, array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}