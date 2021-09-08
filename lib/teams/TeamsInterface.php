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

namespace lib\teams;

/**
 * The Microsoft Teams class interface for Microsoft Teams instantiation
 * 
 * @category The_Microsoft_Teams_Class_Interface_For_Microsoft_Teams_Instantiation
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
interface TeamsInterface
{
    /** 
     * Uses the connector specified to create a message in Microsoft Teams
     * 
     * @param array $payload An array of current day absences
     * 
     * @return mixed
     */
    public function sendAbsences(array $payload);

    /** 
     * Uses the connector specified to create a message in Microsoft Teams
     * 
     * @param array $payload An array of upcoming absences
     * 
     * @return mixed
     */
    public function sendUpcomingAbsences(array $payload);
}