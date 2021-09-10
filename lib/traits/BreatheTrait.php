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

use lib\breathe\Breathe;

/**
 * The breathe trait in use by breathe class
 * 
 * @category The_Breathe_Trait_In_Use_By_Breathe_Class
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
trait BreatheTrait
{
    /**
     * Undocumented function
     *
     * @param string $events_json      list JSON string
     * @param string $event_unique_key unique identifier for events list
     * 
     * @return void
     */
    private function _filterEvents($events_json, $event_unique_key)
    {
        $events_array = $this->_decodeJSONString($events_json);

        return empty($events_array[$event_unique_key]) ? [] : array_map(
            array($this, '_matchValues'), $events_array[$event_unique_key]
        );
    }

    /**
     * Undocumented function
     *
     * @param string $employee_json       list JSON string
     * @param string $employee_unique_key unique identifier for events list
     * 
     * @return void
     */
    private function _filterSicknesses($employee_json, $employee_unique_key)
    {
        $employee_array = $this->_decodeJSONString($employee_json);

        return empty($employee_array[$employee_unique_key]) ? [] : array_map(
            array($this, '_matchSicknessValues'), $employee_array[$employee_unique_key]
        );
    }

    /**
     * Undocumented function
     *
     * @param string $employee_json       list JSON string
     * @param string $employee_unique_key unique identifier for events list
     * 
     * @return void
     */
    private function _filterEmployees($employee_json, $employee_unique_key)
    {
        $employee_array = $this->_decodeJSONString($employee_json);

        return empty($employee_array[$employee_unique_key]) ? [] : array_map(
            array($this, '_matchEmployeeValues'), $employee_array[$employee_unique_key]
        );
    }

    /**
     * Convert JSON list to array
     *
     * @param string $events_json list JSON string
     * 
     * @return array
     */
    private function _decodeJSONString($events_json)
    {
        return json_decode($events_json, true);
    }

    /**
     * Filter through array of event values and return only ones which are required
     *
     * @param array $array An array of values
     * 
     * @return array
     */
    private function _matchValues($array)
    {
        return $array['employee']['first_name'] . " " 
        . $array['employee']['last_name']
        . " - " . $array['type']
        . ": " . date('d/m/Y', strtotime($array['start_date']))
        . " - " . date('d/m/Y', strtotime($array['end_date']))
        . "<br>";
    }

    /**
     * Filter through array of event values and return only ones which are required
     *
     * @param array $array An array of values
     * 
     * @return array
     */
    private function _matchSicknessValues($array)
    {
        return $this->_getEmployeeNameFromId($array['employee']['id'])
        . " - " . "Sickness"
        . ": " . date('d/m/Y', strtotime($array['start_date']))
        . " - " . date('d/m/Y', strtotime($array['end_date']))
        . "<br>";
    }

    /**
     * Filter through array of employee values and return required
     *
     * @param array $array An array of values
     * 
     * @return array
     */
    private function _matchEmployeeValues($array)
    {
        return $array['first_name'] . " " 
        . $array['last_name'];
    }

    /**
     * Retrieve an Employee name string via a given employee ID
     *
     * @param int $id Employee ID
     * 
     * @return string
     */
    private function _getEmployeeNameFromId($id)
    {
        $breathe = new Breathe;

        return implode(",", $breathe->getEmployee($id));
    }
}