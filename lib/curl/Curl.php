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

namespace lib\curl;

/**
 * The final class for cURL instantiation
 * 
 * @category The_Final_Class_For_CURL_Instantiation
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Curl implements CurlInterface
{
    /**
     * Curl handle instance
     * 
     * @var \CurlHandle
     */
    private $_handle;

    /**
     * Initialize a cURL session
     * 
     * @param string|null $url URL to be initialised if provided
     * 
     * @return void
     */
    public function init(string $url = null)
    {
        $this->_handle = curl_init();
    }

    /**
     * Return the last error number
     * 
     * @return int
     */
    public function errno()
    {
        return curl_errno($this->_handle);
    }

    /**
     * Return a string containing the last error for the current session
     * 
     * @return string
     */
    public function error()
    {
        return curl_error($this->_handle);
    }

    /**
     * Perform a cURL session
     * 
     * @return response
     */
    public function exec()
    {
        return curl_exec($this->_handle);
    }

    /**
     * Get information regarding a specific transfer
     * 
     * @param int|null $opt cURL information option id if provided
     * 
     * @return string
     */
    public function getInfo(int $opt = 0)
    {
        if (func_num_args() > 0) {
            return curl_getinfo($this->_handle, $opt);
        }

        return curl_getinfo($this->_handle);
    }

    /**
     * Set an option for a cURL transfer
     * 
     * @param int   $option Curl option integer
     * @param mixed $value  Curl option  value
     * 
     * @return bool
     */
    public function setOpt(int $option, $value)
    {
        return curl_setopt($this->_handle, $option, $value);
    }

    /**
     * Set multiple options for a cURL transfer
     * 
     * @param array $options Curl options array
     * 
     * @return bool
     */
    public function setOptArray($options)
    {
        return curl_setopt_array($this->_handle, $options);
    }

    /**
     * Gets cURL version information
     * 
     * @param int $age [optional] Removed since version PHP 8.0.
     * 
     * @return array|false
     */
    public function version(int $age = CURLVERSION_NOW)
    {
        return curl_version($age);
    }

    /**
     * Return string describing the given error code
     * 
     * @param int $errornum One of the cURL error codes} constants.
     * 
     * @return string|null
     */
    public function strError(int $errornum)
    {
        return curl_strerror($errornum);
    }

    /**
     * URL encodes the given string
     * 
     * @param string $string non-URL encoded string
     * 
     * @return string
     */
    public function escape($string)
    {
        return curl_escape($this->_handle, $string);
    }

    /**
     * Decodes the given URL encoded string
     * 
     * @param string $string URL encoded string
     * 
     * @return string
     */
    public function unescape($string)
    {
        return curl_unescape($this->_handle, $string);
    }

    /**
     * Reset all options of a libcurl session handle
     * 
     * @return void
     */
    public function reset()
    {
        curl_reset($this->_handle);
    }

    /**
     * Pause and unpause a connection
     * 
     * @param int $bitmask One of CURLPAUSE_* constants.
     * 
     * @return int Returns an error code (CURLE_OK for no error).
     */
    public function pause(int $bitmask)
    {
        return curl_pause($this->_handle, $bitmask);
    }

    /**
     * Retrieves the current cURL handle instance
     * 
     * @return Curl
     */
    public function getHandle()
    {
        return $this->_handle;
    }

    /**
     * The Curl class destructor - Close a cURL session
     */
    public function __destruct()
    {
        curl_close($this->_handle);
    }

    /**
     * Clones the current cURL handle along with all of its preferences
     *
     * @return void
     */
    public function __clone()
    {
        $this->_handle = curl_copy_handle($this->_handle);
    }
}