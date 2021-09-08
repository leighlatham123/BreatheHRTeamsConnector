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

namespace lib\breathe\abstracts;

use lib\curl\Curl;
use lib\breathe\Breathe;
use lib\traits\CurlTrait;

/**
 * The main class for querying Breathe HR sicknesses
 * 
 * @category The_Main_Class_For_Querying_Breathe_HR_Sicknesses
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Sicknesses extends Breathe
{
    use CurlTrait;

    private $_key;
    private $_host;
    private $_uri;
    private $_url;
    private $_sicknesses;
    private static $_curl;

    /**
     * Sicknesses class consutrctor
     */
    public function __construct()
    {
        parent::__construct();

        self::$_curl = new Curl;
        $this->_key = parent::getKey();
        $this->_host = parent::getHost();
        $this->_uri = "sicknesses";
        $this->_url = $this->_host.$this->_uri;
    }

    /**
     * Creates the request to retrieve sicknesses values
     *
     * @param array $body An array of request body values
     * 
     * @return array
     */
    protected function get($body)
    {
        self::$_curl->init();

        $curl_options = $this->_createCustomOptionsArray("GET", $this->_url, $this->_key, $body);

        self::$_curl->setOptArray($curl_options);

        $this->_sicknesses = self::$_curl->exec();

        return $this->_sicknesses;
    }
}