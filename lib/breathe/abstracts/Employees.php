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
 * The main class for querying Breathe HR emplopyees
 * 
 * @category The_Main_Class_For_Querying_Breathe_HR_Emplopyees
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Employees extends Breathe
{
    use CurlTrait;

    private $_key;
    private $_host;
    private $_uri;
    private $_url;
    private $_employee;
    private $_employees;
    private static $_curl;

    /**
     * Employees class constructor
     */
    public function __construct()
    {
        parent::__construct();

        self::$_curl = new Curl;
        $this->_key = parent::getKey();
        $this->_host = parent::getHost();
        $this->_uri = "employees";
        $this->_url = $this->_host.$this->_uri;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function get()
    {
        self::$_curl->init();

        $curl_options = $this->_createCustomOptionsArray("GET", $this->_url, $this->_key);

        self::$_curl->setOptArray($curl_options);

        $this->_employees = self::$_curl->exec();

        return $this->_employees;
    }

    /**
     * Undocumented function
     * 
     * @param int $employee_id Employee ID of employee
     *
     * @return array
     */
    protected function getById($employee_id)
    {
        self::$_curl->init();

        $curl_options = $this->_createCustomOptionsArray("GET", $this->_url."/$employee_id", $this->_key);

        self::$_curl->setOptArray($curl_options);

        $this->_employee = self::$_curl->exec();

        return $this->_employee;
    }
}