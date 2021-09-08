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

use lib\curl\Curl;
use lib\traits\CurlTrait;
use lib\teams\abstracts\Connectors;

/**
 * The class for integrating Microsoft Teams absences
 * 
 * @category The_Final_Class_For_Integrating_Microsoft_Teams
 * @package  False
 * @author   Leigh Latham <leighlatham123@gmail.com>
 * @license  https://www.php.net/license/3_01.txt The PHP License, version 3.01
 * @link     false
 */
class Absences extends Connectors
{
    use CurlTrait;

    private $_webhook;
    private $_absences;
    private static $_curl;

    /**
     * Absences abstracts class constructor
     */
    public function __construct()
    {
        parent::__construct();

        self::$_curl = new Curl;
        $this->_webhook = parent::getAbsencesHook();
    }

    /**
     * Creates the absences post request
     *
     * @param array $payload An array of data to post
     * 
     * @return response
     */
    protected function send($payload)
    {
        self::$_curl->init();

        $payload = $this->_createFormattedPayload($payload);

        $curl_options = $this->_createOptionsArray("POST", $this->_webhook, $payload);

        self::$_curl->setOptArray($curl_options);

        $this->response = self::$_curl->exec();

        return $this->response;
    }

    /**
     * Creates the formatting of the payload array
     *
     * @param array $payload_array An array of data to post
     * 
     * @return string
     */
    private function _createFormattedPayload($payload_array)
    {
        $count = count($payload_array);
        $message = $count === 1 ? "is" : "are";
        
        return $this->_formatPayload($payload_array, $message, $count);
    }

    /**
     * Formats the payload ready for posting to teams webhook
     *
     * @param array  $absences_array   An array of absences data
     * @param string $absences_message Absences message
     * @param int    $absences_count   Absences count
     * 
     * @return void
     */
    private function _formatPayload($absences_array, $absences_message, $absences_count)
    {
        array_unshift(
            $absences_array, "**There $absences_message $absences_count absence(s) today.** <br>"
        );

        $absences_list = implode(',', array_values($absences_array));
        $absences_list = json_encode(array("text" => $absences_list), JSON_UNESCAPED_SLASHES);
        $absences_list = preg_replace('~[,|]~', '', $absences_list);

        return $absences_list;
    }

    
}