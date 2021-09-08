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
 * The curl class interface for cURL instantiation
 * 
 * @category The_Curl_Class_Interface_For_CURL_Instantiation
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
interface CurlInterface
{
    /**
     * Initialize a cURL session
     *
     * @param string $url The URL
     * 
     * @return void
     * 
     * @see curl_init()
     */
    public function init(string $url = null);

    /**
     * Return the last error number
     *
     * @return int
     * 
     * @see curl_errno()
     */
    public function errno();

    /**
     * Return a string containing the last error for the current session
     *
     * @return string
     * 
     * @see curl_error()
     */
    public function error();

    /**
     * Perform a cURL session
     *
     * @return boolean|string
     * 
     * @see curl_exec()
     */
    public function exec();

    /**
     * Get information regarding a specific transfer
     *
     * @param int $opt CURLINFO_*
     * 
     * @return array|string
     * 
     * @see curl_getinfo()
     */
    public function getInfo(int $opt = 0);

    /**
     * Set an option for a cURL transfer
     *
     * @param int   $option Option code
     * @param mixed $value  Option value
     * 
     * @return boolean
     * 
     * @see curl_setopt()
     */
    public function setOpt(int $option, $value);

    /**
     * Set multiple options for a cURL transfer
     *
     * @param array $options Options
     * 
     * @return boolean
     * 
     * @see curl_setopt_array()
     */
    public function setOptArray(array $options);

    /**
     * Gets cURL version information
     *
     * @param int $age [optional] Removed since version PHP 8.0.
     * 
     * @return array
     * 
     * @see curl_version()
     */
    public function version(int $age = CURLVERSION_NOW);

    /**
     * Return string describing the given error code
     *
     * @param int $errornum One of the cURL error codes} constants.
     * 
     * @return string
     * 
     * @see curl_strerror()
     */
    public function strError(int $errornum);

    /**
     * URL encodes the given string
     *
     * @param string $str non-URL encoded string
     * 
     * @return string|false
     * 
     * @see curl_escape()
     */
    public function escape(string $str);

    /**
     * Decodes the given URL encoded string
     *
     * @param string $str URL encoded string
     * 
     * @return string|false
     * 
     * @see curl_unescape()
     */
    public function unescape(string $str);

    /**
     * Reset all options of a libcurl session handle
     *
     * @return void
     * 
     * @see curl_reset()
     */
    public function reset();

    /**
     * Pause and unpause a connection
     *
     * @param int $bitmask $bitmask One of CURLPAUSE_* constants.
     * 
     * @return int
     * 
     * @see curl_pause()
     */
    public function pause(int $bitmask);

    /**
     * Get curl handle
     *
     * @return resource
     */
    public function getHandle();
}