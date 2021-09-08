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

use lib\traits\TeamsTrait;
use lib\teams\abstracts\Connectors;

/**
 * The final class for integrating Microsoft Teams
 * 
 * @category The_Final_Class_For_Integrating_Microsoft_Teams
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Teams implements TeamsInterface
{
    use TeamsTrait;

    private static $_connectors;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        
    }

    /** 
     * Uses the connector specified to create a message in Microsoft Teams
     * 
     * @param array $payload An array of current day absences
     * 
     * @return mixed
     */
    public function sendAbsences($payload)
    {
        $connectors = new Connectors;

        return $connectors->sendAbsencesPayload($payload);
    }

    /** 
     * Uses the connector specified to create a message in Microsoft Teams
     * 
     * @param array $payload An array of upcoming absences
     * 
     * @return mixed
     */
    public function sendUpcomingAbsences($payload)
    {
        $connectors = new Connectors;

        return $connectors->sendUpcomingAbsencesPayload($payload);
    }
}