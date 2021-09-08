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

namespace lib\teams\abstracts;

use lib\teams\Teams;
use lib\teams\abstracts\Absences;
use lib\teams\abstracts\UpcomingAbsences;

/**
 * The class for integrating Microsoft Teams connectors
 * 
 * @category The_Class_For_Integrating_Microsoft_Teams_Connectors
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Connectors extends Teams
{
    private $_absences_webhook;

    /**
     * Connectors constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->_absences_webhook = getenv('TEAMS_ABSENCES_WEBHOOK') ?: null;;
    }

    /**
     * Initiates the absences request
     *
     * @param string $json_payload List of JSON objects to send
     * 
     * @return response
     */
    public function sendAbsencesPayload($json_payload)
    {
        $absences = new Absences;

        return $absences->send($json_payload);
    }

    /**
     * Initiates the upcoming absences request
     *
     * @param string $json_payload List of JSON objects to send
     * 
     * @return response
     */
    public function sendUpcomingAbsencesPayload($json_payload)
    {
        $absences = new UpcomingAbsences;

        return $absences->send($json_payload);
    }

    /**
     * Gets the absences webhook string
     *
     * @return string
     */
    public function getAbsencesHook()
    {
        return $this->_absences_webhook;
    }
}