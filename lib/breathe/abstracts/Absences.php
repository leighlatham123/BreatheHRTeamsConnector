<?php

namespace lib\breathe\abstracts;

use lib\curl\Curl;
use lib\breathe\Breathe;
use lib\traits\CurlTrait;

class Absences extends Breathe
{
    use CurlTrait;

    private $key;
    private $host;
    private $uri;
    private $url;
    private $absences;
    private static $curl;

    public function __construct()
    {
        parent::__construct();

        self::$curl = new Curl;
        $this->key = parent::getKey();
        $this->host = parent::getHost();
        $this->uri = "absences";
        $this->url = $this->host.$this->uri;
    }

    protected function get($body)
    {
        self::$curl->init();

        $curl_options = $this->createOptionsArray($body);

        self::$curl->setOptArray($curl_options);

        $this->absences = self::$curl->exec();

        return $this->absences;
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
            "X-API-KEY",
        );
    }

    private function setHeaderValues()
    {
        return array(
            "application/json",
            $this->key,
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
            "GET",
            $this->url,
            $this->createHeaderArray(),
            $body,
        );
    }
}