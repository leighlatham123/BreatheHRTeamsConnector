<?php

namespace lib\traits;

trait CurlTrait {

    private $header_array = [];
    private $options_array = [];

    protected function createCurlHeaders($header_keys, $header_values)
    {
        foreach ($header_keys as $key => $value)
        {
            $this->header_array[$key] = $value .": ". $header_values[$key];
        }

        return $this->header_array;
    }

    protected function createCurlOptions($option_keys, $option_values)
    {
        $this->options_array = array_combine($option_keys, $option_values);

        $this->options_array[CURLOPT_VERBOSE]             = false;
        $this->options_array[CURLOPT_RETURNTRANSFER]      = true;
        $this->options_array[CURLOPT_FOLLOWLOCATION]      = true;
        $this->options_array[CURLOPT_TIMEOUT]             = 30;
        $this->options_array[CURLOPT_MAXREDIRS]           = 10;
        $this->options_array[CURLOPT_TIMEOUT]             = 0;
        $this->options_array[CURLOPT_HTTP_VERSION]        = CURL_HTTP_VERSION_1_1;
        
        // [DEBUG]
        // $options_array[CURLOPT_VERBOSE]             = true;
        // $options_array[CURLINFO_HEADER_OUT]         = true;

        return $this->options_array;
    }
}