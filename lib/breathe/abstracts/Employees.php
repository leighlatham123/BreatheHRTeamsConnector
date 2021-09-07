<?php

namespace lib\breathe\abstracts;

use lib\curl\Curl;
use lib\breathe\Breathe;
use lib\traits\CurlTrait;

class Employees extends Breathe
{
    use CurlTrait;

    private $key;
    private $host;
    private $uri;
    private $employees;
    private static $curl;

    public function __construct()
    {
        parent::__construct();

        self::$curl = new Curl;
        $this->key = parent::getKey();
        $this->host = parent::getHost();
        $this->uri = "employees";
    }

    protected function get()
    {
        self::$curl->init();

        $curl_options = $this->createOptionsArray();

        self::$curl->setOptArray($curl_options);

        $this->employees = self::$curl->exec();

        return $this->employees;

    }

    private function createOptionsArray()
    {
        return $this->createCurlOptions($this->setOptionKeys(), $this->setOptionValues());
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
        );
    }

    private function setOptionValues()
    {
        return array(
            "GET",
            $this->host.$this->uri,
            $this->createHeaderArray(),
        );
    }
}