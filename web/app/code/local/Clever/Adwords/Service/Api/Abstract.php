<?php

/**
 * Abstract Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */
abstract class Clever_Adwords_Service_Api_Abstract
{
    abstract protected function createOauthConsumer($data);

    abstract protected function createRole($data);

    abstract protected function assignRoleToUser($data);
}