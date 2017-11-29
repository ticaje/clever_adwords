<?php

/**
 * Connector Service Class
 * @category    Clever
 * @package     Clever_Adwords
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\RequestException;

class Clever_Adwords_Service_Connector_Clever extends Clever_Adwords_Service_Abstract
{
    protected $_client;
    protected $_auth_token;
    protected $_credentials;

    public function __construct()
    {
        $this->_client = new Client();
        $this->_credentials = Mage::getSingleton('clever_adwords_service/connector_credentials');
        $this->getAuthenticationToken();
    }

    /**
     * @param $endPoint
     * @param $verb
     * @param $data
     * @param $headers
     * @return mixed
     */
    protected function request($endPoint, $verb, $data, $headers = array())
    {
        $_url = $this->_credentials->getApiUrl() . "{$endPoint}";
        $_response = $this->_client->$verb($_url, array('query' => $data, 'headers' => $headers));
        return $_response;
    }

    /**
     * @return array
     */
    protected function getAuthData()
    {
        return array('email' => $this->_credentials->getEmail(), 'password' => $this->_credentials->getPassword());
    }

    /**
     * @return array
     */
    protected function getAuthHeader()
    {
        return array('authorization' => $this->_auth_token);
    }

    /**
     * @param $response
     * @return mixed
     */
    protected function decodeResponse($response)
    {
        return Mage::helper('core')->jsonDecode($response->getBody()->getContents(), false);
    }

    /**
     * @return array
     */
    public function getAuthenticationToken()
    {
        try {
            // Prepare auth data
            $_data = $this->getAuthData();
            // Perform request and get raw response object
            $_response = $this->request('authenticate', 'post', $_data);
            // Decoding response data
            $_decoded_data = $this->decodeResponse($_response);
            // Setting auth token
            $this->_auth_token = $_decoded_data->auth_token;
            // Setting result
            $_result = array('result' => $this->_auth_token, 'code' => $_response->getStatusCode());
        } catch (RequestException $e) {
            // Call to Roll-bar, later on
            $_result = array('result' => false, 'code' => $e->getCode(), 'message' => $e->getMessage());
        }
        return $_result;
    }

    /**
     * @param $data
     * @return array
     */
    public function register($data)
    {
        try {
            // Getting auth header
            $_headers = $this->getAuthHeader();
            // Perform request
            $_response = $this->request($this->_credentials->getRegisterEndpoint(), 'post', $data, $_headers);
            $_decoded_data = $this->decodeResponse($_response);
            $_result = array('result' => $_decoded_data, 'code' => $_response->getStatusCode());
        } catch (RequestException $e) {
            // Call to Roll-bar, later on
            $_result = array('result' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage());
        }
        return $_result;
    }

    public function unregister($data)
    {
        try {
            // Getting auth header
            $_headers = $this->getAuthHeader();
            // Perform request
            $_response = $this->request($this->_credentials->getUnRegisterEndpoint(), 'post', $data, $_headers);
            $_decoded_data = $this->decodeResponse($_response);
            $_result = array('result' => $_decoded_data, 'code' => $_response->getStatusCode());
        } catch (RequestException $e) {
            // Call to Roll-bar, later on
            $_result = array('result' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage());
        }
        return $_result;
    }
}
