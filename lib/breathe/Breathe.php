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

use lib\traits\BreatheTrait;
use lib\breathe\abstracts\Absences;
use lib\breathe\abstracts\Employees;
use lib\breathe\abstracts\Sicknesses;

/**
 * The main class for querying different Breathe HR events
 * 
 * @category The_Main_Class_For_Querying_Different_Breathe_HR_Events
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Breathe implements BreatheInterface
{
    use BreatheTrait;

    /**
     * The Breathe API key
     * 
     * @var string
     */
    protected $breath_api_key;

    /**
     * The Breathe API URL
     * 
     * @var string
     */
    protected $breath_api_host;

    /**
     * The Breathe class consutrctor
     */
    public function __construct()
    {
        $this->breath_api_host = getenv('BREATHE_API_HOST') ?: null;
        $this->breath_api_key = getenv('BREATHE_API_KEY') ?: null;
    }

    /**
     * Retrieves an array of 'sickness' event values from the API
     *
     * @param string|null $start_date The start date from which to query from
     * @param string|null $end_date   The end date from which to query before
     * 
     * @return array
     */
    public function getSicknesses($start_date, $end_date)
    {
        $sicknesses = new Sicknesses;
        
        $results = $sicknesses->get($this->_setBodyArray($start_date, $end_date));  

        return $this->_filterSicknesses($results, 'sicknesses');
    }

    /**
     * Retrieves an array of 'employees' values from the API
     * 
     * @param int $id Employee ID
     *
     * @return array
     */
    public function getEmployee($id)
    {
        $employees = new Employees;

        $employee = $employees->getById($id); 

        return $this->_filterEmployees($employee, 'employees');
    }

    /**
     * Retrieves an array of 'employees' values from the API
     *
     * @return array
     */
    public function getEmployees()
    {
        $employees = new Employees;
        
        return $employees->get();  
    }

    /**
     * Retrieves an array of 'absences' event values from the API
     *
     * @param string $start_date The start date from which to query from
     * @param string $end_date   The end date from which to query before
     * 
     * @return array
     */
    public function getAbsences($start_date, $end_date)
    {
        $absences = new Absences;

        $results = $absences->get($this->_setBodyArray($start_date, $end_date));

        return $this->_filterEvents($results, 'absences');
    }

    /**
     * Retrieves the API host string value publicly
     *
     * @return string
     */
    public function getHost()
    {
        return $this->breath_api_host;
    }

    /**
     * Retrieves the API key string value publicly
     *
     * @return string
     */
    public function getKey()
    {
        return $this->breath_api_key;
    }

    /**
     * Creates the 'body' array for use in children cURL requests
     * If null string date values are provided use the current date
     * 
     * @param string|null $start_date The start date from which to query from
     * @param string|null $end_date   The end date from which to query before
     * 
     * @return array
     */
    private function _setBodyArray($start_date, $end_date)
    {
        return array(
            'start_date' => $start_date, 
            'end_date' => $end_date
        );
    }
}

