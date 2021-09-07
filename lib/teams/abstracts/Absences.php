<?php

namespace lib\teams\abstracts;

use lib\curl\Curl;
use lib\traits\CurlTrait;
use lib\teams\abstracts\Connectors;

class Absences extends Connectors
{
    use CurlTrait;

    private $webhook;
    private $absences;
    private static $curl;

    public function __construct()
    {
        parent::__construct();

        self::$curl = new Curl;
        $this->webhook = parent::getAbsencesHook();
    }

    protected function send($payload)
    {
        self::$curl->init();

        $payload = $this->createFormattedPayload($payload);

        $curl_options = $this->createOptionsArray($payload);

        self::$curl->setOptArray($curl_options);

        $this->response = self::$curl->exec();

        return $this->response;
    }

    private function createFormattedPayload($payload_array)
    {
        $count = $this->getAbsencesCount($payload_array);
        $message = $this->getAbsencesMessage($count);
        
        return $this->formatPayload($payload_array, $message, $count);
    }

    private function getAbsencesCount(array $absences)
    {
        return count($absences);
    }

    /**
     * @param int $absences_count
     * @return string
     */
    private function getAbsencesMessage(int $absences_count)
    {
        return $absences_count === 1 ? "is" : "are";
    }

    private function formatPayload($absences_array, $absences_message, $absences_count)
    {
        array_unshift($absences_array, "**There $absences_message $absences_count absence(s) today.** <br>");

        $absences_list = implode(',', array_values($absences_array));
        $absences_list = json_encode(array("text" => $absences_list), JSON_UNESCAPED_SLASHES);
        $absences_list = preg_replace('~[,|]~', '', $absences_list);

        return $absences_list;
    }

    private function createOptionsArray($body)
    {
        return $this->createCurlOptions($this->setOptionKeys(), $this->setOptionValues($body));
    }

    private function createHeaderArray()
    {
        return $this->createCurlHeaders($this->setHeaderKeys(), $this->setHeaderValues());
    }

    private function setHeaderKeys()
    {
        return array(
            "Accept",
            "Content-Type",
        );
    }

    private function setHeaderValues()
    {
        return array(
            "application/json",
            "application/json",
        );
    }

    private function setOptionKeys()
    {
        return array(
            CURLOPT_CUSTOMREQUEST,
            CURLOPT_URL,
            CURLOPT_HTTPHEADER,
            CURLOPT_POSTFIELDS,
        );
    }

    private function setOptionValues($body)
    {
        return array(
            "POST",
            $this->webhook,
            $this->createHeaderArray(),
            $body,
        );
    }
}