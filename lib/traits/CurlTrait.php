<?php
/**
 * Php version > 5.6
 *  
 * @category Php
 * @package  Null
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @version  GIT: 1.0
 * @link     false
 * Description
 */

declare(strict_types=1);

namespace lib\traits;

/**
 * The breathe trait in use by curl class
 * 
 * @category The_Breathe_Trait_In_Use_By_Breathe_Class
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
trait CurlTrait
{
    private $_header_array = [];
    private $_options_array = [];

    /**
     * Undocumented function
     *
     * @param array $header_keys   An array of header keys for the request
     * @param array $header_values An array of values keys for the request
     * 
     * @return void
     */
    protected function createCurlHeaders($header_keys, $header_values)
    {
        foreach ($header_keys as $key => $value) {
            $this->_header_array[$key] = $value .": ". $header_values[$key];
        }

        return $this->_header_array;
    }

    /**
     * Undocumented function
     *
     * @param array $option_keys   An array of option keys for the request
     * @param array $option_values An array of option values for the request
     * 
     * @return void
     */
    protected function createCurlOptions($option_keys, $option_values)
    {
        $this->_options_array = array_combine($option_keys, $option_values);

        $this->_options_array[CURLOPT_VERBOSE]             = false;
        $this->_options_array[CURLOPT_RETURNTRANSFER]      = true;
        $this->_options_array[CURLOPT_FOLLOWLOCATION]      = true;
        $this->_options_array[CURLOPT_TIMEOUT]             = 30;
        $this->_options_array[CURLOPT_MAXREDIRS]           = 10;
        $this->_options_array[CURLOPT_TIMEOUT]             = 0;
        $this->_options_array[CURLOPT_HTTP_VERSION]        = CURL_HTTP_VERSION_1_1;
        
        // [DEBUG]
        // $options_array[CURLOPT_VERBOSE]             = true;
        // $options_array[CURLINFO_HEADER_OUT]         = true;

        return $this->_options_array;
    }

    /**
     * Create the cURL options array
     *
     * @param string $method Request method (POST|GET)
     * @param string $source Source target URL
     * @param array  $body   An array of request body values
     * 
     * @return array
     */
    private function _createOptionsArray($method, $source, $body = null)
    {
        return $this->createCurlOptions($this->_setOptionKeys(), $this->_setOptionValues($method, $source, $body));
    }

    /**
     * Create the cURL options array
     *
     * @param string     $method Request method (POST|GET)
     * @param string     $source Source target URL
     * @param string     $value  Custom API key value
     * @param array|null $body   An array of request body values
     * 
     * @return array
     */
    private function _createCustomOptionsArray($method, $source, $value, $body = null)
    {
        return $this->createCurlOptions($this->_setOptionKeys(), $this->_setCustomOptionValues($method, $source, $value, $body));
    }

    /**
     * Creates the cURL header array used for request
     *
     * @return array
     */
    private function _createHeaderArray()
    {
        return $this->createCurlHeaders(
            $this->_setHeaderKeys(), 
            $this->_setHeaderValues()
        );
    }

    /**
     * Creates the cURL header array used for request
     * 
     * @param string $value Custom API value
     *
     * @return array
     */
    private function _createCustomHeaderArray($value)
    {
        return $this->createCurlHeaders(
            $this->_setCustomHeaderKeys(), 
            $this->_setCustomHeaderValues($value)
        );
    }

    /**
     * Sets the custom header array keys for cURL request
     *
     * @return array
     */
    private function _setHeaderKeys()
    {
        return array(
            "Accept",
            "Content-Type",
        );
    }

    /**
     * Sets the custom header array values for cURL request
     *
     * @return array
     */
    private function _setHeaderValues()
    {
        return array(
            "application/json",
            "application/json",
        );
    }

    /**
     * Sets the custom header array keys for cURL request
     *
     * @return array
     */
    private function _setCustomHeaderKeys()
    {
        return array(
            "Accept",
            "X-API-KEY",
        );
    }

    /**
     * Sets the custom header array values for cURL request
     *
     * @param string $custom_value Custom header key
     * 
     * @return array
     */
    private function _setCustomHeaderValues($custom_value)
    {
        return array(
            "application/json",
            $custom_value
        );
    }

    /**
     * Sets the custom cURL option array keys for cURL request
     *
     * @return array
     */
    private function _setOptionKeys()
    {
        return array(
            CURLOPT_CUSTOMREQUEST,
            CURLOPT_URL,
            CURLOPT_HTTPHEADER,
            CURLOPT_POSTFIELDS,
        );
    }

    /**
     * Sets the custom cURL option array values for cURL request
     *
     * @param string $method Request method (POST|GET)
     * @param string $source Source target URL
     * @param array  $body   An array of request body values
     * 
     * @return array
     */
    private function _setOptionValues($method, $source, $body)
    {
        return array(
            $method,
            $source,
            $this->_createHeaderArray(),
            $body,
        );
    }

    /**
     * Sets the custom cURL option array values for cURL request
     *
     * @param string $method Request method (POST|GET)
     * @param string $source Source target URL
     * @param string $value  Custom API value
     * @param array  $body   An array of request body values
     * 
     * @return array
     */
    private function _setCustomOptionValues($method, $source, $value, $body)
    {
        return array(
            $method,
            $source,
            $this->_createCustomHeaderArray($value),
            $body,
        );
    }
}