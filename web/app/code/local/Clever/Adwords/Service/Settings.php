<?php

/**
 * Service Settings Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
class Clever_Adwords_Service_Settings
{
    const SHA_256 = 'sha256';
    const CLEVER_CONSUMER_USERNAME = 'clever_consumer';
    const CLEVER_CONSUMER_CONSUMER_NAME = 'Clever Consumer';
    const CLEVER_CONSUMER_ROLE = 'Clever Role';
    const API_TO_OPEN = 'Soap';

    /**
     * @return array
     * I will define the resources to expose in the API, later on we will make this configurable
     */
    static private function getEntities()
    {
        return ['product', 'product_category', 'product_image', 'product_website', 'stock_item', 'order', 'order_item'];
    }

    /**
     * @return array
     * Defining the resources with its permissions to expose, later on we will make this configurable
     */
    static public function getResources()
    {
        $_entities = self::getEntities();
        $_result = self::getPermissions($_entities, 'retrieve');
        return $_result;
    }

    static public function getSoapResources()
    {
        return [
            'catalog','catalog/product','catalog/product/info','catalog/product/attribute','catalog/product/attribute/read',
            'catalog','catalog/category','catalog/category/tree','catalog/category/info',
            'cataloginventory','cataloginventory/info',
            'sales','sales/order','sales/order/info','sales/order/invoice','sales/order/invoice/info',
            'clever/adwords', 'clever/adwords/alive'
        ];
    }

    /**
     * @param $entities
     * @param $type
     * @return array
     */
    static public function getPermissions($entities, $type)
    {
        $_result = [];
        foreach($entities as $entity) {
            $_result[$entity] =  [$type => 1];
        };
        return $_result;
    }

    static public function getHashMacAlgorithm()
    {
        return self::SHA_256;
    }

    static public function getHashSecret()
    {
        return '4n7fdidvdrzvwe5hb0i4blohf4d8crc'; // Will be stored later on
    }

}