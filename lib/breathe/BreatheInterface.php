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

namespace lib\breathe;

/**
 * The breathe class interface for cURL instantiation
 * 
 * @category The_Curl_Class_Interface_For_CURL_Instantiation
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
interface BreatheInterface
{
    /**
     * Retrieves an array of 'employees' values from the API
     *
     * @return array
     */
    public function getEmployees();

    /**
     * Retrieves an array of 'absences' event values from the API
     *
     * @param string|null $start_date The start date from which to query from
     * @param string|null $end_date   The end date from which to query before
     * 
     * @return array
     */
    public function getAbsences(string $start_date = null, string $end_date = null);

    /**
     * Retrieves the API host string value publicly
     *
     * @return string
     */
    public function getHost();

    /**
     * Retrieves the API key string value publicly
     *
     * @return string
     */
    public function getKey();
}

